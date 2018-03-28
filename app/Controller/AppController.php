<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array('Lib', 'Html', 'Form', 'Session');
    public $components = array('Session', 'Cookie');
    //////////////////////
    //Path products
    public $path_product = '../webroot/uploads/products';
    public $path_product_thumb = '../webroot/uploads/products/thumb';
    public $path_member_avatar = '../webroot/img/members';
    ///Commons
    public $phone = '0901 032 320';
    public $email = 'cskh@dream.edu.vn';
    //
    function beforeFilter()
    {
//        debug($this->request->clientIp());
//        header('X-Powered-By: SAMORINE');
        //header('Server: NHADAT');
        $this->_setLanguage();
        if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')
        {
            if($this->Session->check('Admin'))
            {
                $this->layout = 'admin_default';
            }
        }
        if(!isset($this->params['prefix']))
        {
            //Set data for menu and search
            $categories_menu = null;
            ClassRegistry::init('Category')->recursive = -1;
            $categories_menu = ClassRegistry::init('Category')->find('threaded', array(
                'order' => array('sort' => 'ASC')
            ));
            //Provinces
            $provinces = null;
            ClassRegistry::init('Province')->recursive = -1;
            $province = ClassRegistry::init('Province')->find('all', array(
                'order' => array('Province.sort' => 'ASC', 'Province.provincename' => 'ASC')
            ));
            foreach ($province as $item)
            {
                $provinces[$item['Province']['provincelink']] = $item['Province']['provincename'];
            }
            $this->set(
                array
                (
                    'province_location' => $provinces,
                    'categories_menu' => $categories_menu,
                    '_phone' => $this->phone,
                    '_email' => $this->email,
                )
            );

        }


    }
//Đa ngôn ngữ
    function _setLanguage()
    {
        //Nếu có cookie
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }
        elseif(isset($this->params['url']['language']) && ($this->params['url']['language'] != $this->Session->read('Config.language'))) {
            $this->Session->write('Config.language', $this->params['url']['language']);
            $this->Cookie->write('lang', $this->params['url']['language'], false, '60 minutes');
        }
//        elseif(isset($this->params->params["named"]['language']) && ($this->params->params["named"]['language'] != $this->Session->read('Config.language'))) {
//            $this->Session->write('Config.language', $this->params->params["named"]['language']);
//            $this->Cookie->write('lang', $this->params->params["named"]['language'], false, '1 minutes');
//        }
    }

}
