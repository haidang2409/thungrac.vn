<?php
class Commentproduct extends AppModel
{
    public $useTable = 'comment_products';

    public $validate = array(
        'comment' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Không được để trống'
            ),
        )
    );
}