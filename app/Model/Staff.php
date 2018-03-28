<?php
App::uses('AuthComponent', 'Controller/Component');
class Staff extends AppModel
{
    public $hasMany = array(
        'Recruiment' => array(
            'className' => 'Recruiment',
            'foreignKey' => 'staff_id'
        ),
        'Order' => array(
            'className' => 'Order',
            'foreign' => 'staff_id'
        ),
    );
    public $belongsTo = array(
        'Ward' => array(
            'className' => 'Ward',
            'foreignKey' => 'ward_id'
        ),
    );
    public $validate = array(
        'email' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Email không được để trống',
            ),
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Nhập đúng địa chỉ email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email đã tồn tại trên hệ thống'
            )
        ),
        'fullname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Họ tên không được để trống'
            ),
            'between' => array(
                'rule' => array('between' , 5, 50),
                'message' => 'Họ tên từ %d đến %d ký tự'
            )
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Mật khẩu không được để trống',
                'on' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 8, 32),
                'message' => 'Mật khẩu phải từ %d đến %d ký tự',
                'on' => 'create'
            )
        ),
        'birth' => array(
            'date' => array(
                'rule' => array('date', 'dmy'),
                'message' => 'Nhập đúng ngày tháng năm',
                'allowEmpty' => true
            ),
        ),
        'phonenumber' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng số điện thoại của bạn',
                'allowEmpty' => true
            ),
            'between' => array(
                'rule' => array('between', 10, 11),
                'message' => 'Nhập đúng số điện thoại của bạn',
                'allowEmpty' => true
            ),
        ),
        'role' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Chọn quyền'
            ),
            'inList' => array(
                'rule' => array('inList', array(1, 2, 3)),
                'message' => 'Vui lòng chọn đúng giá trị liệt kê'
            )
        )
    );

    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        if (isset($this->data[$this->alias]['fullname'])) {
            $this->data[$this->alias]['fullname'] = htmlentities($this->data[$this->alias]['fullname'], ENT_QUOTES);
        }
        return parent::beforeSave($options);
    }
}