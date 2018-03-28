<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập | <?php echo $_SERVER['HTTP_HOST'];?></title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/css/custom.css" rel="stylesheet">
    <script src="/js/jquery-2.1.4.min.js"></script>
    <style>
        body
        {
            overflow-y: scroll;
        }
        .login_wrapper
        {
            margin-top: 0 !important;
        }
        input.form-control
        {
            margin-bottom: 5px !important;
            margin-top: 10px !important;
        }
        div.error-message
        {
            text-align: left !important;
            color: #E74C3C !important;
        }
        .login_content form div a {
            margin: 10px 5px 0 0;
        }
        .alert
        {
            text-align: left !important;
            padding: 5px 0 !important;
            color: #E74C3C !important;
            background-color: #F7F7F7; !important;
            border: none !important;
        }
        .alert button
        {
            display: none !important;
        }
        .btn-index
        {
            background-color: #1ABB9C !important;
            border-color: #1ABB9C !important;
            color: #ffffff;
        }
        .btn-index:hover
        {
            color: #ffffff;
            background-color: #1ABB9CCC !important;
        }
        .btn[disabled]:focus, .btn[disabled]:hover, .btn[disabled]
        {
            background-color: #1ABB9CCC !important;
            color: white;
        }
        h1
        {
            color: #1ABB9C !important;
        }
    </style>
</head>
<body class="login">
<div style="padding: 0 5px">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php echo $this->Form->create('Member', array('method' => 'post', 'novalidate' => true));?>
                <h1>Đăng nhập</h1>
                <?php
                echo $this->Session->flash();
                ?>
                <div>
                    <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập">
                </div>
                <div>
                    <input class='form-control' type="password" name="password" placeholder="Mật khẩu">
                    <input type="hidden" name="url_redirect" value="<?php echo isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: '';?>">
                </div>
                <div class="text-center-xs text-center">
                    <br>
                    <button class="btn btn-index" type="submit"><?php echo __('Login');?> <i class="fa fa-sign-in"></i> </button>
                </div>
                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">
                        <?php echo __('Or');?> <a class="link-primary none-textdecoretion" href="/members/register"><?php echo __('Register');?></a>| <a href="/members/forget_password">Quên mật khẩu</a>
                    </p>
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-paw"></i> Dream Come True!</h1>
                        <p>©2016 All Rights Reserved.</p>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </section>
        </div>
    </div>
</div>
</body>
</html>
