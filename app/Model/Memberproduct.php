<?php
class Memberproduct extends AppModel
{
    public $useTable = 'members_products';
    public $belongTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        ),
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
}