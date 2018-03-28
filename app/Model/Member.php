<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/16/2017
 * Time: 3:54 PM
 */
App::uses('AuthComponent', 'Controller/Component');
class Member extends AppModel
{
    public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => 'member_id'
        )
    );
    public $belongsTo = array(
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'district_id',
        )
    );
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'member_id'
        ),
        'Atm' => array(
            'className' => 'Atm',
            'foreignKey' => 'member_id'
        ),
        'Recharge' => array(
            'className' => 'Recharge',
            'foreignKey' => 'member_id'
        ),
        'Memberproduct' => array(
            'className' => 'Memberproduct',
            'foreignKey' => 'member_id'
        ),
    );
    public $validate = array(
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Tên đăng nhập không được để trống',
                'allowEmpty' => false,
                'on' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 6, 50),
                'required' => true,
                'message' => 'Tên đăng nhập phải từ 6 đến 50 ký tự',
                'on' => 'create'
            ),
            'isUnique' => array(
                'rule'    => array('isUnique'),
                'message' => 'Tên đăng nhập đã có người sử dụng',
                'on' => 'create'
            ),
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập địa chỉ email của bạn',
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Nhập đúng địa chỉ email của bạn'
            ),
            'isUnique' => array(
                'rule'    => array('isUnique'),
                'message' => 'Địa chỉ email này đã đăng ký tài khoản rồi',
                'on' => 'create'
            ),
        ),
        'fullname' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Họ tên không được để trống',
            ),
        ),
        'phonenumber' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Số điện thoại không được để trống',
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Nhập đúng số điện thoại của bạn',
            ),
            'between' => array(
                'rule' => array('between', 10, 11),
                'message' => 'Nhập đúng số điện thoại của bạn'
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Mật khẩu không được để trống',
//                'on' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 8, 32),
                'message' => 'Mật khẩu phải từ %d đến %d ký tự',
//                'on' => 'create'
            ),
        ),
        'repassword' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Xác nhận lại mật khẩu',
                'on' => 'create'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Mật khẩu không khớp nhau',
                'on' => 'create'
            )
        ),
        'password_old' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Nhập mật khẩu cũ',
                'on' => 'update'
            ),
            'incorrect' => array(
                'rule' => array('checkpassword'),
                'message' => 'Mật khẩu cũ không đúng',
                'on' => 'update'
            ),
        ),
        'password_new' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Mật khẩu không được để trống',
                'on' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 8, 32),
                'message' => 'Mật khẩu phải từ %d đến %d ký tự',
                'on' => 'update'
            ),
        ),
        're_password_new' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Xác nhận lại mật khẩu',
                'on' => 'update'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield','password_new'),
                'message' => 'Mật khẩu không khớp nhau',
                'on' => 'update'
            )
        ),
    );

    public function equaltofield($check, $otherfield)
    {
        $fname = '';
        foreach ($check as $key => $value)
        {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }
    public function isUniqueUsername($check)
    {
        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'Member.id',
                    'Member.username'
                ),
                'conditions' => array(
                    'Member.username' => $check['username']
                )
            )
        );
        if(!empty($username))
        {
            if($this->data[$this->alias]['id'] == $username['Member']['id'])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }
    public function checkpassword($check)
    {
        $password = $this->find(
            'first',
            array(
                'fields' => array(
                    'Member.id',
                    'Member.password'
                ),
                'conditions' => array(
                    'Member.password' => AuthComponent::password($check['password_old'])
                )
            )
        );
        if(!empty($password))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
//        if (isset($this->data[$this->alias]['fullname'])) {
//            $this->data[$this->alias]['fullname'] = htmlentities($this->data[$this->alias]['fullname'], ENT_QUOTES);
//        }

        // if we get a new password, hash it
//        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
//            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
//        }
        // fallback to our parent
        return parent::beforeSave($options);
    }
}