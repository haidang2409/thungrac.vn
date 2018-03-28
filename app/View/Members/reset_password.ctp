<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <h2 align="center"><?php echo __('Đặt lại mật khẩu');?></h2>
            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <form class="form-horizontal form-login" method="post" action="">
                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-4 control-label"><?php echo __('Mật khẩu mới');?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="password_new">
                        <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-4 control-label"><?php echo __('Nhập lại mật khẩu');?></label>
                    <div class="col-sm-8">
                        <input class='form-control' type="password" name="re_password_new">
                        <span class="glyphicon glyphicon-repeat form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label"></label>
                    <div class="col-sm-8 text-center-xs">
                        <button class="btn btn-primary" type="submit"><?php echo __('Xác nhận');?> <i class="fa fa-sign-in"></i> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>