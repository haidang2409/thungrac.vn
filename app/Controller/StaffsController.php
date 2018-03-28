<?php
App::uses('AuthComponent', 'Controller/Component');

class StaffsController extends AppController
{
    var $name = 'Staffs';
    public $helpers = array('Lib', 'Html', 'Form', 'Session');
    public $components = array('Session', 'Library');
    public $paginate = array(
        'limit' => 10,
        'conditions' => array(),
        'order' => array('Staff.id' => 'desc')
    );
    /////////////////////////////////
    /////////////////////////////////
    //Admin
    /////////////////////////////////
    /////////////////////////////////
    function admin_home()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array(
            'title' => 'Trang chủ'
        ));
        //Member
        ClassRegistry::init('Member')->recursive = -1;
        $members = ClassRegistry::init('Member')->find('all', array(
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Member.lastlogin'
            ),
            'order' => array('Member.lastlogin' => 'DESC'),
            'limit' => 12
        ));
        //Product
        ClassRegistry::init('Product')->recursive = -1;
        $product_new = ClassRegistry::init('Product')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.member_id = Member.id'
                )
            ),
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Product.id',
                'Product.title',
                'Product.price',
                'Product.created'
            ),
            'order' => array('Product.id' => 'DESC'),
            'limit' => 10
        ));
        //Order

        //Counter product
        ClassRegistry::init('Product')->recursive = -1;
        $count_product = ClassRegistry::init('Product')->find('count');
        //Counter order
        ClassRegistry::init('Order')->recursive = -1;
        $count_order = ClassRegistry::init('Order')->find('count');
        ClassRegistry::init('Order')->recursive = -1;
        $counter_order_approval = ClassRegistry::init('Order')->find('count', array('conditions' => array('status' => 1)));
        ClassRegistry::init('Order')->recursive = -1;
        $counter_order_not_approval = ClassRegistry::init('Order')->find('count', array('conditions' => array('status' => 0)));
        $counter_product = array(
            'all' => $count_product,

        );
        $counter_order = array(
            'all' => $count_order,
            'approval' => $counter_order_approval,
            'not_approval' => $counter_order_not_approval
        );

        //Count member
        ClassRegistry::init('Member')->recursive = -1;
        $count_member = ClassRegistry::init('Member')->find('count');
        $counter_member = array(
            'all' => $count_member
        );
        //Comment on post
        ClassRegistry::init('Commentproduct')->recursive = -1;
        $comment_products = ClassRegistry::init('Commentproduct')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.id = Commentproduct.product_id'
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Member.id = Commentproduct.member_id'
                )
            ),
            'fields' => array(
                'Member.id',
                'Member.fullname',
                'Member.image',
                'Product.id',
                'Product.title',
                'Product.productlink',
                'Commentproduct.comment',
                'Commentproduct.created',
                'Commentproduct.id',
            ),
            'order' => array('Commentproduct.id' => 'DESC'),
            'limit' => 10
        ));
        //Set
        $this->set(array(
            'counter_member' => $counter_member,
            'counter_order' => $counter_order,
            'counter_product' => $counter_product,
            'product_news' => $product_new,
            'comment_products' => $comment_products,
            'members' => $members,
        ));

    }
    function admin_login()
    {
        $this->layout = 'ajax';
        if($this->Session->check('Admin'))
        {
            $this->redirect('/admin/home');
        }
//        post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $email = $this->request->data['email'];
            $password = AuthComponent::password($this->request->data['password']);
            debug($password);
            $this->Staff->recursive = -1;
            $staffs = $this->Staff->find('first', array(
                'conditions' => array(
                    'email' => $email,
                    'password' => $password,
                )
            ));
            if($staffs)
            {
                if($staffs['Staff']['status'] == 0)
                {
                    $this->Session->setFlash('Tài khoản đã bị khóa, vui lòng liên hệ với ban quản trị', 'flashWarning');
                    $this->redirect('/admin/login');
                }
                else
                {
                    $this->Session->write('Admin.fullname', $staffs['Staff']['fullname']);
                    $this->Session->write('Admin.email', $staffs['Staff']['email']);
                    $this->Session->write('Admin.id', $staffs['Staff']['id']);
                    $this->Session->write('Admin.rold', $staffs['Staff']['role']);
                    $this->Session->write('Admin.image', $staffs['Staff']['image']);
                    $this->redirect('/admin/home');
                }
            }
            else
            {
                $this->Session->setFlash('Tên đăng nhập hoặc mật khẩu không đúng', 'flashError');
                $this->redirect('/admin');
            }
        }
    }
    function admin_logout()
    {
        $this->Session->delete('Admin');
        $this->redirect('/admin/login');
    }
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $staffs = null;
        $this->Staff->recursive = -1;
        $staffs = $this->Staff->find('all', array());
        $this->set(
            array(
                'staffs' => $staffs,
                'title' => 'Nhân viên'
            )
        );
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set province
        $provinces = null;

        //set
        $this->set(array(
            'provinces' => $provinces,
            'title' => 'Thêm nhân viên'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Staff->set('status', 1);
            $this->Staff->set('image', 'default_user.jpg');
            if($this->request->data['Staff']['birth'] != '')
            {
                $this->Staff->set('birthday', implode('-', array_reverse(explode('/', $this->request->data['Staff']['birth']))));
            }
            if($this->Staff->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/staffs');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set staff
        $staffs = null;
        $this->Staff->recursive = -1;
        $staffs = $this->Staff->find('first', array(
            'conditions' => array(
                'Staff.id' => $id
            )
        ));
        if(!$staffs)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/staffs');
        }
        //set
        $this->set(array(
            'staffs' => $staffs,
            'title' => 'Sửa thông tin nhân viên',
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Staff->set('status', 1);
            $this->Staff->set('image', 'default_user.jpg');
            if($this->request->data['Staff']['birth'] != '')
            {
                $this->Staff->set('birthday', implode('-', array_reverse(explode('/', $this->request->data['Staff']['birth']))));
            }
            if($this->Staff->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/staffs');
            }
        }
    }
    function admin_enable()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $staff_id = $this->request->data['staff_id'];
                $data_update = array(
                    'id' => $staff_id,
                    'status' => 1
                );
                if($this->Staff->save($data_update))
                {
                    $this->Session->setFlash('Đã mở khóa tài khoản', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
    function admin_disable()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post') || $this->request->is('put'))
            {
                $staff_id = $this->request->data['staff_id'];
                $data_update = array(
                    'id' => $staff_id,
                    'status' => 0
                );
                if($this->Staff->save($data_update))
                {
                    $this->Session->setFlash('Đã khóa tài khoản', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
    function admin_view()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thông tin nhân viên'));
    }
    function admin_my_profile()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
    }


    //Menu min
    function admin_set_status_menu()
    {
        $this->autoRender = false;
        if($this->Session->check('Admin'))
        {
            if($this->request->is('post'))
            {
                $status = $this->request->data['status'];
                if($status == 'true')
                {
                    $this->Session->write('min-menu', 'true');
                    echo 'hide';
                }
                else
                {
                    $this->Session->write('min-menu', 'false');
                    echo 'show';
                }
            }
        }
    }
}