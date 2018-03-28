<?php

class Product extends AppModel
{
    public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'Packet' => array(
            'className' => 'Packet',
            'foreignKey' => 'packet_id'
        ),
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'district_id'
        ),
        'Feature' => array(
            'className' => 'Feature',
            'foreignKey' => 'feature_id'
        )
    );
    public $hasMany = array(
        'Image' => array(
            'className' => 'Image',
            'foreignKey' => 'product_id'
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'product_id'
        ),
        'Memberproduct' => array(
            'className' => 'Memberproduct',
            'foreignKey' => 'product_id'
        ),
    );
    //Validation
    public $validate = array(
        'parent_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn'
            )
        ),
        'category_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn'
            )
        ),
        'district_id' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn quận huyện'
            )
        ),
        'province' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Chọn tỉnh thành'
            )
        ),
        'title' => array(
            'notBalnk' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập tiêu đề cho tin đăng của bạn'
            ),
            'between' => array(
                'rule' => array('between', 20, 70),
                'message' => 'Tiêu đề tin đăng phải từ %d đến %d ký tự'
            )
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập mô tả chi tiết'
            ),
            'between' => array(
                'rule' => array('between', 50, 4000),
                'message' => 'Mô tả từ %d đến %d ký tự'
            )
        ),
        'phonenumber' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập số điện thoại của bạn'
            ),
            'between' => array(
                'rule' => array('between', 10, 11),
                'message' => 'Vui lòng nhập đúng số điện thoại của bạn'
            )
        ),
        'fullname' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập họ tên để liên hệ'
            ),
        ),
        'price' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập giá bán'
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Vui lòng nhập đúng giá'
            )
        ),

    );
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //Function
    /* Custom validation function */
    public function comparisonWithField($validationFields = array(), $operator = null, $compareFieldName = '') {
        if (!isset($this->data[$this->name][$compareFieldName])) {
            throw new CakeException(sprintf(__('Can\'t compare to the non-existing field "%s" of model %s.'), $compareFieldName, $this->name));
        }
        $compareTo = $this->data[$this->name][$compareFieldName];
        foreach ($validationFields as $key => $value) {
            if (!Validation::comparison($value, $operator, $compareTo)) {
                return false;
            }
        }
        return true;
    }



}