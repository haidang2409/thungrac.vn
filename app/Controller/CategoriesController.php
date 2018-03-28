<?php

class CategoriesController extends AppController
{
    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
    public function get_category($parent_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $parent_id = $this->request->data['parent_id'];
            $options = '<option value=""> -- Chọn -- </option>';
            $this->Category->recursive = -1;
            $category_data = $this->Category->find('all', array(
                'fields' => array('Category.id', 'Category.categoryname'),
                'conditions' => array('Category.parent_id' => $parent_id),
                'order' => array('Category.sort' => 'ASC')
            ));
            foreach ($category_data as $item)
            {
                $options = $options . '<option value="' . $item['Category']['id'] .'">' . $item['Category']['categoryname'] . '</option>';
            }
            echo $options;
        }
    }
    public function get_feature($category_id = null)
    {
        $this->autoRender = false;
        if($this->request->is('post'))
        {
            $category_id = $this->request->data['category_id'];
            ClassRegistry::init('Feature')->recursive = -1;
            $option = ClassRegistry::init('Feature')->find('all', array(
                'conditions' => array('category_id' => $category_id)
            ));
            $this->Category->recursive = -1;
            $categories = $this->Category->findById($category_id);
            $feature_note = '';
            if($categories)
            {
                $feature_note = $categories['Category']['feature_note'];
            }
            if($option)
            {
                $select = '<div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">' . $feature_note . '</label>
                                <div class="col-sm-6 col-xs-12">';
                $select = $select . '<select name="data[Product][feature_id]" id="feature_id" style="width: 100% !important" required="required">';
                $select = $select . '<option value=""> -- Chọn -- </option>';
                foreach ($option as $item)
                {
                    $select = $select . '<option value="' . $item['Feature']['id'] .'">' . $item['Feature']['feature'] . '</option>';
                }
                $select = $select . '</select></div></div>';
                echo $select;
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
        //
        //Set group
        $parents = null;
        $this->Category->recursive = -1;
        $parent = $this->Category->find('all', array(
            'conditions' => array('parent_id' => 0)
        ));
        foreach ($parent as $item) {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        $this->set(array('parents' => $parents));
        //Search
        $condition_parent = '';
        if(isset($this->params['url']['parent']))
        {
            $condition_parent = 'Category.parent_id = ' . $this->params['url']['parent'];
        }
        $this->Category->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Parent',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Category.parent_id = Parent.id'
                )
            ),
            'paramType' => 'querystring',
            'fields' => array('*'),
            'limit' => '10',
            'order' => array(
                'id' => 'ASC'
            ),
            'conditions' => array(
                $condition_parent
            )
        );
        try
        {
            $categories = $this->paginate('Category');
            if($categories)
            {
                $this->set(
                    array(
                        'categories' => $categories
                    )
                );
            }
        }
        catch (NotFoundException $exception)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
        $this->set(array(
            'title' => 'Loại bất động sản'
        ));
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set group
        $parents = null;
        $this->Category->recursive = -1;
        $parent = $this->Category->find('all', array(
            'conditions' => array('Category.parent_id' => 0)
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //
        $this->set(array(
            'parents' => $parents,
            'title' => 'Thêm danh mục'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Category->save($this->request->data))
            {
                $this->Session->setFlash('Thêm thành công', 'flashSuccess');
                $this->redirect('/admin/categories');
            }
        }
    }
    function admin_edit($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Category
        $this->Category->recursive = -1;
        $categories = $this->Category->findById($id);
        if(!$categories)
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/categories');
        }
//        if()
        //Set group
        $parents = null;
        $this->Category->recursive = -1;
        $parent = $this->Category->find('all', array(
            'conditions' => array('Category.parent_id' => 0)
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //
        $this->set(array(
            'categories' => $categories,
            'parents' => $parents,
            'title' => 'Sửa danh mục'
        ));
        //Post
        if($this->request->is('post') || $this->request->is('put'))
        {
            if($this->Category->save($this->request->data))
            {
                $this->Session->setFlash('Sửa thành công', 'flashSuccess');
                $this->redirect('/admin/categories');
            }
            else
            {
                $this->Session->setFlash('Lỗi thêm', 'flashError');
            }
        }
    }
    function admin_delete()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            $id = $this->request->data['category_id'];
            $this->Category->Product->recursive = -1;
            $count = $this->Category->Product->find("count", array("conditions" => array("category_id" => $id)));
            if ($count == 0)
            {
                if($this->Category->delete($id))
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