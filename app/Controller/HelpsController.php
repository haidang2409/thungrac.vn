<?php
class HelpsController extends AppController
{
    function index()
    {

    }
    function about()
    {
        $helps = $this->Help->findByName('about');
        if($helps)
        {
            $this->set(array(
                'helps' => $helps,
                'title' => 'Giới thiệu về chúng tôi'
            ));
        }
    }
    function contact()
    {
        $this->set(array(
            'title' => 'Liên hệ'
        ));
    }
    function huongdandangtin()
    {
        $helps = $this->Help->findByName('huongdandangtin');
        if($helps)
        {
            $this->set(array(
                'helps' => $helps,
                'title' => 'Hướng dẫn đăng tin bất động sản'
            ));
        }
    }
    function huongdanthanhtoan()
    {
        $helps = $this->Help->findByName('huongdanthanhtoan');
        if($helps)
        {
            $this->set(array(
                'helps' => $helps,
                'title' => 'Hướng dẫn thanh toán'
            ));
        }
    }
    function dieukhoansudung()
    {
        $helps = $this->Help->findByName('dieukhoansudung');
        if($helps)
        {
            $this->set(array(
                'helps' => $helps,
                'title' => 'Điều khoản sử dụng dịch vụ'
            ));
        }
    }
    function dieukhoanbaomat()
    {
        $helps = $this->Help->findByName('dieukhoanbaomat');
        if($helps)
        {
            $this->set(array(
                'helps' => $helps,
                'title' => 'Điều khoản bảo mật thông tin'
            ));
        }
    }
    function dichvuquangcao()
    {

        $this->set(array(

            'title' => 'Báo giá dịch vụ quảng cáo'
        ));
    }
    //////////////////////////////////////
    //////////////////////////////////////
    //Admin
    //////////////////////////////////////
    //////////////////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $helps = $this->Help->find('all');
        if($helps)
        {
            $this->set(array(
                'title' => 'Thông tin hướng dẫn',
                'helps' => $helps,
            ));
        }
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm hướng dẫn'));
        if($this->request->is('post') || $this->request->is('put'))
        {
            $helps = $this->Help->findByName($this->request->data['Help']['name']);
            if($helps)
            {
                $this->Session->setFlash('Mục đã tồn tại', 'flashWarning');
                $this->redirect('/admin/helps');
            }
            if($this->Help->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/helps');
            }
            else
            {
                $this->Session->setFlash('Error', 'flashError');
                $this->redirect('/admin/helps');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Sửa thông tin hướng dẫn'));
        $helps_edit = $this->Help->findById($id);
        if($helps_edit)
        {
            $this->set(array(
                'helps' => $helps_edit
            ));
        }
        else
        {
            $this->Session->setFlash('Không tìm thấy trang', 'flashWarning');
            $this->redirect('/admin/helps');
        }
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Help->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/helps');
            }
            else
            {
                $this->Session->setFlash('Error', 'flashError');
                $this->redirect('/admin/helps');
            }
        }
    }

}