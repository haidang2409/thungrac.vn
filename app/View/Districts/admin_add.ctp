<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/districts">Quận huyện</a>
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
                            Thêm quận huyện
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
                    echo $this->Form->create('District', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tên quận huyện <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('districtname', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Loại <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('districttype', array('label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => array('' => ' -- Chọn -- ', 'Quận' => 'Quận', 'Huyện' => 'Huyện', 'Thị Xã' => 'Thị Xã', 'Thành Phố' => 'Thành Phố')));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tỉnh thành <font class="label-require"> (*) </font> </label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('province_id', array('id' => 'province', 'label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành -- '));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"></label>
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