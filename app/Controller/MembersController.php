<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');
class MembersController extends AppController
{
    public $components = array('Mailtemplate', 'Library');
    var $name = 'Members';
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //User
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    public function testmail()
    {
        $Email = new CakeEmail('smtp');
        $Email->to('haidangdhct24@gmail.com');
        $Email->subject('Hello world');
        $Email->emailFormat('html');
        $Email->message();
        $body = $this->Mailtemplate->email_order('Nguyen Hai Dang', 'Cho thuê mặc bằng kinh doanh trung tâm thương mại Cái Khế, Ninh Kiều', 'Top list 2', '2017-09-29 00:00:00');
//        $Email->send($body);
        echo $body;

    }
    //Xong
    public function register()
    {
        $this->layout = 'ajax';
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        if($this->request->is('post'))
        {
            $this->Member->create();
            $this->Member->set('status', 1);
            $this->Member->set('image', 'default_user.jpg');
            if ($this->Member->save($this->request->data))
            {
                $fullname = $this->request->data['Member']['fullname'];
                $username = $this->request->data['Member']['username'];
                $email = $this->request->data['Member']['email'];
                $member_id = $this->Member->id;
                $code_active = md5(md5($username));
                //Send mail
                $Email = new CakeEmail('smtp');
                $Email->to($email);
                $Email->subject('Kích hoạt tài khoản');
                $Email->emailFormat('html');
                $Email->message();
                $body = $this->Mailtemplate->email_register($fullname, $email, $member_id, $code_active);
                //
                $this->Member->Profile->create();
                $this->Member->Profile->set('linkactiveemail', $code_active);
                $this->Member->Profile->set('member_id', $member_id);
                $this->Member->Profile->set('account', 1000000);
                $this->Member->Profile->set('activedemail', 0);
                $this->Member->Profile->set('activenumberphone', 0);
                $this->Member->Profile->save();
                //Send email
                try
                {
                    $Email->send($body);
                }
                catch (Exception $exception)
                {

                }
                //
                $this->Session->setFlash('Đăng ký tài khoản thành công', 'flashSuccess');
                $this->redirect('/members/login');
            }
            else
            {
                return $this->Member->validationErrors;
            }

        }
    }
    //Xong
    public function active_email()
    {
        $url = $this->params['url'];
        $member_id = isset($url['u_id'])? $url['u_id']: '';
        $email = isset($url['email'])? $url['email']: '';
        $code_active = $url['code_active'];
        $this->Member->Profile->recursive = -1;
        $profile_member = $this->Member->Profile->find('first', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Profile.member_id = Member.id'
                )
            ),
            'conditions' => array(
                'Profile.member_id' => $member_id,
                'Member.email' => $email
            )
        ));
        if($profile_member)
        {
            if($profile_member['Profile']['activedemail'] == 1)
            {
                $this->Session->setFlash('Email của bạn đã xác thực rồi', 'flashSuccess');
            }
            else
            {
                if($profile_member['Profile']['linkactiveemail'] == $code_active)
                {
                    $data_update = array(
                        'activedemail' => 1,
                        'linkactiveemail' => null,
                    );
                    $this->Member->Profile->updateAll(
                        $data_update,
                        array('Profile.member_id' => $member_id)
                    );
                    $this->Session->setFlash('Email của bạn đã được xác thực', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Mã kích hoạt không đúng', 'flashWarning');
                }
            }

        }
        else
        {
            $this->Session->setFlash('Thông tin thành viên không đúng', 'flashWarning');
        }
    }
    public function forget_password()
    {
        //
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $this->set(array('title' => 'Quên mật khẩu'));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            $email = isset($this->request->data['email'])? $this->request->data['email']: '';
            $this->Member->recursive = -1;
            $member = $this->Member->findByEmail($email);
            if(!$member)
            {
                $this->Session->setFlash('Không tìm thấy email', 'flashWarning');
            }
            else
            {
                $code_change = md5(md5($email . mt_rand()));
                $this->Member->Profile->recursive = -1;
                if($this->Member->Profile->updateAll(array('codechangepass' => "'$code_change'"), array('member_id' => $member['Member']['id'])))
                {
                    //Send mail
                    $Email = new CakeEmail('smtp');
                    $Email->to($email);
                    $Email->subject('Yêu cầu đặt lại mật khẩu');
                    $Email->emailFormat('html');
                    $Email->message();
                    $body = $this->Mailtemplate->email_forget_password($member['Member']['fullname'], $email, $code_change);
                    try
                    {
                        $Email->send($body);
                    }
                    catch (Exception $exception)
                    {

                    }
                    $this->Session->setFlash('Chúng tôi vừa gửi một email đặt lại mật khẩu cho bạn, vui lòng kiểm tra lại email.', 'flashSuccess');
                    $this->redirect('/members/forget_password');
                }
            }
        }
    }
    public function reset_password()
    {
        $code = isset($this->params['url']['code'])? $this->params['url']['code']: '';
        $email = isset($this->params['url']['email'])? $this->params['url']['email']: '';
        //
        $this->Member->recursive = -1;
        $member = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Member.id = Profile.member_id'
                ),
            ),
            'conditions' => array(
                'Member.email' => $email,
                'Profile.codechangepass' => $code
            )
        ));
        if(!$member)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/members/forget_password');
        }
        else
        {
            //
            $this->set(array('title' => 'Đặt lại mật khẩu'));
        }
        if($this->request->is('post') || $this->request->is('put'))
        {
            $password = $this->request->data['password_new'];
            $re_password = $this->request->data['re_password_new'];
            if(trim($password) == '')
            {
                $this->Session->setFlash('Vui lòng nhập mật khẩu', 'flashWarning');
            }
            else
            {
                if(trim($re_password) == '')
                {
                    $this->Session->setFlash('Vui lòng nhập lại mật khẩu', 'flashWarning');
                }
                else
                {
                    if(strlen($password) < 8)
                    {
                        $this->Session->setFlash('Mật khẩu từ 8 ký tự', 'flashWarning');
                    }
                    else
                    {
                        if($password != $re_password)
                        {
                            $this->Session->setFlash('Mật khẩu không khớp nhau', 'flashWarning');
                        }
                        else
                        {
                            $pass_new = AuthComponent::password($re_password);
                            $data_update_member = array(
                                'Member.id' => $member['Member']['id'],
                                'Member.email' => $email
                            );
                            if($this->Member->updateAll(array('password' => "'$pass_new'"), array($data_update_member)))
                            {
                                $this->Member->Profile->updateAll(array('codechangepass' => null), array('member_id' => $member['Member']['id']));
                                $this->Session->setFlash('Mật khẩu đã được thay đổi', 'flashSuccess');
                            }
                        }
                    }
                }
            }
        }
    }
    //Xong
    public function login()
    {
        $this->layout = 'ajax';
        if($this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        if($this->request->is('post'))
        {
            $username = $this->request->data['username'];
            $password = $this->request->data['password'];
            $passwordnew = AuthComponent::password($password);
            $url_redirect = $this->request->data['url_redirect'];
            $this->Member->recursive = -1;
            $members = $this->Member->find('first', array(
                'conditions' => array(
                    'Member.username' => $username,
                    'Member.password' => $passwordnew,
                )
            ));
            if($members)
            {
                if($members['Member']['status'] == 0)
                {
                    $this->Session->setFlash('Tài khoản của bạn đã bị khóa, vui lòng liên hệ với quản trị website', 'flashWarning');
                    $this->redirect('/members/login');
                }
                else
                {
                    $this->Session->write('Member.fullname', $members['Member']['fullname']);
                    $this->Session->write('Member.email', $members['Member']['email']);
                    $this->Session->write('Member.id', $members['Member']['id']);
                    $this->Session->write('Member.image', $members['Member']['image']);
                    $this->Session->write('Member.phonenumber', $members['Member']['phonenumber']);
                    $this->Session->write('Member.address', $members['Member']['address']);
                    $date = getdate();
                    $lastlogin = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
                    $data_update = array(
                        'id' => $members['Member']['id'],
                        'lastlogin' => $lastlogin
                    );
                    $this->Member->save($data_update);
                    if($url_redirect)
                    {
                        $this->redirect($url_redirect);
                    }
                    else
                    {
                        $this->redirect('/');
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng','flashError');
                $this->redirect('/members/login');
            }
        }
    }
    //Xong
    public function logout()
    {
        $this->Session->delete('Member');
        $this->redirect('/');
    }
    //Xong
    public function profile()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
            exit();
        }
        $id = $this->Session->read('Member.id');
        $this->Member->recursive = -1;
        $member = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Member.district_id'),
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id'),
                ),
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id'),
                ),
            ),
            'conditions' => array('Member.id' => $id),
            'fields' => array('*')
        ));
        if($member)
        {
            $this->set(array('members' => $member, 'title' => 'Thông tin tài khoản'));
        }
        else
        {
            $this->Session->delete('Member');
            $this->redirect('/');
        }
    }
    //Xong
    public function profile_update($id = null)
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        else
        {
            $provinces = null;
            $districts = null;
            $district_id = null;
            $province_id = null;
            //Member
            $id = $this->Session->read('Member.id');
            $this->Member->recursive = -1;
            $member = $this->Member->findById($id);

            $district_id = $member['Member']['district_id'];
            $this->Member->District->recursive = -1;
            $dis = $this->Member->District->findById($district_id);
            if($dis)
            {
                $province_id = $dis['District']['province_id'];
            }

            //District
            $this->Member->District->recursive = -1;
            $district = $this->Member->District->find('all', array(
                'conditions' => array('District.province_id' => $province_id),
                'fields' => array('District.id', 'District.districtname', 'District.districttype'),
                'order' => array('District.districtname' => 'ASC')
            ));
            foreach ($district as $item){
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
            //Province
            $this->Member->District->Province->recursive = -1;
            $province = $this->Member->District->Province->find('all', array(
                'fields' => array('Province.id', 'Province.provincename'),
                'order' => array('Province.provincename' => 'ASC')
            ));
            foreach ($province as $item){
                $provinces[$item['Province']['id']] = $item['Province']['provincename'];
            }

            $this->set(array(
                'member' => $member,
                'province' => $provinces,
                'district' => $districts,
                'province_id' => $province_id,
                'district_id' => $district_id,
                'title' => 'Cập nhật thông tin tài khoản'
            ));
        }

        if($this->request->is('post') || $this->request->is('put'))
        {
            debug($this->request->data);
            $this->Member->id = $id;
            $this->Member->set('birthday', $this->Library->convert_date_dd_mm_yyyy_to_yyyy_mm_dd($this->request->data['Member']['birth']));
            if($this->Member->save($this->request->data, true, array('fullname', 'gender', 'phonenumber', 'address', 'district_id', 'birthday')))
            {
                //
                $this->Session->write('Member.fullname', $this->request->data['Member']['fullname']);
                //
                $this->Session->setFlash('Cập nhật thông tin thành công', 'flashSuccess');
                $this->redirect('/members/profile');
            }
            else
            {
                $this->Session->setFlash('Không thể cập nhật thông tin', 'flashWarning');
            }
        }
    }
    //Xong
    public function change_password()
    {
        if($this->Session->check('Member'))
        {
            $this->set(array(
                'title' => 'Đổi mật khẩu'
            ));
            if($this->request->is('post'))
            {
                $data_update = array(
                    'password_old' => $this->request->data['Member']['password_old'],
                    'password_new' => $this->request->data['Member']['password_new'],
                    're_password_new' => $this->request->data['Member']['re_password_new'],
                    'id' => $this->Session->read('Member.id'),
                    'password' => $this->request->data['Member']['re_password_new']
                );
                if($this->Member->save($data_update, array('id', 'password')))
                {
                    $this->Session->setFlash('Mật khẩu đã được thay đổi', 'flashSuccess');
                    $this->redirect('/members/profile');
                }
            }
        }
        else
        {
            $this->redirect('/');
        }
    }
    //Xong
    public function change_avatar()
    {
        if($this->Session->check('Member'))
        {
            $this->set(array(
                'title' => 'Thay đổi ảnh đại diện'
            ));
            if($this->request->is('post'))
            {
                $image = $this->request->data['Member']['avatar'];
                if($image['name'] == '')
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                if($image['type'] != 'image/png' && $image['type'] != 'image/jpg' && $image['type'] != 'image/jpeg')
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                if($image['size'] > 500000)
                {
                    $this->Session->setFlash('Vui lòng chọn hình ảnh nhỏ hơn 500Kb', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                $id = $this->Session->read('Member.id');
                $this->Member->recursive = -1;
                $members = $this->Member->findById($id);
                if($members)
                {
                    $date = new DateTime();
                    $timestamp = $date->getTimestamp();
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $file = $members['Member']['username'] . '-' . $timestamp . '.' . $ext;
                    $image_old = $members['Member']['image'];
                    if(move_uploaded_file($image['tmp_name'], $this->path_member_avatar . '/' . $file))
                    {
                        if($image_old != 'default_user.jpg')
                        {
                            unlink($this->path_member_avatar . '/' . $image_old);
                        }
                        $data_update = array(
                            'id' => $id,
                            'image' => $file
                        );
                        if($this->Member->save($data_update))
                        {
                            $this->Session->write('Member.image', $file);
                            $this->Session->setFlash('Hình ảnh đã được thay đổi', 'flashSuccess');
                            $this->redirect('/members/profile');
                        }
                    }
                }
            }
        }
        else
        {
            $this->redirect('/');
        }
    }

    public function mypost()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        $member_id = $this->Session->read('Member.id');
        $url = $this->params['url'];
        //Dieu kien tim kiem
        $filter = isset($url['product_filter'])? $url['product_filter']: '';
        $condition_filter = '';
        if($filter == 'expired')
        {
            $condition_filter = 'Product.expiry < "' . $cur_date . '" AND Product.expiry > "0000-00-00 00:00:00"';
            $condition_filter = $condition_filter . ' AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'visible')
        {
            $condition_filter = 'Product.expiry >= "' . $cur_date . '" AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'draft')
        {
            $condition_filter = 'Product.status = 0 AND Product.paid = 0';
        }
        //Category
        $category_search = isset($url['category'])? $url['category']: 0;
        $condition_category = $category_search > 0? 'Product.category_id = ' . $category_search: '';

        //End dieu kien tim kiem
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $this->Member->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => 10,
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parentcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parentcat.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                //Dieu kien mac dinh
                'Product.member_id = ' . $member_id,
                $condition_filter,
                $condition_category,
                'Product.deleted = 0'
            ),
            'order' => array('Product.id' => 'desc')
        );
        $product = $this->paginate('Product');
        //
        $categories = null;
        ClassRegistry::init('Category')->recursive = -1;
        $category = ClassRegistry::init('Category')->find('threaded', array(
            'order' => array('sort' => 'ASC')
        ));
        foreach ($category as $item)
        {
            $arr_children = array();
            foreach ($item['children'] as $child)
            {
                $arr_children[$child['Category']['id']] = $child['Category']['categoryname'];
            }
            $categories[$item['Category']['categoryname']] = $arr_children;
        }
        //
        $this->set(array(
            'products' => $product,
            'head_description' => 'Tin đăng của tôi',
            'title' => 'Tin đăng của tôi',
            'categories' => $categories
        ));
    }
    public function delete_mypost()
    {
        $this->autoRender = false;
        if($this->Session->check('Member'))
        {
            $member_id = $this->Session->read('Member.id');
            $product_id = $this->request->data['product_id'];
            $data_update = array(
                'id' => $product_id,
                'member_id' => $member_id,
                'deleted' => 1,
                'status' => 0,
                'paid' => 0,
                'expiry' => '0000-00-00'
            );
            //Kiểm tra nếu là tin nháp thì xóa
            //Tức là chưa có hóa đơn cho mã product tương ứng
            //Kiểm tra hoa đơn
            ClassRegistry::init('Order')->recursive = -1;
            $count_order = ClassRegistry::init('Order')->find('count', array(
                'conditions' => array('product_id' => $product_id)
            ));
            if($count_order > 0)
            {
                if($this->Member->Product->save($data_update))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashWarning');
                }
            }
            //Neu khong co hoa don
            else
            {
                //Xóa hinh ảnh
                $this->Member->Product->recursive = -1;
                $product = $this->Member->Product->findById($product_id);
                //
                if($product)
                {
                    //Xóa hinh ảnh field [Product][image]
                    if(file_exists($this->path_product . '/' . $product['Product']['image']))
                    {
                        unlink($this->path_product . '/' . $product['Product']['image']);
                    }
                    if(file_exists($this->path_product_thumb . '/' . $product['Product']['image']))
                    {
                        unlink($this->path_product_thumb . '/' . $product['Product']['image']);
                    }
                    //Xóa hình ảnh trong bảng imageproduct
                    ClassRegistry::init('Image')->recursive = -1;
                    $image_product = ClassRegistry::init('Image')->find('all', array(
                        'conditions' => array('product_id' => $product_id)
                    ));
                    foreach ($image_product as $item)
                    {
                        if(file_exists($this->path_product . '/' . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']))
                        {
                            unlink($this->path_product . '/' . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']);
                        }
                        if(file_exists($this->path_product_thumb . '/'  . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']))
                        {
                            unlink($this->path_product_thumb . '/'  . $item['Image']['imagedir'] . '/' . $item['Image']['imagelink']);
                        }
                    }
                    //Xoa các record hinh anh
                    ClassRegistry::init('Image')->deleteAll(array('product_id' => $product_id));
                }
                //
                if($this->Member->Product->delete($product_id))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashWarning');
                }
            }
            //Nếu là tin đang hiển thị hoặc hết hạn hiển thị thì update delete = 1
            //Để còn dữ liệu thống kê hóa đơn
        }
    }
    function mobicard()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/members/login/');
        }
        if($this->request->is('post'))
        {
            //Member
            //
            $member_id = $this->Session->read('Member.id');
            $this->Member->recursive = -1;
            $member = $this->Member->findById($member_id);
            $this->Member->Profile->recursive = -1;
            $profile = $this->Member->Profile->find('first', array(
                'conditions' => array('member_id' => $member_id)
            ));
            define('CORE_API_HTTP_USR', 'merchant_19002');
            define('CORE_API_HTTP_PWD', '19002mQ2L8ifR11axUuCN9PMqJrlAHFS04o');
            $bk = 'https://www.baokim.vn/the-cao/restFul/send';
            $seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
            $sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
            //Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
            $mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';

            if($mang=='MOBI'){
                $ten = "Mobifone";
            }
            else if($mang=='VIETEL'){
                $ten = "Viettel";
            }
            else if($mang=='GATE'){
                $ten = "Gate";
            }
            else if($mang=='VTC'){
                $ten = "VTC";
            }
            else $ten ="Vinaphone";
            //Check data
            if($mang == '' || $seri == '' || $sopin == '')
            {
                $this->Session->write('error_mobicard', 'Nhập đầy đủ thông tin');
                $this->redirect('/deposit/mobicard/');
            }

            //
            //Mã MerchantID dang kí trên Bảo Kim
            $merchant_id = '19002';
            //Api username
            $api_username = 'macintoshvn';
            //Api Pwd d
            $api_password = 'macintoshvn235dgsdg';
            //Mã TransactionId
            $transaction_id = time();
            //mat khau di kem ma website dang kí trên Bảo Kim
            $secure_code = '1e6cb0e1c37b25cf';

            $arrayPost = array(
                'merchant_id'=>$merchant_id,
                'api_username'=>$api_username,
                'api_password'=>$api_password,
                'transaction_id'=>$transaction_id,
                'card_id'=>$mang,
                'pin_field'=>$sopin,
                'seri_field'=>$seri,
                'algo_mode'=>'hmac'
            );
            ksort($arrayPost);
            $data_sign = hash_hmac('SHA1',implode('',$arrayPost), $secure_code);
            $arrayPost['data_sign'] = $data_sign;
            $curl = curl_init($bk);
            curl_setopt_array($curl, array(
                CURLOPT_POST=>true,
                CURLOPT_HEADER=>false,
                CURLINFO_HEADER_OUT=>true,
                CURLOPT_TIMEOUT=>30,
                CURLOPT_RETURNTRANSFER=>true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
                CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
                CURLOPT_POSTFIELDS=>http_build_query($arrayPost)
            ));
            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($data,true);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = time();
            if($status==200){
                $amount = $result['amount'];
                switch($amount) {
                    case 10000: $xu = 10000; break;
                    case 20000: $xu = 20000; break;
                    case 30000: $xu = 30000; break;
                    case 50000: $xu= 50000; break;
                    case 100000: $xu = 100000; break;
                    case 200000: $xu = 200000; break;
                    case 300000: $xu = 300000; break;
                    case 500000: $xu = 500000; break;
                    case 1000000: $xu = 1000000; break;
                }
                //Add history recharge
                //Update primary account
                $this->Member->Profile->query('UPDATE profiles SET account = account + ' . $xu * 0.8 . ' WHERE member_id = ' . $member_id);
                //
                $data_add = array(
                    'member_id' => $member_id,
                    'price' => $xu,
                    'cardcode' => $sopin,
                    'seri' => $seri,
                    'type' => $mang
                );
                $this->Member->Recharge->save($data_add);
                // Xu ly thong tin tai day
                $file = "carddung.log";
                $fh = fopen($file,'a') or die("cant open file");
                fwrite($fh,"Tai khoan: ". $member['Member']['username'] . '/' . $member['Member']['fullname'] .'/' . $member['Member']['email'] .", Loai the: ".$ten.", Menh gia: ".$amount.", Thoi gian: ".$time);
                fwrite($fh,"\r\n");
                fclose($fh);
                $this->Session->write('success_mobicard', "Bạn đã thanh toán thành công thẻ '.$ten.' mệnh giá '.$amount.'");
                $this->redirect('/deposit/mobicard/');
            }
            else
            {
                $error = $result['errorMessage'];
                $file = "cardsai.log";
                $fh = fopen($file,'a') or die("cant open file");
                fwrite($fh,"Tai khoan: ". $member['Member']['username'] . '/' . $member['Member']['fullname'] .'/' . $member['Member']['email'] .", Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".$time);
                fwrite($fh,"\r\n");
                fclose($fh);
                $this->Session->write('error_mobicard', "Thông tin thẻ cào không hợp lệ. " . $error);
                $this->redirect('/deposit/mobicard/');
            }
        }
        else
        {
            $this->redirect('/deposit/mobicard/');
        }
    }
    function atm_success()
    {
        if($this->Session->check('Member'))
        {
            $member_id = $this->Session->read('Member.id');
            $query_string = $this->params['url'];
//            date_default_timezone_set('Asia/Ho_Chi_Minh');
//            $date = new DateTime('@' . $query_string['created_on']);
//            unset($query_string['checksum']);
//            $data_sign = hash_hmac('SHA1', implode('', $query_string), 'ae543c080ad91c23');
            //Kiem tra du lieu
            //
            $this->Member->Atm->set('member_id', $member_id);
            if($this->Member->Atm->save($query_string))
            {
                $this->Member->Profile->query('UPDATE profiles SET account = account + ' . $query_string['net_amount'] . ' WHERE member_id = ' . $member_id);
                $this->Session->write('atm_success', 'Bạn đã nạp thành công ' . number_format($query_string['total_amount']) . ' vào tài khoản.');
                $this->redirect('/deposit/atm/');
            }
            else
            {
                $this->redirect('/deposit/atm/');
            }
        }
        else
        {
            $this->redirect('/deposit/login/');
        }
        //
        $this->redirect('/deposit/atm/');
    }
    function history_recharge()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $recharge = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'conditions' => array('member_id' => $member_id),
            'order' => array('Recharge.id' => 'DESC')
        ));
        $atms = null;
        $this->Member->Atm->recursive = -1;
        $atms = $this->Member->Atm->find('all', array(
            'conditions' => array('member_id' => $member_id),
            'order' => array('id' => 'DESC')
        ));
        $this->set(array(
            'atms' => $atms,
            'recharges' => $recharge,
            'title' => 'Lịch sử nạp tiền'
        ));
    }
    function account_info()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $members = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Profile->recursive = -1;
        $members = $this->Member->Profile->find('first', array(
            'conditions' => array('Profile.member_id' => $member_id)
        ));
        $this->set(array(
            'members' => $members,
            'title' => 'Thông tin tài khoản'
        ));
    }
    //Xong
    function orders()
    {
        if(!$this->Session->check('Member'))
        {
            $this->redirect('/');
        }
        $orders = null;
        $member_id = $this->Session->read('Member.id');
        $this->Member->Product->Order->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.id = Order.product_id'
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.member_id = ' . $member_id,
            ),
            'order' => array('Product.id' => 'DESC')
        );
        $orders = $this->paginate($this->Member->Product->Order);
        $this->set(array(
            'orders' => $orders,
            'title' => 'Hóa đơn'
        ));
    }
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //Admin
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    public function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Search
        $url = $this->params['url'];
        //name
        $name = isset($url['name'])? $url['name']: '';
        $condition_email = '';
        $condition_username = '';
        if($name != '')
        {
            $condition_email = 'Member.email = "' . $name . '"';
            $condition_username = 'Member.username = "' . $name . '"';
        }


        $this->Member->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => 10   ,
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Member.district_id'),
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id'),
                ),
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id'),
                ),
            ),
            'fields' =>'*',
            'order' => array('Member.id' => 'desc'),
            'conditions' => array(
                'OR' => array(
                    $condition_email,
                    $condition_username
                )
            )
        );
        $members = $this->paginate('Member');
        $this->set(array(
            'members' => $members,
            'title' => 'Danh sách thành viên',
        ));
    }
    public function admin_view_detail($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Member->recursive = -1;
        $members = $this->Member->find('first', array(
            'joins' => array(
                array(
                    'table' => 'profiles',
                    'alias' => 'Profile',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Member.id = Profile.member_id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Member.district_id = District.id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                )
            ),
            'fields' => array('*'),
            'conditions' => array(
                'Member.id' => $id
            ),
        ));
        if(!$members)
        {
            $this->redirect('/admin/members');
        }
        //Lịch sử nạp tiền
        $recharge = null;
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'conditions' => array('member_id' => $id),
            'order' => array('Recharge.id' => 'DESC')
        ));
        //Tin đã đăng
        $this->Member->Product->recursive = -1;
        $sum_product = 0;
        $sum_product = $this->Member->Product->find('count', array(
            'conditions' => array('member_id' => $id)
        ));
        $this->set(array(
            'title' => 'Thông tin thành viên',
            'members' => $members,
            'recharges' => $recharge,
            'sum_product' => $sum_product
        ));
    }
    public function admin_recharge()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Nạp tiền tài khoản thành viên',
        ));
        if($this->request->is('post') || $this->request->is('put'))
        {
            $user = $this->request->data['Recharge']['email'];
            $price = $this->request->data['Recharge']['price'];
            $this->Member->recursive = -1;
            $members = $this->Member->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        array('Member.email' => $user),
                        array('Member.username' => $user)
                    ),
                ),
                'joins' => array(
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    )
                ),
                'fields' => array('Member.id', 'Profile.id', 'Profile.member_id', 'Profile.account')
            ));
            if(!$members)
            {
                $this->Session->setFlash('Email hoặc tên đăng nhập của thành viên không tồn tại', 'flashWarning');
            }
            else
            {
                if($price < 50000)
                {
                    $this->Session->setFlash('Vui lòng nhập số tiền tối thiểu 50.000', 'flashWarning');
                }
                else
                {
                    $this->Member->Recharge->recursive = -1;
                    $this->Member->Recharge->set('member_id', $members['Member']['id']);
                    if($this->Member->Recharge->save($this->request->data))
                    {
                        $this->Member->Profile->recursive = -1;
                        $this->Member->Profile->updateAll(
                            array('account' => $members['Profile']['account'] + $price),
                            array(
                                'Profile.member_id' => $members['Member']['id'],
                                'Profile.id' => $members['Profile']['id']
                            )
                        );
                        $this->Session->setFlash('Giao dịch thành công', 'flashSuccess');
                        $this->redirect('/admin/members/history_recharges');
                    }
                    else
                    {
                        $this->Session->setFlash('Lỗi hệ thống', 'flashError');
                    }
                }
            }
        }
    }
    function admin_history_recharges()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $recharge = null;
        $this->Member->Recharge->recursive = -1;
        $recharge = $this->Member->Recharge->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Recharge.member_id = Member.id'
                )
            ),
            'fields' => array('*'),
            'order' => array('Recharge.id' => 'DESC')
        ));
        //
        $atms = null;
        $this->Member->Atm->recursive = -1;
        $atms = $this->Member->Atm->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Atm.member_id = Member.id'
                )
            ),
            'fields' => array('*'),
            'order' => array('Atm.id' => 'DESC')
        ));

        $this->set(array(
            'atms' => $atms,
            'recharges' => $recharge,
            'title' => 'Lịch sử nạp tiền'
        ));
    }
    function admin_disactive()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $member_id = $this->request->data['member_id'];
            $this->Member->recursive = -1;
            if($this->Member->updateAll(array('Member.status' => 0), array('Member.id' => $member_id)))
            {
                $this->Session->setFlash('Đã khóa tài khoản', 'flashSuccess');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_active()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $member_id = $this->request->data['member_id'];
            $this->Member->recursive = -1;
            if($this->Member->updateAll(array('Member.status' => 1), array('Member.id' => $member_id)))
            {
                $this->Session->setFlash('Đã mở khóa tài khoản', 'flashSuccess');
            }
            else
            {
                $this->Session->setFlash('Lỗi', 'flashError');
            }
        }
    }
    function admin_accounts()
    {

    }
    //Xong
    public function admin_post_product($member_id = 0)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Member
        $this->Member->recursive = -1;
        $members = $this->Member->findById($member_id);
        if(!$members)
        {
            $this->redirect('/admin/products');
        }
        //Product
        $this->Member->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parentcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parentcat.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Member.id' => $member_id
                //Dieu kien mac dinh
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $product = null;
        }
        $this->set(array(
            'members' => $members,
            'products' => $product,
            'title' => 'Tin đăng của thành viên',
        ));
    }
}