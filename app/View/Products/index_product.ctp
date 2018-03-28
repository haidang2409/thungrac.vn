<?php
$price_min = isset($this->params['url']['price_min'])? $this->params['url']['price_min']: '';
$price_max = isset($this->params['url']['price_max'])? $this->params['url']['price_max']: '';
$search = isset($this->params['url']['q'])? $this->params['url']['q']: '';
$type = isset($this->params['url']['t'])? $this->params['url']['t']: '';
$district = isset($this->params['url']['district'])? $this->params['url']['district']: '';
//Category
$categorylink = isset($this->params['category'])? $this->params['category']: 'mua-ban';
//Location
$locationlink = isset($this->params['location'])? $this->params['location']: 'toan-quoc';

//Link for location
$query_string = $_SERVER['QUERY_STRING']!= ''? '?' . $_SERVER['QUERY_STRING']: '';
$query_string = preg_replace('/\?page=([0-9]+)/', '', $query_string);
$query_string = preg_replace('/\&page=([0-9]+)/', '', $query_string);

$arr_price = array(
    '0' => '0',
    '50000' => '50 ngàn',
    '100000' => '100 ngàn',
    '200000' => '200 ngàn',
    '500000' => '500 ngàn',
    '1000000' => '1 triệu',
    '2000000' => '2 triệu',
    '3000000' => '3 triệu',
    '5000000' => '5 triệu',
    '10000000' => '10 triệu'
);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
<!--            Breadcrumb-->
            <div class="breadcrumb_product">
                <h3>
                    <?php
                    if(isset($breadcrumb_category))
                    {
                        ?>
                        <a class="none-textdecoretion" href="/rao-vat/<?php echo $locationlink;?>/<?php echo $breadcrumb_category[0]['Category']['categorylink'];;?>">
                            <?php
                            echo $breadcrumb_category[0]['Category']['categoryname'];
                            ?>
                        </a>
                        <small>
                            <i class="fa fa-angle-double-right"></i>
                            <?php
                            $sum_children = count($breadcrumb_category);
                            if($sum_children <= 4)
                            {
                                for($i = 0; $i < $sum_children; $i++)
                                {
                                    ?>
                                    <a class="none-textdecoretion <?php if($categorylink == $breadcrumb_category[$i]['Childcat']['categorylink']) { echo 'bolder';}?>" href="/rao-vat/<?php echo $locationlink;?>/<?php echo $breadcrumb_category[$i]['Childcat']['categorylink'];?>">
                                        <?php echo $breadcrumb_category[$i]['Childcat']['categoryname'];?>
                                    </a> |
                                    <?php
                                }
                            }
                            else
                            {
                                for($i = 0; $i < 4; $i++)
                                {
                                    ?>
                                    <a class="none-textdecoretion <?php if($categorylink == $breadcrumb_category[$i]['Childcat']['categorylink']) { echo 'bolder';}?>" href="/rao-vat/<?php echo $locationlink;?>/<?php echo $breadcrumb_category[$i]['Childcat']['categorylink'];?>"><?php echo $breadcrumb_category[$i]['Childcat']['categoryname'];?> </a> |
                                    <?php
                                }
                                ?>
                                <span class="dropdown">
                                <a class="none-textdecoretion" id="drop6" role="button" data-toggle="dropdown" href="#">Xem thêm + <span class="caret"></span></a>
                                <ul class="view-all-cat dropdown-menu" role="menu" aria-labelledby="drop6">
                                    <?php
                                    for($i = 4; $i < $sum_children; $i++)
                                    {
                                        ?>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="/rao-vat/<?php echo $locationlink;?>/<?php echo $breadcrumb_category[$i]['Childcat']['categorylink'];?>">
                                                <?php
                                                if($categorylink == $breadcrumb_category[$i]['Childcat']['categorylink'])
                                                {
                                                    ?>
                                                    <b><?php echo $breadcrumb_category[$i]['Childcat']['categoryname'];?></b>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <?php echo $breadcrumb_category[$i]['Childcat']['categoryname'];?>
                                                    <?php
                                                }
                                                ?>

                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </span>
                                <?php
                            }
                            ?>
                        </small>
                        <?php
                    }
                    else
                    {
                        echo 'Đồ cũ - Thanh lý';
                    }
                    ?>

                </h3>

                <div class="x_title"></div>
            </div>
<!--            Div search-->
            <div class="feature-product-container">
                <div class="row">
                <?php
                $i = 0;
                if(isset($features) && count($features) > 0)
                {
                    echo '<ul class="ul-feature">';
                    foreach ($features as $item)
                    {
                        $class_active = '';
                        if($type == $item['Feature']['id'])
                        {
                            $class_active = 'a-feature-active';
                        }
                        $col = $item['Category']['col_size'] > 0? $item['Category']['col_size']: 2;
                        echo '<li class="col-sm-' . $col . ' col-xs-6"><a class="a-feature ' . $class_active . '" data-type="' . $item['Feature']['id'] . '" href="javascript: void(0)">' . $item['Feature']['feature'] . '</a></li>';
                        if($i != 0 && ($i + 1)%(12/$col) == 0)
                        {
                            echo '<div class="clearfix"></div>';
                        }
                        $i = $i + 1;
                    }
                    echo '</ul>';
                    echo '<div class="col-sm-12"><hr class="hr-dotted" style="margin: 7px 0 !important;"></div>';
                }
                ?>
                <div class="col-sm-6 col-sm-offset-3" style="min-height: 75px">
                    <form role="form" id="form-search-price">
                        <div class="col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="price_min">Giá từ</label>
                                <?php
                                echo $this->Form->input('price_min', array('id' => 'price_min', 'name' => 'price_min', 'type' => 'select', 'options' => $arr_price, 'label' => false, 'default' => $price_min, 'style' => 'width: 100% !important'));
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Đến</label>
                                <?php
                                echo $this->Form->input('price_max', array('id' => 'price_max', 'name' => 'price_max', 'type' => 'select', 'options' => $arr_price, 'label' => false, 'default' => $price_max, 'style' => 'width: 100% !important'));
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-8" style="padding-top: 15px">
                        <span>
                            <?php
                            echo 'Hiển thị ' . $this->Paginator->param('current') . '/' . $this->Paginator->param('count') . ' tin';
                            ?>
                        </span>
                    </div>
                    <div class="col-sm-4 text-right container-sort-product">
                        <?php
                        $sort = isset($this->params['url']['srt'])? $this->params['url']['srt']: '';
                        ?>
                        <select id="sort-product" name="sort" style="width: 60%">
                            <option value="default" <?php if($sort == 'default') { echo 'selected';}?>>Sắp xếp mặc định</option>
                            <option value="new" <?php if($sort == 'new') { echo 'selected';}?>>Mới nhất</option>
                            <option value="price_up" <?php if($sort == 'price_up') { echo 'selected';}?>>Giá tăng dần</option>
                            <option value="price_down" <?php if($sort == 'price_down') { echo 'selected';}?>>Giá giảm dần</option>
                        </select>
                    </div>
                </div>
            </div>
<!--            Product vip list-->
            <div>

            </div>
<!--            Product list-->
            <div class="product-container-list">
                <?php
                if(isset($products) && count($products) > 0)
                {
                    $sum_product = count($products);
                    foreach ($products as $item)
                    {
                        ?>
                        <div class="product-item">
                            <div class="row">
                                <div class="col-sm-3 col-xs-5" style="margin-top: 7px">
                                    <?php
                                    $image = '/uploads/products/no-image-product.png';
                                    if($item['Product']['image'] != '')// && file_exists('http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/' . $item['Product']['image']))
                                    {
                                        $image = '/uploads/products/thumb/' . $item['Product']['image'];
                                    }
                                    ?>
                                    <a href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                        <div class="product_bg_image" style="background-image: url('<?php echo $image?>'); background-size: cover; background-position: center center; height: 115px"></div>
                                    </a>
                                </div>
                                <div class="col-sm-9 col-xs-7">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h3>
                                                <a title="<?php echo $item['Product']['title'];?>" class="title" href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>">
                                                    <?php
                                                    echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <span class="price">
                                                <?php
                                                if($item['Product']['price'] == 0)
                                                {
                                                    echo 'Thỏa thuận';
                                                }
                                                else
                                                {
                                                    echo number_format($item['Product']['price'], 0, '', '.');
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="hidden-xs">
                                        <div class="summary">
                                            <?php
                                            $summary = '';
                                            if($item['Product']['summary'] != '')
                                            {
                                                $summary = $this->Lib->hidden_text($item['Product']['summary'], 200);
                                            }
                                            else
                                            {
                                                $summary = $this->Lib->hidden_text($item['Product']['description'], 200);
                                            }
                                            echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                            ?>
                                        </div>
                                        <div class="">
                                            <i class="fa fa-map-marker"></i>
                                            <?php echo $item['District']['districttype'] . ' ' . $item['District']['districtname'] . ' - ' . $item['Province']['provincename'];?>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <?php
                                                $fullname = $item['Product']['fullname'];
                                                $phonenumber = $item['Product']['phonenumber'];
                                                $email = $item['Member']['email'];
                                                $image_member = $item['Member']['image'];
                                                if($item['Product']['deposit'] == 1)
                                                {
                                                    $fullname = 'Admin';
                                                    $phonenumber = '0901 032 320';
                                                    $email = 'cskh@dream.edu.vn';
                                                    $image_member = 'admin_003A.jpg';
                                                }
                                                ?>
                                                <span class="member">
                                                    <img src="/img/members/<?php echo $image_member;?>" width="25px" height="25px" class="img-circle">
                                                    <?php echo $fullname;?>
                                                    <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                        <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $phonenumber;?>">
                                                            <a style="color: orangered" href="tel:<?php echo $phonenumber;?>"><?php echo $this->Lib->hide_phonenumber($phonenumber);?></a>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <span class="date">
                                                <i class="fa fa-clock-o"> </i>
                                                <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                                <br>
                                            </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-12 visible-xs">
                                    <div class="summary">
                                        <?php
                                        echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                        ?>
                                    </div>
                                    <div class="">
                                        <i class="fa fa-map-marker"></i>
                                        <?php echo $item['District']['districttype'] . ' ' . $item['District']['districtname'] . ' - ' . $item['Province']['provincename'];?>
                                    </div>
                                    <span class="date">
                                        <i class="fa fa-clock-o"> </i>
                                        <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                        <br>
                                    </span>
                                    <span class="member">
                                        <img src="/img/members/<?php echo $image_member;?>" width="25px" height="25px" class="img-circle">
                                        <?php echo $fullname;?>
                                        <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $phonenumber;?>">
                                                <a style="color: orangered" href="tel:<?php echo $phonenumber;?>"><?php echo $this->Lib->hide_phonenumber($phonenumber);?></a>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div style="margin-top: 10px !important;" class="alert alert-warning">Không có tin</div>
                    <?php
                }
                ?>
            </div>
            <!--            Paginate-->
            <?php if($this->params['paging']['Product']['pageCount'] > 1):?>
                <div class="pagination">
                    <ul class="pagination">
                        <?php
                        //
                        $here = $this->here;
                        $len_here = strlen($here);
                        $here = substr($here, 1, $len_here);
                        $this->Paginator->options(array(
                            'url'=> array(
                                'controller' => '/',
                                'action' => '/',
                                $here
                            )
                        ));
                        //set querystring
                        $this->Paginator->options['url']['?'] = $this->params['url'];
                        // echo urldecode($this->Paginator->prev(__('<<'), array(), null, array('class' => 'disabled','disabledTag' => 'a')));
                        echo urldecode($this->Paginator->numbers(
                            array(
                                'separator' => '',
                                'currentTag' => 'a',
                                'currentClass' => 'active',
//                                'tag' => 'li',
                                'ellipsis'=>'<a>...</a>',
                                'modulus' => 4,
                                'first' => 2,
                                'last' => 2
                            )));
                        // echo urldecode($this->Paginator->next(__('>>'), array('currentClass' => 'disabled'), null, array('class' => 'disabled','disabledTag' => 'a')));
                        ?>
                    </ul>
                </div>
            <?php endif;?>
        </div>
        <div class="col-sm-3 col-sm-pull-9" style="padding-top: 0 !important;">
            <form method="get" action="">
                <div class="product-search-category">
                    <div>
                        <!--<div class="form-group has-feedback">-->
                        <!--    <input placeholder="<?php echo __('Search');?>" class="form-control" type="text" name="q" value="<?php echo $search;?>" >-->
                        <!--    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>-->
                        <!--</div>-->
                    </div>
                    <div class="product-search-header product-search-header-first">
                        <h3><?php echo __('Search by category');?></h3>
                    </div>
                    <div id="" class="accordian accordian-search">
                        <ul>
                            <?php
                            $sum_parent = count($categories_menu);
                            for($i = 0; $i < $sum_parent; $i++)
                            {
                                ?>
                                <li>
                                    <h4><a href="/rao-vat/<?php echo $locationlink;?>/<?php echo $categories_menu[$i]['Category']['categorylink'];?>">
                                            <i class="<?php echo $categories_menu[$i]['Category']['icon'];?>"></i>
                                            <?php echo $categories_menu[$i]['Category']['categoryname'];?>
                                        </a>
                                        <i data-expand="1" class="fa fa-angle-down icon-plus-expand"></i>
                                    </h4>
                                    <ul>
                                        <?php
                                        $children = $categories_menu[$i]['children'];
                                        $sum_children = count($children);
                                        for($j = 0; $j < $sum_children; $j++)
                                        {
                                            ?>
                                            <li>
                                                <a class="" href="/rao-vat/<?php echo $locationlink?>/<?php echo $children[$j]['Category']['categorylink'];?>">
                                                    <i class="fa fa-caret-right"></i>
                                                    <?php echo $children[$j]['Category']['categoryname'];?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </form>
            <!--            End location script-->
<!--            Adv-->
            <div class="text-center" style="padding-top: 15px">
                 <a href="http://dream.edu.vn" target="_blank">
                    <img src="http://nhadatphong.com/uploads/advertise/quang-cao-2.jpg" alt="Nghệ thuật hiện thực hóa ước mơ" width="100%">
                </a>
            </div>
<!--            End Adv-->
<!--            API product_new-->
            <link rel="stylesheet" type="text/css" href="http://nhadatphong.com/api/api_product_new.css"/>
            <script type="text/javascript" src="http://nhadatphong.com/api/api_product_new.js"></script>
            <div id="api-get-ndp-new">

            </div>
<!--            End API product_new-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#price_min').select2({
            'minimumResultsForSearch': -1
        });
        $('#price_max').select2({
            'minimumResultsForSearch': -1
        });
        $('#form-search-price').show();
        $(".accordian-search h4").click(function(){
            $(".accordian-search ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        });
        $('#sort-product').select2({
            minimumResultsForSearch: -1
        });
        $('.container-sort-product').show();

        $('.phone-number').on('click', function(){
            var phone = $(this).data('phonenumber');
            $(this).html(phone)
        });
        var price_min = '<?php echo $price_min;?>';
        var price_max = '<?php echo $price_max;?>';
        var sort = '<?php echo $sort;?>';
        var search = '<?php echo $search;?>';
        var type = '<?php echo $type;?>';

        $('#sort-product').change(function () {
            var sort = $(this).val();
            window.location = window.location.pathname + '?price_min=' + price_min + '&price_max=' + price_max + '&srt=' + sort + '&q=' + search + '&t=' + type;
        });
        $('#price_min').change(function () {
            var price_min = $(this).val();
            window.location = window.location.pathname + '?price_min=' + price_min + '&price_max=' + price_max + '&srt=' + sort + '&q=' + search + '&t=' + type;
        });
        $('#price_max').change(function () {
            var price_max = $(this).val();
            window.location = window.location.pathname + '?price_min=' + price_min + '&price_max=' + price_max + '&srt=' + sort + '&q=' + search + '&t=' + type;
        });
        $('.a-feature').click(function () {
            var type = $(this).data('type');
            window.location = window.location.pathname + '?price_min=' + price_min + '&price_max=' + price_max + '&srt=' + sort + '&q=' + search + '&t=' + type;
        })
    })
</script>