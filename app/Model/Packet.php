<?php
class Packet extends AppModel
{
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'packet_id'
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'packet_id'
        )
    );

    public $validate = array(
        'packetname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên gói tin không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 5, 50),
                'message' => 'Tên gói tin từ %d đến %d ký tự'
            )
        ),
        'price' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Giá không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng giá'
            )
        ),
        'discount' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => 'Nhập đúng giá'
            )
        ),
        'date' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Thời gian gói tin không được để trống'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng thời gian'
            ),
            'comparison' => array(
                'rule' => array('comparison', '>=', 10),
                'message' => 'Số ngày phải lớn hơn hoặc bằng 10'
            )
        ),
        'summary' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Mô tả không được để trống'
            ),
            'between' => array(
                'rule' => array('between', 50, 5000),
                'message' => 'Mô tả từ %d đến %d ký tự'
            )
        )

    );
}