<?php
class Image extends AppModel
{
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );
    public $validate = array(
        'imagelink' => array(
            'extension' => array(
                'rule' => array('extension', array('jpg', 'png', 'jpeg')),
                'message' => 'Vui lòng chọn hình ảnh'
            )
        )
    );
    //Image
    public $actsAs = array(
        'Upload.Upload' => array(
            'path' => '{ROOT}{DS}webroot{DS}img{DS}{model}{DS}{field}{DS}',
            'imagelink' => array(
                'fields' => array(
                    'dir' => 'imagedir'
                )
            )
        )
    );

}