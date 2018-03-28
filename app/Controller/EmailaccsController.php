<?php
class EmailaccsController extends AppController
{

    ////////////////
    ////////////////
    //Admin
    ////////////////
    ////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //set
        $emailaccs = null;
        $emailaccs = $this->Emailacc->find('all');
        $this->set(array('emailaccs' => $emailaccs, 'title' => 'Tài khoản email'));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //
        $this->set(array('title' => 'Thêm tài khoản email'));
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Emailacc->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/emailaccs');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //
        $emailaccs = $this->Emailacc->findById($id);
        if($emailaccs)
        {
            $this->set(array('emailaccs' => $emailaccs, 'title' => 'Sửa tài khoản email'));
        }
        else
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/emailaccs');
        }
        //
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Emailacc->save($this->request->data))
            {
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                $this->redirect('/admin/emailaccs');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['emailacc_id'];
            if($this->Emailacc->delete($id))
            {
                $this->Session->setFlash('Đã xóa', 'flashSuccess');
            }
        }
    }
}