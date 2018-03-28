<?php
class Utility extends AppModel
{
    public $useTable = 'utilities';
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
    public $validate = array(

    );
}