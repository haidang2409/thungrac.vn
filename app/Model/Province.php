<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/17/2017
 * Time: 1:25 PM
 */
class Province extends AppModel
{
    public $hasMany = array(
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'province_id'
        )
    );
    //Validate
    public $validate = array(
        'provincename' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên tỉnh thành không được trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Tên tỉnh thành từ %d đến %d ký tự'
            ),
        ),
        'longitude' => array(
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
        'latitude' => array(
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
        )
    );


}