<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/members">Thành viên</a>
                </li>
                <li class="active">Chuyển tiền</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Chuyển tiền giữa hai thành viên
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    ?>
                    <form class="form-horizontal form-login" method="post" action="/members/transfer">
                        <div class="form-group has-feedback">
                            <label for="username" class="col-sm-4 control-label">
                                <?php echo __('Enter email or username of receiver');?>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="username">
                                <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="" class="col-sm-4 control-label"><?php echo __('Money');?></label>
                            <div class="col-sm-8">
                                <input class='form-control' type="text" name="money">
                                <span class="fa fa-dollar form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label"></label>
                            <div class="col-sm-8 text-center-xs">
                                <button class="btn btn-primary" type="submit"><?php echo __('Ok');?> <i class="fa fa-check"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $(function () {
        $('#li-member').addClass('active open');
        $('#li-transfer-member').addClass('active');
    })
</script>
