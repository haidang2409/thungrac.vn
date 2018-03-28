<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <h2 align="center"><?php echo __('Quên mật khẩu');?></h2>
            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <form class="form-horizontal form-login" method="post" action="/members/forget_password">
                <div class="form-group has-feedback">
                    <label for="username" class="col-sm-4 control-label"><?php echo __('Nhập email đã đăng ký');?></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label"></label>
                    <div class="col-sm-8 text-center-xs">
                        <button class="btn btn-primary" id="btnSubmit" type="button"><?php echo __('Gửi');?> <i class="fa fa-sign-in"></i> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#btnSubmit').click(function () {
            $(this).attr('disabled', true);
            $(this).html('Đang gửi <i class="fa fa-spin fa-spinner"></i>');
        })
    })
</script>