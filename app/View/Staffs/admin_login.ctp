<!DOCTYPE HTML>
<html>
<head>
    <title>Login | Hệ thống quản lý</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <link rel="icon" href="/favicon.ico">
    <?php
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('dashboard');
    echo $this->Html->css('popuo-box');
    echo $this->Html->css('ace.min');
    echo $this->Html->css('admin-style');
    ?>
</head>
<style>
    .alert
    {
        margin-top: 0 !important;
        margin-bottom: 10px !important;
    }
    .alert button.close
    {
        display: none !important;
    }
    .btn
    {
        border-radius: 0 !important;
    }
</style>
<body style="font-family: Arial">
<div id="small-dialog">
    <div class="widget-body">
        <div class="widget-main"
             style="padding: 10px 30px 10px 30px !important;">
            <h4 class="header blue lighter bigger">
                <i class="ace-icon fa fa-coffee green"></i>
                ĐĂNG NHẬP HỆ THỐNG QUẢN LÝ
            </h4>
            <div class="space-6"></div>
            <form action='/admin/login' method="post">
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input id="email" name="email" class="form-control" placeholder="Email" type="text" autocomplete="off">
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input name="password" class="form-control" placeholder="Mật khẩu" type="password" autocomplete="off">
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </label>
                    <div class="space"></div>
                    <div class="text-left">
                        <?php
                        echo $this->Session->flash();
                        ?>
                    </div>
                    <div class="clearfix">
                        <button type="submit" class="width-50 pull-right btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Đăng nhập</span>
                        </button>
                    </div>
                    <div class="space-4"></div>
                </fieldset>
            </form>
        </div><!-- /.widget-main -->
    </div>
</div>
<script>
    document.getElementById("email").focus();
</script>
</body>
</html>