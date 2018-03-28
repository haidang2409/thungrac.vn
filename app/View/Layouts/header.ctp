<!DOCTYPE html>
<html lang="vi">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php if(isset($title)){ echo $title;} else { echo 'Chợ đồ cũ | Hàng thanh lý';} echo ' - ' . $_SERVER['HTTP_HOST'];?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?php
    echo $this->Html->meta('keywords', isset($keywords)? $keywords: 'Đồ cũ, hàng thanh lý, kênh đồ cũ, chợ đồ cũ');
    echo $this->Html->meta('description', isset($head_description)? $head_description: 'Chợ đồ cũ Cần Thơ, hàng thanh lý Cần Thơ');
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('font_custom');
    echo $this->Html->css('bootstrap-custom');
    echo $this->Html->css('select2.min');
    echo $this->Html->css('colorbox.min');
    echo $this->Html->css('ace.min');
    echo $this->Html->css('jquery-ui.min');
    echo $this->Html->css('style');
    echo $this->Html->script('jquery-2.1.4.min', array());
    echo $this->Js->writeBuffer();
    ?>
    <meta property="og:url"  content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title)){ echo $title;} else { echo 'Bất động sản MeKong';} echo ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta property="og:description" content="<?php echo isset($head_description)? $head_description: 'Chợ đồ cũ Cần Thơ, hàng thanh lý Cần Thơ'?>"/>
    <meta property="og:image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo $_SERVER['HTTP_HOST'] . '/img/og_logo_default.jpg';}?>"/>
    <meta itemprop="name" content="<?php if(isset($title)){ echo $title;} else { echo 'Bất động sản MeKong';} echo ' - ' . $_SERVER['HTTP_HOST'];?>"/>
    <meta itemprop="description" content="<?php echo isset($head_description)? $head_description: 'Chợ đồ cũ Cần Thơ, hàng thanh lý Cần Thơ'?>"/>
    <meta itemprop="image" content="<?php if(isset($og_image)) { echo $og_image;} else { echo $_SERVER['HTTP_HOST'] . '/img/og_logo_default.jpg';}?>"/>
</head>
<body>
<?php
include ('analyticstracking.ctp');
$category_link = 'mua-ban';
if(isset($this->params['category']))
{
    $category_link = $this->params['category'];
}
$location_link = 'toan-quoc';
if(isset($this->params['location']))
{
    $location_link = $this->params['location'];
}
?>
<!--Menu xs khung tim kiem-->
<div class="menu-xs">
    <form method="get" action="/rao-vat/toan-quoc/mua-ban">
        <?php
        $search = isset($this->params['url']['q'])? $this->params['url']['q']: '';
        ?>
        <div class="menu-xs-header text-center">
            <div style="display: inline; width: 100% !important; padding-left: 10px; text-align: center !important;">
                <input type="text" name="q" placeholder="<?php echo __('Search');?>" style="" value="<?php echo $search;?>">
            </div>
            <div style="display: inline; float: right">
                <a class="a-close-menu" href="javascript: void(0)">
                    <i class="fa fa-close"></i>
                </a>
            </div>
        </div>
        <div id="accordian" class="accordian">
            <ul>
                <?php
                $sum_parent = count($categories_menu);
                for($i = 0; $i < $sum_parent; $i++)
                {
                    ?>
                    <li>
                        <h4><a class="" href="/rao-vat/<?php echo $location_link;?>/<?php echo $categories_menu[$i]['Category']['categorylink'];?>">
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
                                    <a class="" href="/rao-vat/<?php echo $location_link;?>/<?php echo $children[$j]['Category']['categorylink'];?>">
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
    </form>
</div>
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-right: 0px !important;">
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/members/<?php echo $this->Session->read('Member.image');?>"
                             class="nav-profile-img img-circle" />
                    </a>
                    <ul class="dropdown-menu dropdown-profile">
                        <li><a href="/members/profile"><i class="fa fa-user"></i> Tài khoản</a></li>
                        <li><a href="/members/change_password"><i class="fa fa-key"></i> Đổi mật khẩu</a></li>
                        <li><a href="/members/logout"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                    </ul>
                    <?php
                }
                else
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/members/default_user.jpg"
                             class="nav-profile-img img-circle" />
                    </a>
                    <ul class="dropdown-menu dropdown-profile">
                        <li><a href="/members/login"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        <li><a href="/members/register"><i class="fa fa-sign-out"></i> Đăng ký</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <div class="col-xs-6 text-center" style="padding-left: 0 !important; padding-right: 0 !important;">
                <a href="/">
                    <img style="margin: auto" class="visible-xs" src="/img/logo_xs.png" width="" height="">
                </a>
            </div>
            <div class="col-xs-3 text-right" style="padding-right: 0px !important;">
                <i id="btn-menu-xs" data-status="true" class="fa fa-search" style="color: white; padding-right: 10px; margin-top: 8px;"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" style="padding-top: 5px">
                <div class="language" style="margin-bottom: 10px">
                    <a href="?language=vie"><?php echo __('Vietnamese');?></a> |
                    <a href="?language=eng"><?php echo __('English');?></a> |
                    <a href="?language=jpn"><?php echo __('Japanese');?></a>
                </div>
                <?php
                ?>
                <div>
                    <a class="btn btn-warning bolder" href="/dang-tin">ĐĂNG TIN MIỄN PHÍ <i class="fa fa-plus"></i> </a>
                </div>
                <hr class="hr-dotted">
            </div>
        </div>
    </div>
