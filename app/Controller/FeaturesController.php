<?php

class FeaturesController extends AppController
{
    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');

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
        //
        //Set group
        $categories = null;
        $this->Feature->Category->recursive = -1;
        $category = $this->Feature->Category->find('all', array(
            'conditions' => array('parent_id != 0')
        ));
        foreach ($category as $item) {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        $this->set(array('categories' => $categories));
        //Search
        $condition_category = '';
        if(isset($this->params['url']['category']))
        {
            $condition_category = 'Feature.category_id = ' . $this->params['url']['category'];
        }
        $this->Feature->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Feature.category_id = Category.id'
                )
            ),
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'order' => array(
                'id' => 'ASC'
            ),
            'conditions' => array(
                $condition_category
            )
        );
        try
        {
            $features = $this->paginate('Feature');
            if($features)
            {
                $this->set(
                    array(
                        'features' => $features
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
        $this->set(array(
            'title' => 'Đặc điểm, sản xuất, ngành nghề'
        ));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set group
        $categories = null;
        $this->Feature->Category->recursive = -1;
        $category = $this->Feature->Category->find('all', array(
            'conditions' => array('Category.parent_id != 0')
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //
        $this->set(array(
            'categories' => $categories,
            'title' => 'Thêm đặc điểm'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Feature->save($this->request->data))
            {
                $this->Session->setFlash('Thêm thành công', 'flashSuccess');
                if(isset($this->request->data['btnSaveAndAdd']))
                {
                    $this->redirect('/admin/features/add?category_id=' . $this->request->data['Feature']['category_id']);
                }
                else
                {
                    $this->redirect('/admin/features');
                }
            }
        }
    }
    function admin_edit($id = 0)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set group
        $categories = null;
        $this->Feature->Category->recursive = -1;
        $category = $this->Feature->Category->find('all', array(
            'conditions' => array('Category.parent_id != 0')
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //
        $this->Feature->recursive = -1;
        $feature_edit = $this->Feature->findById($id);
        $this->set(array(
            'features' => $feature_edit,
            'categories' => $categories,
            'title' => 'Sửa đặc điểm'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Feature->save($this->request->data))
            {
                $this->Session->setFlash('Thêm thành công', 'flashSuccess');
                if(isset($this->request->data['btnSaveAndAdd']))
                {
                    $this->redirect('/admin/features/add?category_id=' . $this->request->data['Feature']['category_id']);
                }
                else
                {
                    $this->redirect('/admin/features');
                }
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['feature_id'];
            $this->Feature->Product->recursive = -1;
            $count = $this->Feature->Product->find("count", array("conditions" => array("feature_id" => $id)));
            if ($count == 0)
            {
                if($this->Feature->delete($id))
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