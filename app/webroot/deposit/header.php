<!DOCTYPE html>
<html lang="vi">
<head>
    <title>
        <?php if(isset($title)){ echo $title;} else { echo 'Kênh rao vặt';} echo ' - ' . $_SERVER['HTTP_HOST'];?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Kênh rao vặt tổng hợp - thungrac.vn
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/font_custom.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-custom.css"/>
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/colorbox.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/ace.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/deposit/atm/css/main.css"/>
    <script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<?php
session_name('CAKEPHP');
session_start();
if(!isset($_SESSION['Member']))
{
    header('Location: /members/login');
}
?>
<!--End menu xs navbar header xs-->
<div class="visible-xs" style="padding-bottom: 10px">
    <div class="container">
        <div class="row navbar-xs" style="">
            <div class="col-xs-3 text-left" style="padding-right: 0px !important;">
                <?php
                if(isset($_SESSION['Member']))
                {
                    ?>
                    <a href="#" class="dropdown-toggle profile-member" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="/img/members/<?php echo $_SESSION['Member']['image'];?>"
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
                    <img style="margin: auto" class="visible-xs" src="/img/temp/logo_home2.png" width="" height="">
                </a>
            </div>
            <div class="col-xs-3 text-right" style="padding-right: 0px !important;">
                <button class="btn btn-warning" id="btn-menu-xs" data-status="true"><i class="fa fa-search"></i> </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" style="padding-top: 5px">
                <div class="language" style="margin-bottom: 10px">
                    <a href="?language=vie">Vietnamese</a> |
                    <a href="?language=eng">English</a> |
                    <a href="?language=jpn">Japanese</a>
                </div>
                <?php
                ?>
                <div>
                    <a class="btn btn-warning" href="/dang-tin">Add post free <i class="fa fa-plus"></i> </a>
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
            <img src="/uploads/advertise/quangcao2.jpg" height="70px">
        </div>
        <div class="col-sm-3 text-right" style="padding-top: 5px">
            <div class="language" style="margin-bottom: 10px">
                <a href="?language=vie"> Vietnamese</a> |
                <a href="?language=eng"> English </a> |
                <a href="?language=jpn"> Japanese </a>
            </div>
            <a class="btn btn-warning" href="/dang-tin"> Add post free <i class="fa fa-plus"></i> </a>
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
                Trang chủ
            </a>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse">
            <div class="container">
                <ul class="hidden-xs nav navbar-nav">
                    <li class="dropdown mega-dropdown">
                        <a href="/rao-vat/toan-quoc/mua-ban">Rao vặt
                        </a>
                    </li>
                </ul>
                <!--Ul profile-->
                <?php
                if(isset($_SESSION['Member']))
                {
                    ?>
                    <ul class="nav navbar-nav navbar-right navbar-profile">
                        <li class="dropdown">
                            <a href="#" class="a-profile-img dropdown-toggle" data-toggle="dropdown">
                                <img src="/img/members/<?php echo $_SESSION['Member']['image'];?>"
                                     class="nav-profile-img img-circle" />
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <span>
                                                <?php
                                                echo $_SESSION['Member']['fullname'];
                                                ?>
                                            </span>
                                                <div class="divider">
                                                </div>
                                                <a href="/members/profile" class="">
                                                    <i class="fa fa-user"></i>
                                                    Tài khoản
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/change_password" class="">
                                                    <i class="fa fa-key"></i>
                                                    Đổi mật khẩu
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/logout" class="">
                                                    <i class="fa fa-sign-out"></i>
                                                    Đăng xuất
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
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="/members/login" class="">
                                                    <i class="fa fa-sign-in"></i>
                                                    <?php ('Login');?>
                                                </a>
                                                <div class="divider"></div>
                                                <a href="/members/register" class="">
                                                    <i class="fa fa-sign-out"></i>
                                                    <?php ('Register');?>
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