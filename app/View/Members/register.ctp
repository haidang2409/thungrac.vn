<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký thành viên | <?php echo $_SERVER['HTTP_HOST'];?></title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- Custom Theme Style -->
    <link href="/css/custom.css" rel="stylesheet">
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
                    <h1>Đăng ký thành viên</h1>
                    <div>
                        <?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Tên đăng nhập'));?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Địa chỉ email'));?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('fullname', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Họ tên'));?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('phonenumber', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Số điện thoại'));?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Mật khẩu'));?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('repassword', array('label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => 'Nhập lại mật khẩu'));?>
                    </div>
                    <div>
                        <div class="checkbox">
                            <label class="block">
                                <input name="form-field-checkbox" disabled="" checked class="ace" type="checkbox">
                                <span class="lbl"> Đồng ý với các <a href="/help/dieu-khoan-su-dung">điều khoản sử dụng dịch vụ</a> </span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center" style="margin: 10px 25px;">
                        <div class="g-recaptcha" data-sitekey="6Lf8R0MUAAAAAPO_y4RCEBafQXlpD0uSQ5wUepQq"></div>
                    </div>
                    <div class="text-center-xs text-center">
                        <button class="btn btn-default" type="reset">
                            <i class="fa fa-refresh"></i>
                            <?php echo __('Reset');?>
                        </button>
                        <button class="btn btn-index" id="btnRegister">
                            <i class="fa fa-check"></i>
                            <?php echo __('Register');?>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">
                            <?php echo __('Have account');?>?
                            <a href="/members/login"><?php echo __('Login');?></a>
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
<script>
    $(function () {
        $('#btnRegister').click(function () {
            $(this).attr('disabled', true);
            $('#MemberRegisterForm').submit();
            $(this).html('<i class="fa fa-spin fa-spinner"></i> Loading');
        })
    })
</script>
</body>
</html>
