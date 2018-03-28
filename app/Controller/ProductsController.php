<?php
class ProductsController extends AppController
{
    public $components = array('RequestHandler', 'Paginator', 'Library');
    public $helpers = array('Js' => array('Jquery'), 'Paginator', 'Html');
//    public
    ////////////////////////////////////////
    ////////////////////////////////////////
    //User
    ////////////////////////////////////////
    ////////////////////////////////////////
    public function api_get_products($serect_key = '', $site_key = '')
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->response->type('json');
        $result = array();
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        //
        $this->Product->recursive = -1;
        $product_new = $this->Product->find('all', array(
            'limit' => '6',
            'fields' => array(
                'Product.title',
                'Product.id',
                'Product.productlink',
                'Product.image',
                'Product.price',
                'District.districttype',
                'District.districtname',
                'Province.provincename'
            ),
            'joins' => array(
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                //'Product.expiry >= "' . $cur_date . '"'
            ),
            'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
        ));
        if($product_new)
        {
            $i = 0;
            foreach ($product_new as $item)
            {
                $image_link = "http://thanhlycantho.com/uploads/products/no-image-product.png";
                if($item['Product']['image'] != '' && file_exists($this->path_product_thumb . '/' . $item['Product']['image']))
                {
                    $image_link = "http://thanhlycantho.com/uploads/products/thumb/" . $item['Product']['image'];
                }
                $title = htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                $address = htmlentities($item['District']['districttype'] . ' ' . $item['District']['districtname'] . ', ' . $item['Province']['provincename'], ENT_QUOTES, 'UTF-8');
                $price = '';
                if($item['Product']['price'] == 0)
                {
                    $price = 'Thỏa thuận';
                }
                else
                {
                    $price = number_format($item['Product']['price'], 0, '', '.');
                }
                $result[$i] = array(
                    'title' => $title,
                    'productlink' => 'http://thanhlycantho.com/rao-vat/' . $item['Product']['productlink'] . '-' . $item['Product']['id'],
                    'address' => $address,
                    'price' => $price,
                    'image' => $image_link,

                );
                $i = $i + 1;
            }
            echo json_encode($result);
            $this->response->header('Access-Control-Allow-Origin', '*');
            $this->response->header('Content-type: application/json; charset=utf-8');
            // $this->response->header("Content-length: 96000");
        }
    }
//    Test sms


    //Home trang chủ

    public function index()
    {
        $this->layout = 'default';
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '12',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                //Dieu kien mac dinh
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                //'Product.expiry >= "' . $cur_date . '"',
                //Dieu kien tim kiem
            ),
            'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $this->Session->setFlash('Not found', 'flashError');
        }
        $this->set(array(
            'products' => $product,
        ));

        //Tim kiem
        //Province
        $provinces = null;
        $this->set(array(
            'title' => 'Chợ đồ cũ Cần Thơ | Hàng thanh lý',
            'provinces' => $provinces,
        ));
    }
    //nha-dat
    public function index_product()
    {
        $this->layout = 'default_product';
        //Title
        $title_location = '';
        $title = 'Chợ đồ cũ, thanh lý ';
        //Category
        $category_search = isset($this->params['category'])? $this->params['category']: '';
        $condition_category = '';
        //Kiem tra category có children hay không
        $cat_temp = $this->Product->Category->findByCategorylink($category_search);
        if($cat_temp)
        {
            if($cat_temp['Category']['parent_id'] == 0)
            {
                $condition_category = 'Category.parent_id = ' . $cat_temp['Category']['id'];
            }
            else
            {
                $condition_category = 'Category.id = ' . $cat_temp['Category']['id'];
            }
        }
        //Location
        $location_search = isset($this->params['location'])? $this->params['location']: '';
        $condition_location = $location_search != '' && $location_search != 'toan-quoc'? 'Province.provincelink = "' . $location_search . '"': '';
        //Query string
        $url = $this->params['url'];
        //Dieu kien tim kiem
        //Giá
        $price_min = isset($url['price_min'])? $url['price_min']: 0;
        $price_max = isset($url['price_max'])? $url['price_max']: 0;
        $condition_price_min = ($price_min > 0)? 'Product.price >= ' . $price_min: '';
        $condition_price_max = ($price_max > 0)? 'Product.price <= ' . $price_max: '';
        //Key
        $key_search = isset($url['q'])? $url['q']: '';
        $condition_key = ($key_search != '')? 'Product.title LIKE "%' . $key_search . '%"': '';
        //Type //sony //apple...
        $type_search = isset($url['t'])? $url['t']: '';
        $condition_type = ($type_search != '')? 'Product.feature_id = ' . $type_search: '';
        //End dieu kien tim kiem
        //Dieu kien mac dinh
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///

        //Province Breakcrumb
        $this->Product->District->Province->recursive = -1;
        $breadcrumb_province = $this->Product->District->Province->find('first', array(
            'conditions' => array(
                'Province.provincelink' => $location_search
            )
        ));
        if($breadcrumb_province)
        {
            $this->set(
                array(
                    'breadcrumb_province' => $breadcrumb_province
                )
            );
            $title = $title . $breadcrumb_province['Province']['provincename'];
            $title_location = $breadcrumb_province['Province']['provincename'];
        }
        //
        //District
        $districts = null;
        $this->Product->District->recursive = -1;
        $districts = $this->Product->District->find('all', array(
            'joins' => array(
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.province_id = Province.id')
                )
            ),
            'fileds' => array('District.*'),
            'conditions' => array('Province.provincelink' => $location_search)
        ));
        $this->set(array('districts' => $districts));
        //Sắp xếp
        $order = array(
            'Packet.sort' => 'asc',
            'Product.date_paid' => 'desc'
        );
        if(isset($url['srt']) && $url['srt'] == 'new')
        {
            $order = array(
                'Product.id' => 'desc'
            );
        }
        if(isset($url['srt']) && $url['srt'] == 'price_up')
        {
            $order = array(
                'Product.price' => 'asc'
            );
        }
        if(isset($url['srt']) && $url['srt'] == 'price_down')
        {
            $order = array(
                'Product.price' => 'desc'
            );
        }
        $product = null;
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '20',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                //Dieu kien mac dinh
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                //'Product.expiry >= "' . $cur_date . '"',
                //Group
                //Category
                $condition_category,
                //Dieu kien tim kiem
                $condition_price_min,
                $condition_price_max,
                $condition_location,
