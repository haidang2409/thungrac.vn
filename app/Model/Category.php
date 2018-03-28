<?php
class Category extends AppModel
{
    
    public $useTable = 'categories';
//    public $actsAs = array('Tree');
    var $displayField = 'categoryname';
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'category_id'
        ),
        'Feature' => array(
            'className' => 'Feature',
            'foreignKey' => 'feature_id'
        )
    );
//    public $belongsTo = array(
//        'Parentcat' => array(
//            'className' => 'Category',
//            'foreignKey' => 'parent_id'
//        )
//    );
    public $validate = array(
        'categoryname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Tên loại bất động sản không được để trống'
            ),
        ),
        'categorylink' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Nhập link cho loại bất động sản'
            ),
            'pattern' => array(
                'rule'      => '/^[0-9a-z-]+$/',
                'message'   => 'Link không có khoảng trắng',
            ),
        ),
    );
}