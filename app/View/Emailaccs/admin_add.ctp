<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/emailaccs">Tài khoản mail</a>
                </li>
                <li class="active">Thêm</li>
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
                            Thêm tài khoản email
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
                    echo $this->Form->create('Emailacc', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Tên hiển thị <font class="label-require">(*)</font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Email <font class="label-require">(*)</font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Mật khẩu <font class="label-require">(*)</font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('password', array('type' => 'text', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Host name <font class="label-require">(*)</font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('host', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Post <font class="label-require">(*)</font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('port', array('type' => 'text', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-xs btn-warning">Save <i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->