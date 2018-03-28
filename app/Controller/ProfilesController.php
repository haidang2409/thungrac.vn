<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/17/2017
 * Time: 11:49 AM
 */
App::uses('Appcontroller', 'Controller');
class ProfilesController extends AppController
{
    var $belongsTo = array(
        'Member' => array(
            'className' => 'Members',
            'foreignKey' => 'member_id'
        )
    );
}