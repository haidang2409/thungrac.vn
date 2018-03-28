<?php
class Feature extends AppModel
{
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'feature_id'
        )
    );
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'feature_id'
        )
    );
    public $validate = array(
        'category_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn chuyên mục'
            ),
        ),
        'feature' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Không được để trống'
            )
        )
    );
}