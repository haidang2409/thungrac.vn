<?php
class StatisticsController extends AppController
{
    ///////////////////
    ///////////////////
    //Admin
    ///////////////////
    ///////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
    }
    function admin_group()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
//        //Search
//        $type = isset($this->params['url']['type'])? $this->params['url']['type']: '';
//        $condition_type = $type !=''? 'Transactiontype.id = ' . $type: '';
        //Set
        ClassRegistry::init('Category')->recursive = -1;
        $data = ClassRegistry::init('Category')->find('all', array(
            'fields' => array('Category.*', 'COUNT(`Product`.`id`) AS sum'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Childrencat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Childrencat.parent_id = Category.id'
                ),
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Childrencat.id = Product.category_id'
                ),
            ),
            'group' => array('Category.categoryname'),
            'order' => array('sum' => 'DESC'),
            'conditions' => array('Category.parent_id' => 0)
        ));
        if($data)
        {
            $this->set(array('data' => $data));
        }
        //Doanh thu
        ClassRegistry::init('Category')->recursive = -1;
        $data_2 = ClassRegistry::init('Category')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Childrencat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Childrencat.parent_id = Category.id'
                ),
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Childrencat.id = Product.category_id'
                ),
                array(
                    'table' => 'orders',
                    'alias' => 'Order',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.id = Order.product_id'
                )
            ),
            'fields' => array('Category.*', 'SUM(`Order`.`sumamount`) as sum'),
            'group' => array('Category.categoryname'),
            'order' => array('sum' => 'DESC'),
            'conditions' => array('Category.parent_id' => 0)
        ));
        $this->set(array('data2' => $data_2));
        $this->set(array(
            'title' => 'Thống kê theo nhóm tin'
        ));
    }
    function admin_month()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Search
        $date = getdate();
        $year = isset($this->params['url']['year'])? $this->params['url']['year']: $date['year'];
        //Set
        $data = null;
        for($i = 0; $i < 12; $i++)
        {
            ClassRegistry::init('Product')->recursive = -1;
            $product = ClassRegistry::init('Product')->find('count', array(
                'conditions' => array(
                    'YEAR(Product.created)' => $year,
                    'MONTH(Product.created)' => $i + 1
                )
            ));
            $data[$i] = array(
                $product
            );
        }
        //
        $data2 = null;
        for($i = 0; $i < 12; $i++)
        {
            ClassRegistry::init('Order')->recursive = -1;
            $order = ClassRegistry::init('Order')->find('first', array(
                'conditions' => array(
                    'YEAR(Order.created)' => $year,
                    'MONTH(Order.created)' => $i + 1
                ),
                'fields' => array('SUM(`Order`.`sumamount`) as total')
            ));
            $data2[$i] = array(
                isset($order[0]['total'])? $order[0]['total']: 0
            );
        }
        $this->set(array('data' => $data, 'data2' => $data2));
        $this->set(array(
            'title' => 'Thống kê theo tháng'
        ));
    }
}