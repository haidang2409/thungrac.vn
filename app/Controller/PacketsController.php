<?php
App::uses('CakeEmail', 'Network/Email');
class PacketsController extends AppController
{

    public $components = array('Session', 'Library', 'Mailtemplate');
    ///////////////////////////////////
    ///////////////////////////////////
    //User
    ///////////////////////////////////
    ///////////////////////////////////
    public function index()
    {
        $this->Packet->recursive = -1;
        $packets = $this->Packet->find('all', array(
            'order' => array('sort' => 'asc')
        ));
        $this->set(array(
            'title' => 'Báo giá dịch vụ',
            'packets' =>  $packets
        ));
    }
    public function paid()
    {
        if($this->Session->read('Member'))
        {
            $member_id = $this->Session->read('Member.id');
        }
        else
        {
            $this->redirect('/');
        }
        $product_id = isset($this->params['url']['pid']) && ($this->params['url']['pid'] != '')? $this->params['url']['pid']: '0';
        $this->Packet->Product->recursive = -1;
        $product = $this->Packet->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                )
            ),
            'conditions' => array('Product.id = ' . $product_id, 'Product.member_id = ' . $member_id, 'Product.paid != 1')
        ));
        $this->Packet->Product->Image->recursive = -1;
        $image_product = $this->Packet->Product->Image->find('first', array(
            'conditions' => array('product_id = ' . $product_id)
        ));
        if($product)
        {
            $this->Packet->recursive = -1;
            $packets = $this->Packet->find('all', array(
                'order' => array('Packet.sort' => 'asc')
            ));
            $member = ClassRegistry::init('Profile')->findByMember_id($member_id);
            $this->set(array(
                'title' => 'Thanh toán',
                'packets' => $packets,
                'products' => $product,
                'member' => $member,
                'imageproducts' => $image_product
            ));
        }
        else
        {
            $this->redirect('/');
        }
//        Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $packet_id = 0;
            if(isset($this->request->data['packet_id']))
            {
                $packet_id = $this->request->data['packet_id'];
            }
            $this->Packet->recursive = -1;
            $packet_data = $this->Packet->findById($packet_id);
            //Nếu có packet
            if($packet_data)
            {
                $price = $packet_data['Packet']['price'];
                if($packet_data['Packet']['discount'] > 0)
                {
                    $price = $packet_data['Packet']['discount'];
                }
                //Kiem tra tai khoan
                if($member['Profile']['account'] < $price)
                {
                    $this->Session->setFlash('Tài khoản của bạn không đủ để thanh toán vui lòng nạp thêm tiền hoặc chọn gói thấp hơn', 'flashWarning');
                }
                else
                {
                    //Ngay het han
                    $date = getdate();
                    $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
                    $cur_time = $date['hours'] . '-' . $date['minutes'] . '-' . $date['seconds'];
                    $m = $packet_data['Packet']['date'];
                    $expiry = date('Y-m-d', strtotime($cur_date. '+ ' . $m . ' days'));
                    $update_product = array(
                        'id' => $product_id,
                        'packet_id' => $packet_id,
                        'paid' => '1',
                        'status' => '1',
                        'date_paid' => $cur_date . ' ' . $cur_time,
                        'expiry' => $expiry. ' ' . $cur_time,
                        'deleted' => 0
                    );
                    //Update product
                    if($this->Packet->Product->save($update_product))
                    {
                        //Tru tai khoan(update)
                        ClassRegistry::init('Profile')->updateAll(array(
                            'account' => $member['Profile']['account'] - $price,
                        ),
                        array(
                            'member_id' => $member_id
                        ));
                        //Tạo order
                        $order_data = array(
                            'product_id' => $product_id,
                            'sumamount' => $price,
                            'status' => 0,
                            'packet_id' => $packet_id
                        );
                        ClassRegistry::init('Order')->save($order_data);
                        $this->Session->setFlash('Thanh toán thành công. Tin đăng của bạn sẽ được duyệt trong thời gian sớm nhất', 'flashSuccess');
                        $this->Session->write('paid_success', true);
                        //Send email
                        $server_host = $_SERVER['HTTP_HOST'];
                        $fullname = $member['Member']['fullname'];
                        $link_product = $server_host . '/' . $product['Product']['productlink'] . '-' . $product['Product']['id'];
                        $title_product = $product['Product']['title'];
                        $packet_name = $packet_data['Packet']['packetname'] . '(' . number_format($price, 0, '', '.') . '/' . $packet_data['Packet']['date'] . 'ngày)';
                        $email = $member['Member']['email'];
                        $Email = new CakeEmail('smtp');
                        $Email->to($email);
                        $Email->subject('Thông tin thanh toán');
                        $Email->emailFormat('html');
                        $Email->message();
                        $body = $this->Mailtemplate->email_order($fullname, $title_product, $packet_name, $expiry);
                        try
                        {
//                            $Email->send($body);
                        }
                        catch (Exception $exception)
                        {

                        }
                        //End send email
                        $this->redirect('/packets/paid_success/?success=true&pid=' . $product_id);
                    }
                    else
                    {
                        $this->Session->setFlash('Xảy ra lỗi, vui lòng thử lại sau', 'flashError');
                    }
                }

            }
            else
            {
                $this->Session->setFlash('Vui lòng chọn một trong các gói tin đăng sau', 'flashWarning');
            }
        }
    }

    public function paid_success()
    {
        if(!$this->Session->check('paid_success'))
        {
            $this->redirect('/');
        }
        else
        {
            $this->Session->delete('paid_success');
        }
    }

    ////////////////////////////////////////
    ////////////////////////////////////////
    //Admin
    ////////////////////////////////////////
    ////////////////////////////////////////
    public function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Packet->recursive = -1;
        $packets = $this->Packet->find('all', array(
            'order' => array('sort' => 'asc')
        ));
        $this->set(array(
            'title' => 'Dịch vụ đăng tin',
            'packets' =>  $packets
        ));
    }
    public function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm dịch vụ'));
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Packet->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/packets');
            }
        }
    }
    public function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set
        $packets = $this->Packet->findById($id);
        if(!$packets)
        {
            $this->Session->setFlash('Not found', 'flashError');
            $this->redirect('/admin/packets');
        }
        $this->set(array(
            'packets' => $packets,
            'title' => 'Sửa gói tin'
        ));
        //post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Packet->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/packets');
            }
        }
    }
    public function admin_delete()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            $id = $this->request->data['packet_id'];
            $count = $this->Packet->Product->find('count', array(
                'conditions' => array('Product.packet_id' => $id)
            ));
            if($count == 0)
            {
                if($this->Packet->delete($id))
                {
                    $this->Session->setFlash('Đã xóa', 'flashSuccess');
                }
            }
            else
            {
                $this->Session->setFlash('Không thể xóa', 'flashError');
            }
        }
        else
        {
            $this->Session->setFlash('Lỗi', 'flashError');
        }

    }
}