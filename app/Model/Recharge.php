<?php
class Recharge extends AppModel
{
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        )
    );
    public $validate = array(

    );
}