//                $condition_district,
                $condition_key,
                $condition_type
            ),
            'order' => $order
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {

        }
        //Load danh sách đặc điểm của danh mục
        //Ví dụ: xe máy (honda, yamaha,..
        //Tuyen dung: (IT - Phan mem, Quan tri mang
        ClassRegistry::init('Feature')->recursive = -1;
        $features = ClassRegistry::init('Feature')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => 'Feature.category_id = Category.id'
                ),
            ),
            'fields' => array('Feature.*', 'Category.col_size'),
            'conditions' => array('Category.categorylink' => $category_search)
        ));
        if($features)
        {
            $this->set(array('features' => $features));
        }
        //

        $this->set(array(
            'products' => $product,
        ));

//        //Title theo breakcrumb
//        //Set breadcrumb
        //Có children
        if($cat_temp)
        {
            if($cat_temp['Category']['parent_id'] == 0)
            {
                $this->Product->Category->recursive = -1;
                $breadcrumb_category = $this->Product->Category->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'categories',
                            'alias' => 'Childcat',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Category.id = Childcat.parent_id'
                        )
                    ),
                    'fields' => array('*'),
                    'conditions' => array('Category.categorylink' => $category_search)
                ));
                if($breadcrumb_category)
                {
                    $title = 'Mua bán ' . $breadcrumb_category[0]['Category']['categoryname'] . ' ' . $title_location;
                }
            }
            else
            {
                $this->Product->Category->recursive = -1;
                $breadcrumb_category = $this->Product->Category->find('all', array(
                    'joins' => array(
                        array(
                            'table' => 'categories',
                            'alias' => 'Childcat',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => 'Category.id = Childcat.parent_id'
                        )
                    ),
                    'fields' => array('*'),
                    'conditions' => array('Category.id' => $cat_temp['Category']['parent_id'])
                ));
                if($breadcrumb_category)
                {
                    $title = 'Mua bán ' . $cat_temp['Category']['categoryname'] . ' ' . $title_location;
                }
            }
            if($breadcrumb_category)
            {
                $this->set(array('breadcrumb_category' => $breadcrumb_category));
            }
        }
        $this->set(array(
            'title' => $title,
        ));
        //
    }

    public function view($title = null, $id = null)
    {
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        $this->Product->recursive = -1;
        //Product primary
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array
            (
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parent',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parent.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.status = 1',
                'Product.paid = 1',
                'Product.deleted = 0',
                //'Product.expiry >= "' . $cur_date . '"',
                'Product.productlink = "' . $title . '"',
                'Product.id = ' . $id
            ),
        ));

        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $id)
        ));
        if($product)
        {
            //Upadate view
            $this->Product->id = $id;
            $this->Product->saveField('view', (int)$this->Product->field('view') + 1);
            //
            //Lấy product liên quan
            $province_id = $product['Province']['id'];
            $category_id = $product['Category']['id'];
            $district_id = $product['District']['id'];
            $this->Product->recursive = -1;
            $product_relative = $this->Product->find('all', array(
                'limit' => '9',
                'fields' => array('*'),
                'joins' => array(
                    array(
                        'table' => 'categories',
                        'alias' => 'Category',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Category.id = Product.category_id')
                    ),
                    array(
                        'table' => 'members',
                        'alias' => 'Member',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('Product.member_id = Member.id')
                    ),
                    array(
                        'table' => 'districts',
                        'alias' => 'District',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('District.id = Product.district_id')
                    ),
                    array(
                        'table' => 'provinces',
                        'alias' => 'Province',
                        'type' => 'LEFT',
                        'foreignKey' => false,
                        'conditions' => array('Province.id = District.province_id')
                    ),
                    array(
                        'table' => 'packets',
                        'alias' => 'Packet',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array('Packet.id = Product.packet_id')
                    ),
                ),
                'conditions' => array(
                    'Product.status = 1',
                    'Product.paid = 1',
                    'Product.deleted = 0',
                    'Product.expiry >= "' . $cur_date . '"',
                    'Province.id' => $province_id,
                    // 'District.id = ' . $district_id,
                    'Category.id = ' . $category_id,
                    'Product.id != ' . $id),
                'order' => array('Packet.sort' => 'asc', 'Product.date_paid' => 'desc')
            ));
            //
            $profiles = null;
            $this->Product->Member->recursive = -1;
            $profiles = $this->Product->Member->find('first', array(
                'joins' => array(
                    array(
                        'table' => 'profiles',
                        'alias' => 'Profile',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => 'Member.id = Profile.member_id'
                    )
                ),
                'fields' => array('Profile.confirmpassport'),
                'conditions' => array('Profile.member_id' => $product['Member']['id'])
            ));
            //Keywords
            $keywords = array(
                'rao vặt',
                mb_strtolower($product['Parent']['categoryname']),
                mb_strtolower($product['Category']['categoryname']),
                mb_strtolower($product['Product']['title']),
                mb_strtolower($product['Province']['provincename']),
                mb_strtolower($product['District']['districttype'] . ' ' . $product['District']['districtname']),
            );
            $this->set(array(
                'head_description' => $product['Product']['summary'],
                'product' => $product,
                'images' => $images,
                'title' => $product['Product']['title'],
                'og_image' => $_SERVER['HTTP_HOST'] . ($product['Product']['image'] != ''? '/uploads/products/' . $product['Product']['image']: '/img/og_logo_default.jpg'),
                'product_relative' => $product_relative,
                'profiles' => $profiles,
                'keywords' => implode(', ', $keywords),
            ));
        }
        else
        {
            $this->set(array(
                'product' => null,
                'title' => 'Không tìm thấy trang',
            ));
        }
    }
    //
    public function add()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->Session->setFlash('Vui lòng đăng nhập', 'flashWarning');
            $this->redirect('/members/login');
        }
        //
        //Category parent
        $parents = null;
        $this->Product->Category->recursive = -1;
        $parent = $this->Product->Category->find('all', array(
            'order' => array('Category.sort' => 'ASC'),
            'conditions' => array('Category.parent_id = 0')
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $provinces = null;
        $this->Product->District->Province->recursive = -1;
        $province = $this->Product->District->Province->find('all', array(
            'order' => array('Province.sort' => 'ASC', 'Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon parent
        $categories_child = null;
        if(isset($this->request->data['Product']['parent_id']) && $this->request->data['Product']['parent_id'] != '')
        {
            $parent_id = $this->request->data['Product']['parent_id'];
            $this->Product->Category->recursive = -1;
            $categorie_child = $this->Product->Category->find('all', array(
                'conditions' => array('Category.parent_id' => $parent_id)
            ));
            foreach ($categorie_child as $item)
            {
                $categories_child[$item['Category']['id']] = $item['Category']['categoryname'];
            }
        }
        //Set data district neu co chon province
        $districts = null;
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
            $this->Product->District->recursive = -1;
            $district = $this->Product->District->find('all', array(
                'conditions' => array('District.province_id = ' . $province_id)
            ));
            foreach ($district as $item)
            {
                $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
            }
        }
        //
        $this->set(array(
            'provinces' => $provinces,
            'districts' => $districts,
            'member' => $member,
            'categories_parent' => $parents,
            'categories_child' => $categories_child,
            'title' => 'Đăng tin rao vặt'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $this->Product->set('member_id', $member_id);
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 5)
                {
                    $this->Session->setFlash('Bạn không được chọn quá 5 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                //check error image
                foreach ($images as $item)
                {
                    if($item['name'] == '')
                    {
                        $this->Session->setFlash('Vui lòng chọn hình ảnh cho tin đăng', 'flashWarning');
                        $err_image = true;
                        break;
                    }
                    if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                    {
                        $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                        $err_image = true;
                        break;
                    }
                    if($item['size'] > 2097152)
                    {
                        $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                        $err_image = true;
                        break;
                    }
                }
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    //Luu product
                    if($this->Product->save($this->request->data))
                    {
                        //Image
                        $date = getdate();
                        $year = $date['year'];
                        $month = $date['mon'];
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->Library->create_folder($year, $month, $this->path_product);
                        $path_thum = $this->Library->create_folder($year, $month, $this->path_product_thumb);
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                            $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                            if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                            {
                                //Đóng mọc hình ảnh
                                try
                                {
                                    $this->Library->img_resize($path.DS.$filename, $path.DS.$filename, 630, 450, 100, $this->path_product.DS.'watermark.png');
                                    // $this->Library->watermark_image($path.DS.$filename, $path.DS.$filename, $this->path_product.DS.'watermark.png');
                                }
                                catch (Exception $exception)
                                {

                                }
                                //
                                //Thumb
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thum.DS.$filename);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $year.'/'.$month);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
                                $i = $i + 1;
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        $update_image = array(
                            'id' => $this->Product->id,
                            'image' => $year.'/'.$month.'/'.$image_product_save['Image']['imagelink'],
                        );
                        $this->Product->save($update_image);
                        //Redirect
//                        $this->redirect('/packets/paid/?pid=' . $this->Product->id);
                    }
                }
            }
        }
    }
    public function edit()
    {
        //Check session
        if(!$this->Session->check('Member'))
        {
            $this->Session->setFlash('Vui lòng đăng nhập trước khi đăng thông tin bất động sản', 'flashWarning');
            $this->redirect('/members/login');
        }
        $pid = 0;
        if(isset($this->params['url']['pid']))
        {
            $pid = $this->params['url']['pid'];
        }
        //Get product
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parent',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parent.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
//                'Product.status = 0',
//                'Product.paid = 0',
                'Product.deleted = 0',
                'Product.id = ' . $pid
            ),
        ));
        if(!$product)
        {
            $this->redirect('/members/mypost');
        }
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $pid)
        ));
        //
        $parents = null;
        $provinces = null;
        //Group product
        $this->Product->Category->recursive = -1;
        $parent = $this->Product->Category->find('all', array(
            'conditions' => array('parent_id' => 0),
            'order' => array('Category.sort' => 'ASC')
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $this->Product->District->Province->recursive = -1;
        $province = $this->Product->District->Province->find('all', array(
            'order' => array('Province.sort' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //
        $member_id = $this->Session->read('Member.id');
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        $parent_id = $product['Parent']['id'];
        if(isset($this->request->data['Product']['parent_id']) && $this->request->data['Product']['parent_id'] != '')
        {
            $parent_id = $this->request->data['Product']['parent_id'];
        }
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.parent_id = ' . $parent_id)
        ));
        foreach ($category as $item)
        {
            $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Set data district neu co chon province
        $districts = null;
        $province_id = $product['Province']['id'];
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
        }
        $this->Product->District->recursive = -1;
        $district = $this->Product->District->find('all', array(
            'conditions' => array('District.province_id = ' . $province_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Feature
        $features = null;
        ClassRegistry::init('Feature')->recursive = -1;
        $feature = ClassRegistry::init('Feature')->find('all', array(
            'conditions' => array('category_id' => $product['Category']['id'])
        ));
        if($feature)
        {
            foreach ($feature as $item)
            {
                $features[$item['Feature']['id']] = $item['Feature']['feature'];
            }
        }
        //
        $this->set(array(
            'product' => $product,
            'images' => $images,
            'parents' => $parents,
            'provinces' => $provinces,
            'districts' => $districts,
            'member' => $member,
            'categories' => $categogies,
            'features' => $features,
            'title' => 'Sửa tin bất động sản'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn quá 20 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                //check error image
                $count_image_choose = 0;
                foreach ($images as $item)
                {
                    if($item['name'] != '')
                    {
                        if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                        {
                            $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                        }
                        if($item['size'] > 2097152)
                        {
                            $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                            break;
                        }
                        //Dem hinh anh chon
                        $count_image_choose = $count_image_choose + 1;
                    }
                }
                //Neu không có chọn hinh ảnh thì kiểm tra trong database xem còn bao nhieu ảnh cũ
                //Và kiểm tra xem tổng ảnh mới và ảnh củ có lớn hơn 20 không
                $this->Product->Image->recursive = -1;
                $count_image_old = $this->Product->Image->find('count', array(
                    'conditions' => array('Image.product_id' => $this->request->data['Product']['id'])
                ));
                if($count_image_old + $count_image_choose > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn thêm quá ' . (20 - $count_image_old) . ' hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                elseif ($count_image_old == 0 && $count_image_choose == 0)
                {
                    $this->Session->setFlash('Chọn hình ảnh cho bất động sản', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                //
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    //Luu product
                    if($this->Product->save($this->request->data))//($this->request->data['Product'], array('Product.id' => $this->request->data['Product']['id'])))
                    {
                        //Image dir //Lấy theo ngày tạo post
                        $this->Product->recursive = -1;
                        $product_saved = $this->Product->find('first', array(
                            'conditions' => array('id' => $this->Product->id),
                            'fields' => array('created')
                        ));
                        $date = $product_saved['Product']['created'];
                        $arr = explode(' ', $date);
                        $arr_date = explode('-', $arr[0]);
                        $img_dir =  (int)$arr_date[0] . '/' . (int)$arr_date[1];
                        //
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->path_product.'/'.$img_dir;
                        $path_thumb = $this->path_product_thumb.'/'.$img_dir;
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                            $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                            if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                            {
                                //Đóng mọc hình ảnh
                                try
                                {
                                    $this->Library->watermark_image($path.DS.$filename, $path.DS.$filename, $this->path_product.DS.'watermark.png');
                                }
                                catch (Exception $exception)
                                {

                                }
                                //
                                //Thumb
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thumb.DS.$filename);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $img_dir);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
                                $i = $i + 1;
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        $update_image = array(
                            'id' => $this->Product->id,
                            'image' => $img_dir.'/'.$image_product_save['Image']['imagelink'],
                        );
                        $this->Product->save($update_image);
                        //Redirect
                        $this->redirect('/members/mypost?product_filter=all');
                        //
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function delete_image()
    {
        $this->autoRender = false;
        if(!$this->Session->check('Member'))
        {
            echo 'fail';
        }
        else
        {
            $image_id = $this->request->data['image_id'];
            $image_data = $this->Product->Image->findById($image_id);
            if($image_data)
            {
                if($this->Product->Image->delete($image_id))
                {
                    unlink($this->path_product . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    unlink($this->path_product_thumb . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
            }
            else
            {
                echo 'fail';
            }
        }
    }
    public function add_favorite()
    {
        $this->autoRender = false;
        if($this->Session->check('Member.id'))
        {
            $member_id = $this->Session->read('Member.id');
            $product_id = $this->request->data['product_id'];
            $data_save = array(
                'member_id' => $member_id,
                'product_id' => $product_id,
            );
            $count = $this->Product->Memberproduct->find('count', array(
                'conditions' => array(
                    'member_id' => $member_id,
                    'product_id' => $product_id,
                )
            ));
            if($count == 0)
            {
                if($this->Product->Memberproduct->save($data_save))
                {
                    $json = array(
                        'status' => 'success',
                        'message' => 'Đã thêm vào yêu thích'
                    );
                    echo json_encode($json);
                }
                else
                {
                    $json = array(
                        'status' => 'fail',
                        'message' => 'Lỗi'
                    );
                    echo json_encode($json);
                }
            }
            else
            {
                $json = array(
                    'status' => 'success',
                    'message' => 'Bạn đã thêm vào yêu thích'
                );
                echo json_encode($json);
            }
        }
        else
        {
            $json = array(
                'status' => 'not_login',
                'message' => 'Vui lòng đăng nhập trước khi lưu'
            );
            echo json_encode($json);
        }
    }

    //
    ////////////////////////////////////////
    ////////////////////////////////////////
    //Admin
    ////////////////////////////////////////
    ////////////////////////////////////////
    public function admin_index()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $url = $this->params['url'];
        //Tỉnh thành
        $province_search_id = isset($url['province'])? $url['province']: 0;
        $condition_province = ($province_search_id > 0)? 'Province.id = ' . $province_search_id: '';
        //Quan huyen
        $district_search_id = isset($url['district'])? $url['district']: 0;
        $condition_district = ($district_search_id > 0)? 'District.id = ' . $district_search_id: '';
        //Parent
        $parent_search = isset($url['parent_id'])? $url['parent_id']: '';
        $condition_parent = ($parent_search != '')? 'Category.parent_id = ' . $parent_search: '';
        //category
        $category_search = isset($url['category'])? $url['category']: '';
        $condition_category = ($category_search != '')? 'Category.id = ' . $category_search: '';
        //member
        $member_search = isset($url['member'])? $url['member']: '';
        $condition_member = ($member_search != '')? 'Member.fullname LIKE "%' . $member_search . '%"': '';
        //Packet
        $packet_search = isset($url['packet'])? $url['packet']: '';
        $condition_packet = ($packet_search != '')? 'Packet.id = ' . $packet_search: '';
        //Ngay het han
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///Filter
        $filter = isset($url['filter'])? $url['filter']: '';
        $condition_filter = '';
        if($filter == 'expired')
        {
            $condition_filter = 'Product.expiry < "' . $cur_date . '" AND Product.expiry > "0000-00-00 00:00:00"';
            $condition_filter = $condition_filter . ' AND Product.status = 1 AND Product.paid = 1 AND Product.deleted  = 0';
        }
        if($filter == 'visible')
        {
            $condition_filter = 'Product.expiry >= "' . $cur_date . '" AND Product.deleted = 0 AND Product.status = 1 AND Product.paid = 1';
        }
        if($filter == 'deleted')
        {
            $condition_filter = 'Product.deleted = 1';
        }
        if($filter == 'draft')
        {
            $condition_filter = 'Product.deleted = 0 AND Product.status = 0 AND Product.paid = 0';
        }
        //End dieu kien tim kiem
        /////Dieu kien mac dinh
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parentcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parentcat.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                //Dieu kien mac dinh
                $condition_filter,
                $condition_member,
                $condition_parent,
                $condition_category,
                $condition_province,
                $condition_district,
                $condition_packet,
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $product = null;
        }
        $this->set(array(
            'products' => $product,
        ));

        //Tim kiem
        //Set Group
        $parents = null;
        $this->Product->Category->recursive = -1;
        $parent = $this->Product->Category->find('all', array(
            'conditions' => array('Category.parent_id' => 0)
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Categories
        $categories = null;
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.parent_id' => $parent_search)
        ));
        foreach ($category as $item)
        {
            $categories[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $provinces = null;
        $this->Product->District->Province->recursive = -1;
        $province = $this->Product->District->Province->find('all', array(
            'fields' => array('Province.id', 'Province.provincename'),
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item){
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //District
        $districts = null;
        $this->Product->District->recursive = -1;
        $district = $this->Product->District->find('all', array(
            'conditions' => array(
                'province_id' => $province_search_id
            )
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //Packet
        $this->Product->Packet->recursive = -1;
        $packets = null;
        $packet = $this->Product->Packet->find('all');
        foreach ($packet as $item)
        {
            $packets[$item['Packet']['id']] = $item['Packet']['packetname'];
        }
        //
        $this->set(array(
            'title' => 'Danh sách tin đăng',
            'parents' => $parents,
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'packets' => $packets
        ));
    }
    public function admin_view($id)
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        $this->Product->recursive = -1;
        //Product primary
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parentcat',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.parent_id = Parentcat.id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.id = ' . $id
            ),
        ));
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $id)
        ));
        //Lấy utility
        if($product)
        {
            //
            $this->set(array(
                'title' => 'Chi tiết tin bất động sản',
                'product' => $product,
                'images' => $images,
            ));
        }
        else
        {
            $this->Session->setFlash('Không tìm thấy trang theo yêu cầu', 'flashWarning');
            $this->redirect('/admin/products');
        }
    }
    public function admin_edit($pid)
    {
        //Check session
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Get product
        $this->Product->recursive = -1;
        $product = $this->Product->find('first', array(
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Category.id = Product.category_id')
                ),
                array(
                    'table' => 'categories',
                    'alias' => 'Parent',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Parent.id = Category.parent_id')
                ),
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'districts',
                    'alias' => 'District',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('District.id = Product.district_id')
                ),
                array(
                    'table' => 'provinces',
                    'alias' => 'Province',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Province.id = District.province_id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
            ),
            'conditions' => array(
                'Product.id = ' . $pid
            ),
        ));
        if(!$product)
        {
            $this->redirect('/admin/products');
        }
        //Lấy hình ảnh
        $this->Product->Image->recursive = -1;
        $images = $this->Product->Image->find('all', array(
            'conditions' => array('product_id = ' . $pid)
        ));
        //
        $parents = null;
        $provinces = null;
        //Transaction type
        //Group product
        $this->Product->Category->recursive = -1;
        $parent = $this->Product->Category->find('all', array(
            'conditions' => array('Category.parent_id' => 0)
        ));
        foreach ($parent as $item)
        {
            $parents[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Province
        $this->Product->District->Province->recursive = -1;
        $province = $this->Product->District->Province->find('all', array(
            'order' => array('Province.provincename' => 'ASC')
        ));
        foreach ($province as $item)
        {
            $provinces[$item['Province']['id']] = $item['Province']['provincename'];
        }
        //
        $member_id = $product['Product']['member_id'];
        $this->Product->Member->recursive = -1;
        $member = $this->Product->Member->findById($member_id);
        //Set data category neu co chon group
        $categogies = null;
        $parent_id = $product['Parent']['id'];
        if(isset($this->request->data['Product']['parent_id']) && $this->request->data['Product']['parent_id'] != '')
        {
            $parent_id = $this->request->data['Product']['parent_id'];
        }
        $this->Product->Category->recursive = -1;
        $category = $this->Product->Category->find('all', array(
            'conditions' => array('Category.parent_id = ' . $parent_id)
        ));
        foreach ($category as $item)
        {
            $categogies[$item['Category']['id']] = $item['Category']['categoryname'];
        }
        //Set data district neu co chon province
        $districts = null;
        $province_id = $product['Province']['id'];
        if(isset($this->request->data['Product']['province']) && $this->request->data['Product']['province'] != '')
        {
            $province_id = $this->request->data['Product']['province'];
        }
        $this->Product->District->recursive = -1;
        $district = $this->Product->District->find('all', array(
            'conditions' => array('District.province_id = ' . $province_id)
        ));
        foreach ($district as $item)
        {
            $districts[$item['District']['id']] = $item['District']['districttype'] . ' ' . $item['District']['districtname'];
        }
        //
        //Feature
        $features = null;
        ClassRegistry::init('Feature')->recursive = -1;
        $feature = ClassRegistry::init('Feature')->find('all', array(
            'conditions' => array('category_id' => $product['Category']['id'])
        ));
        if($feature)
        {
            foreach ($feature as $item)
            {
                $features[$item['Feature']['id']] = $item['Feature']['feature'];
            }
        }
        //
        $this->set(array(
            'product' => $product,
            'images' => $images,
            'categories_parent' => $parents,
            'provinces' => $provinces,
            'districts' => $districts,
            'member' => $member,
            'categories_child' => $categogies,
            'features' => $features,
            'title' => 'Sửa tin bất động sản'
        ));
        ////////////////////////////////////////
        ////////////////////////////////////////
        ////////////////////////////////////////
        //Post
        ///
        if($this->request->is('post') || $this->request->is('put'))
        {
            $this->Product->set($this->request->data);
            if($this->Product->validates())
            {
                $images = $this->request->data['Imagesproduct']['imagelink'];
                $err_image = false;
                if(count($images) > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn quá 20 hình ảnh', 'flashError');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
//                //check error image
                $count_image_choose = 0;
                foreach ($images as $item)
                {
                    if($item['name'] != '')
                    {
                        if($item['type'] != 'image/png' && $item['type'] != 'image/jpeg')
                        {
                            $this->Session->setFlash('Chỉ được chọn file hình ảnh', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                        }
                        if($item['size'] > 2097152)
                        {
                            $this->Session->setFlash('Mỗi hình ảnh dung lượng không được quá 2Mb', 'flashWarning');
                            $this->redirect($_SERVER['REQUEST_URI']);
                            break;
                        }
                        //Dem hinh anh chon
                        $count_image_choose = $count_image_choose + 1;
                    }
                }
                //Neu không có chọn hinh ảnh thì kiểm tra trong database xem còn bao nhieu ảnh cũ
                //Và kiểm tra xem tổng ảnh mới và ảnh củ có lớn hơn 20 không
                $this->Product->Image->recursive = -1;
                $count_image_old = $this->Product->Image->find('count', array(
                    'conditions' => array('Image.product_id' => $this->request->data['Product']['id'])
                ));
                if($count_image_old + $count_image_choose > 20)
                {
                    $this->Session->setFlash('Bạn không được chọn thêm quá ' . (20 - $count_image_old) . ' hình ảnh', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                elseif ($count_image_old == 0 && $count_image_choose == 0)
                {
                    $this->Session->setFlash('Chọn hình ảnh cho bất động sản', 'flashWarning');
                    $this->redirect($_SERVER['REQUEST_URI']);
                }
                //
                //Neu hinh anh khong co loi
                if($err_image == false)
                {
                    //Tạo slug
                    $product_link = $this->Library->make_link($this->request->data['Product']['title']);
                    $this->Product->set('productlink', $product_link);
                    //Luu product
                    if($this->Product->save($this->request->data))//($this->request->data['Product'], array('Product.id' => $this->request->data['Product']['id'])))
                    {
                        //Update lại environment và utility
                        //Image dir //Lấy theo ngày tạo post
                        $this->Product->recursive = -1;
                        $product_saved = $this->Product->find('first', array(
                            'conditions' => array('id' => $this->Product->id),
                            'fields' => array('created')
                        ));
                        $date = $product_saved['Product']['created'];
                        $arr = explode(' ', $date);
                        $arr_date = explode('-', $arr[0]);
                        $img_dir =  (int)$arr_date[0] . '/' . (int)$arr_date[1];
                        //
                        App::import('Vendor', 'resize');
                        $thumb = new SimpleImage();
                        $path = $this->path_product.'/'.$img_dir;
                        $path_thumb = $this->path_product_thumb.'/'.$img_dir;
                        $i = 1;
                        $time = new DateTime();
                        $timestamp = $time->getTimestamp();
                        foreach ($images as $image)
                        {
                            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                            $filename = $product_link.'-'.$this->Product->id.'-'.$timestamp.'-'.$i.'.'.$ext;
                            if(move_uploaded_file($image['tmp_name'], $path.DS.$filename))
                            {
                                //Thumb
                                $thumb->load($path.DS.$filename);
                                $thumb->scale(50);
                                $thumb->save($path_thumb.DS.$filename);
                                //
                                $this->Product->Image->create();
                                $this->Product->Image->set('product_id', $this->Product->id);
                                $this->Product->Image->set('imagelink', $filename);
                                $this->Product->Image->set('imagedir', $img_dir);
                                $this->Product->Image->set('imagetitle', $this->request->data['Product']['title']);
                                $this->Product->Image->save();
                                $i = $i + 1;
                            }
                        }
                        //Update hình anh chinh
                        $this->Product->Image->recursive = -1;
                        $image_product_save = $this->Product->Image->find('first', array(
                            'conditions' => array('product_id' => $this->Product->id),
                            'order' => array('imagelink' => 'asc')
                        ));
                        $update_image = array(
                            'id' => $this->Product->id,
                            'image' => $img_dir.'/'.$image_product_save['Image']['imagelink'],
                        );
                        $this->Product->save($update_image);
                        //Redirect
                        $this->redirect('/admin/products');
                        //
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Vui lòng hoàn thành các trường bắt buột', 'flashWarning');
            }
        }
    }
    public function admin_delete_image()
    {
        $this->autoRender = false;
        if(!$this->Session->check('Admin'))
        {
            echo 'fail';
        }
        else
        {
            $image_id = $this->request->data['image_id'];
            $image_data = $this->Product->Image->findById($image_id);
            if($image_data)
            {
                if($this->Product->Image->delete($image_id))
                {
                    unlink($this->path_product . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    unlink($this->path_product_thumb . '/' . $image_data['Image']['imagedir'] . '/' . $image_data['Image']['imagelink']);
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
            }
            else
            {
                echo 'fail';
            }
        }
    }
    //
    public function admin_register_products()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
        //Set
        $register_products = null;
        ClassRegistry::init('Registerproduct')->recursive = -1;
        $register_products = ClassRegistry::init('Registerproduct')->find('all', array(
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => 'Registerproduct.product_id = Product.id'
                )
            ),
            'conditions' => array(),
            'order' => array('Registerproduct.id' => 'DESC'),
            'fields' => array('Registerproduct.*', 'Product.title', 'Product.id')
        ));
        $this->set(array(
            'title' => 'Danh sách đăng ký nhận thông tin bất động sản',
            'register_products' => $register_products
        ));
    }
    public function admin_awaiting_approval()
    {
        if(!$this->Session->check('Admin'))
        {
            $this->redirect('/admin/login');
        }
//        $url = $this->params['url'];
        $date = getdate();
        $cur_date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
        ///Filter
        //End dieu kien tim kiem
        /////Dieu kien mac dinh
        $product = null;
        $this->Product->recursive = -1;
        $this->paginate = array(
            'paramType' => 'querystring',
            'limit' => '10',
            'fields' => array('*'),
            'joins' => array(
                array(
                    'table' => 'members',
                    'alias' => 'Member',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.member_id = Member.id')
                ),
                array(
                    'table' => 'packets',
                    'alias' => 'Packet',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Packet.id = Product.packet_id')
                ),
                array(
                    'table' => 'orders',
                    'alias' => 'Order',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array('Product.id = Order.product_id')
                )
            ),
            'conditions' => array(
                'Product.status = 0',
                'Product.paid = 1',
                'Product.expiry >= "' . $cur_date . '"',
                'Order.status = 0'
            ),
            'order' => array('Product.id' => 'DESC')
        );
        try
        {
            $product = $this->paginate('Product');
        }
        catch (NotFoundException $e)
        {
            $this->Session->setFlash('Not found', 'flashError');
        }

        $this->set(array(
            'products' => $product,
            'title' => 'Tin đăng chờ duyệt',
        ));
    }
    public function admin_confirm_approval()
    {
        if($this->Session->check('Admin'))
        {
            $this->autoRender = false;
            if($this->request->is('post') || $this->request->is('put'))
            {
                $product_id = $this->request->data['product_id'];
                $order_id = $this->request->data['order_id'];
                $data_update_product = array(
                    'id' => $product_id,
                    'status' => '1'
                );
                $data_update_order = array(
                    'id' => $order_id,
                    'status' => '1',
                    'staff_id' => $this->Session->read('Admin.id')
                );
                if($this->Product->save($data_update_product) && $this->Product->Order->save($data_update_order))
                {
                    $this->Session->setFlash('Đã duyệt tin', 'flashSuccess');
                }
                else
                {
                    $this->Session->setFlash('Lỗi', 'flashError');
                }
            }
        }
    }
}