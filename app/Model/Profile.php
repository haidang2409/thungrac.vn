<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/17/2017
 * Time: 11:43 AM
 */
class Profile extends AppModel
{
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        )
    );
}