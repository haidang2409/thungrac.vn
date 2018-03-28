<?php
class OrdersController extends AppController
{
    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
    ////////////////////////////////////
    ////////////////////////////////////
    //Admin
    ////////////////////////////////////
    ////////////////////////////////////
    function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $url = $this->params['url'];
        //Packet
        $paket_id = isset($url['packet'])? $url['packet'] : 0;
        $con_packet_id = '';
        if($paket_id != 0)
        {
            $con_packet_id = 'Packet.id = ' . $paket_id;
        }
        //Name
        $name = isset($url['name'])? $url['name']: '';
        $con_username = '';
        $con_email = '';
        if($name != '')
        {
            $con_email = 'Member.email = "' . $name . '"';
            $con_username = 'Member.username = "' . $name . '"';
        }
        //Sattus
        $status = isset($url['status'])? $url['status']: '';
        $con_status = $status != ''? 'Order.status = ' . $status: '';
        //Set
        $packets = null;
        $this->Order->Packet->recursive = -1;
        $packet = $this->Order->Packet->find('all', array(
            'order' => array('sort' => 'ASC')
        ));
        foreach ($packet as $item)
        {
            $packets[$item['Packet']['id']] = $item['Packet']['packetname'];
        }
        $this->set(array(
            'packets' => $packets,
            'packet_id' => $paket_id,
            'status' => $status
        ));
        //
        $this->Order->recursive = -1;
        $this->paginate = array(
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Order.product_id = Product.id'
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Product.member_id = Member.id'
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Order.packet_id = Packet.id'
                ),
                array(
                    'table' => 'staffs',
                    'alias' => 'Staff',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Order.staff_id = Staff.id'
                ),
            ),
            'limit' => 10,
            'order' => array('Order.id' => 'DESC'),
            'fields' => array('*'),
            'paramType' => 'querystring',
            'conditions' => array(
                'OR' => array(
                    $con_username,
                    $con_email
                ),
                $con_packet_id,
                $con_status
            )
        );
        try
        {
            $orders = $this->paginate('Order');
            if($orders)
            {
                $sum_amount = $this->Order->find('first', array(
                    'fields' => array('SUM(Order.sumamount) AS total')
                ));
                $this->set(array(
                    'packets' => $packets,
                    'orders' => $orders,
                    'title' => 'Danh sách hóa đơn',
                    'total' => $sum_amount[0],
                ));
            }
        }
        catch (NotFoundException $e)
        {
//            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
        }
    }
    function admin_add()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }

    }
    function admin_edit()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }

    }


}