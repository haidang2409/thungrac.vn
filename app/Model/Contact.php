<?php
class Contact extends AppModel
{
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => 'notBlank'
            )
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank'
            ),
            'email' => array(
                'rule' => array('email', true)
            )
        ),
        'phone' => array(
            'notBlank' => array(
                'rule' => 'notBlank'
            ),
            'numeric' => array(
                'rule' => 'numeric'
            ),
            'between' => array(
                'rule' => array('between', 10, 11)
            )
        ),
        'content' => array(
            'notBlank' => array(
                'rule' => 'notBlank'
            ),
        )
    );
}