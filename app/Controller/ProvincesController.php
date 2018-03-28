<?php
class ProvincesController extends AppController
{
    public $components = array('RequestHandler', 'Paginator', 'Library');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
    /////////
    //Update link
    function updatelink()
    {
        $this->redirect('/');
        $this->Province->recursive = -1;
        $provinces = $this->Province->find('all');
        foreach ($provinces as $item)
        {
            $link = $this->Library->make_link($item['Province']['provincename']);
            $data_update = array(
                'Province.provincelink' => "'$link'"
            );
            $this->Province->updateAll($data_update, array('Province.id' => $item['Province']['id']));
        }
    }
    /////////
    public function get_location($province_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $province_id = $this->request->data['province_id'];
            $province = $this->Province->find('first', array(
                'fields' => array('Province.longitude', 'Province.latitude'),
                'conditions' => array('Province.id' => $province_id)
            ));
            if($province)
            {
                $data = array(
                    'longitude' => $province['Province']['longitude'],
                    'latitude' => $province['Province']['latitude'],
                );
                echo json_encode($data);
            }
        }
    }

   ////////////////////////////////////
   ////////////////////////////////////
    ////Admin
    ///////////////////////////////////
    ///////////////////////////////////

    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Province->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'order' => array(
                'provincename' => 'ASC'
            ),
        );
        try
        {
            $provinces = $this->paginate('Province');
            if($provinces)
            {
                $this->set(
                    array(
                        'provinces' => $provinces
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
        $this->set(array('title' => 'Danh sách tỉnh thành'));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->set(array('title' => 'Thêm tỉnh thành'));
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Province->set('provincelink', $this->Library->make_link($this->request->data['Province']['provincename']));
            if($this->Province->save($this->request->data))
            {
                $this->Session->setFlash('Đã thêm', 'flashSuccess');
                $this->redirect('/admin/provinces');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $provinces = $this->Province->findById($id);
        if(!$provinces)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/provinces');
        }
        $this->set(array(
            'provinces' => $provinces,
            'title' => 'Sửa tỉnh thành'
        ));
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Province->set('provincelink', $this->Library->make_link($this->request->data['Province']['provincename']));
            if($this->Province->save($this->request->data))
            {
                //Update link
                $this->Session->setFlash('Đã sửa', 'flashSuccess');
                if(isset($this->request->data['redirect_url']) && $this->request->data['redirect_url'] != '')
                {
                    $this->redirect($this->request->data['redirect_url']);
                }
                else
                {
                    $this->redirect('/admin/provinces');
                }
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['province_id'];
            $this->Province->District->recursive = -1;
            $count = $this->Province->District->find("count", array("conditions" => array("province_id" => $id)));
            if ($count == 0)
            {
                if($this->Province->delete($id))
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