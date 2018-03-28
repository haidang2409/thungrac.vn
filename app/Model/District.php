<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/17/2017
 * Time: 1:27 PM
 */
class District extends AppModel
{
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'district_id'
        ),
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        )
    );
    public $belongsTo = array(
        'Province' => array(
            'className' => 'Province',
            'foreignKey' => 'province_id'
        )
    );
    public $validate = array(
        'districtname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên quận huyện không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 1, 50),
                'message' => 'Tên quận huyện từ %d đến %d ký tự'
            )
        ),
        'latitude' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Kinh độ không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng kinh độ'
            ),
            'more_than' => array(
                'rule' => array('comparison', '>=', 100),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
            'less_than' => array(
                'rule' => array('comparison', '<=', 120),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
        ),
        'longitude' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Vỹ độ không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng vỹ độ'
            ),
            'more_than' => array(
                'rule' => array('comparison', '>=', 8),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
            'less_than' => array(
                'rule' => array('comparison', '<=', 30),
                'message' => 'Nhập đúng tọa độ của tỉnh thành'
            ),
        ),
    );
}