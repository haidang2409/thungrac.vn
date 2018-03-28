<?php
class Order extends AppModel
{
    public $useTable = 'orders';
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        ),
        'Packet' => array(
            'className' => 'Packet',
            'foreignKey' => 'packet_id'
        )
    );
}