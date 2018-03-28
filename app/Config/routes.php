<?php
Router::parseExtensions('html', 'rss');
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

//Trang chủ
Router::connect('/', array('controller' => 'products', 'action' => 'index'));
//Đăng tin bất động sản
Router::connect('/dang-tin', array('controller' => 'products', 'action' => 'add'));
//Sử tin bất động sản
Router::connect('/sua-tin', array('controller' => 'products', 'action' => 'edit'));
//Rao vat
Router::connect('/rao-vat/toan-quoc/mua-ban', array('controller' => 'products', 'action' => 'index_product'));
//
Router::connect('/rao-vat/:location/:category', array('controller' => 'products', 'action' => 'index_product',
    array(
        'pass' => array('location', 'category'),
        'location' => '[a-z0-9-]',
        'category' => '[a-z0-9-]'
    )
));

//View product
Router::connect('/rao-vat/:product_title-:id',
    array(
        'controller' => 'products',
        'action' => 'view'
    ),
    array(
        'pass' => array('product_title', 'id'),
        'product_title' => '[a-z0-9-]+',
        'id' => '[0-9]+'
    ));


//About

Router::connect('/a/help', array('controller' => 'helps', 'action' => 'index'));
Router::connect('/a/gia-dich-vu-dang-tin', array('controller' => 'packets', 'action' => 'index'));
Router::connect('/a/gia-dich-vu-quang-cao', array('controller' => 'helps', 'action' => 'dichvuquangcao'));
Router::connect('/a/gioi-thieu', array('controller' => 'helps', 'action' => 'about'));
Router::connect('/a/lien-he', array('controller' => 'helps', 'action' => 'contact'));
Router::connect('/a/lich-su-hinh-thanh', array('controller' => '', 'action' => ''));
//Help
Router::connect('/help/huong-dan-dang-tin', array('controller' => 'helps', 'action' => 'huongdandangtin'));
Router::connect('/help/huong-dan-thanh-toan', array('controller' => 'helps', 'action' => 'huongdanthanhtoan'));
Router::connect('/help/dieu-khoan-su-dung', array('controller' => 'helps', 'action' => 'dieukhoansudung'));
Router::connect('/help/dieu-khoan-bao-mat', array('controller' => 'helps', 'action' => 'dieukhoanbaomat'));


/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//////////////////////////////////
//Front-End
//////////////////////////////////
//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));




/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */

/////////////////////////////////////
//Back-End
/////////////////////////////////////
Router::connect('/admin', array('controller' => 'staffs', 'action' => 'login', 'prefix' => 'admin',));
Router::connect('/admin/home', array('controller' => 'staffs', 'action' => 'home', 'prefix' => 'admin',));
Router::connect('/admin/login', array('controller' => 'staffs', 'action' => 'login', 'prefix' => 'admin', 'admin' => false));
Router::connect('/admin/logout', array('controller' => 'staffs', 'action' => 'logout', 'prefix' => 'admin'));
//Members




///////////////////////////////////
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
