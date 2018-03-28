<?php
class Emailacc extends AppModel
{
    //
    public $useTable = 'emails';
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên hiển thị trên email không để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Tên hiển thị từ %d đến %d ký tự'
            )
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Email không để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Email từ %d đến %d ký tự'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Nhập đúng email'
            ),
            'isUnique' => array(
                'rule'    => array('isUnique'),
                'message' => 'Email này đã tồn tại',
                'on' => 'create'
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Mật khẩu không để trống'
            ),
            'between' => array(
                'rule' => array('between', 6, 50),
                'message' => 'Mật khẩu từ %d đến %d ký tự'
            )
        ),
        'host' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Host name không để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Host name từ %d đến %d ký tự'
            )
        ),
        'port' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Port không để trống'
            ),
            'between' => array(
                'rule' => array('between', 2, 4),
                'message' => 'Port từ %d đến %d ký tự'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Vui lòng nhập đúng port'
            )
        ),
    );
}