</div>
<!--End menu sm navbar header sm-->
<div class="container hidden-xs" style="padding-top: 10px; padding-bottom: 10px">
    <div class="row">
        <div class="col-sm-3 text-left">
            <a href="/"><img src="/img/logo1.png" alt="" height="70px"></a>
        </div>
        <div class="col-sm-6 text-center">
            <a href="http://nhadatphong.com" target="_blank"><img src="/uploads/advertise/quangcao2.png" height="70px"></a>
        </div>
        <div class="col-sm-3 text-right" style="padding-top: 5px">
            <div class="language" style="margin-bottom: 10px">
                <a href="?language=vie"><?php echo __('Vietnamese');?></a> |
                <a href="?language=eng"><?php echo __('English');?></a> |
                <a href="?language=jpn"><?php echo __('Japanese');?></a>
            </div>
            <a class="btn btn-warning bolder" href="/dang-tin"> <i class="fa fa-pencil-square-o"></i> ĐĂNG TIN MIỄN PHÍ</a>
        </div>
    </div>
</div>
<!--End menu xs navbar ngang xs-->
<div class="hidden-xs" style="background-color: #1ABB9C">
    <nav class="container navbar-custom navbar navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" style="color: white">
                <?php echo __('Home');?>
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container">
                <ul class="hidden-xs nav navbar-nav">
                    <li class="dropdown mega-dropdown">
                        <a href="/rao-vat/toan-quoc/mua-ban">Đồ cũ - Thanh lý
                        </a>
                    </li>
                </ul>
                <!--Ul profile-->
                <?php
                if($this->Session->check('Member'))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li class="dropdown">
                            <a href="#" class="a-profile-img dropdown-toggle" data-toggle="dropdown">
                                <img src="/img/members/<?php echo $this->Session->read('Member.image');?>"
                                     class="nav-profile-img img-circle" />
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <span>
                                                <?php
                                                echo $this->Session->read('Member.fullname');
                                                ?>
                                            </span>
                                                <div class="divider">
                                                </div>
                                                <a href="/members/profile" class="">
                                                    <i class="fa fa-user"></i>
                                                    <?php echo __('Account');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/change_password" class="">
                                                    <i class="fa fa-key"></i>
                                                    <?php echo __('Change password');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/logout" class="">
                                                    <i class="fa fa-sign-out"></i>
                                                    <?php echo __('Logout');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                else
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li class="dropdown">
                            <a href="#" class="a-profile-img dropdown-toggle" data-toggle="dropdown">
                                <img src="/img/members/default_user.jpg"
                                     class="nav-profile-img img-circle" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-profile">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="/members/login" class="">
                                                    <i class="fa fa-sign-in"></i>
                                                    <?php echo __('Login');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/register" class="">
                                                    <i class="fa fa-sign-out"></i>
                                                    <?php echo __('Register');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div><!-- /.nav-collapse -->
    </nav>
</div>