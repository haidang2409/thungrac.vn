<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/packets">Dịch vụ gói tin</a> </li>
                <li>Sửa dịch vụ</li>
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
                            Sửa dịch vụ
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
                    <?php echo $this->Form->create('Packet', array('class' => 'form-horizontal', 'noValidate' => true));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tên gói <font class="label-require">(*)</font> </label>
                        <div class="col-sm-6 col-xs-12">
                            <?php echo $this->Form->input('packetname', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['packetname']));?>
                            <?php echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Giá <font class="label-require">(*)</font> </label>
                        <div class="col-sm-3 col-xs-12">
                            <?php echo $this->Form->input('price', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['price']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Giá khuyến mãi <font class="label-require">(*)</font> </label>
                        <div class="col-sm-3 col-xs-12">
                            <?php echo $this->Form->input('discount', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['discount']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Số ngày <font class="label-require">(*)</font> </label>
                        <div class="col-sm-3 col-xs-12">
                            <?php echo $this->Form->input('date', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['date']));?>
                        </div>
                        <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                            <div class="div-hint">
                                Thời gian hiển thị tin đăng
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mô tả <font class="label-require">(*)</font> </label>
                        <div class="col-sm-9 col-xs-12">
                            <?php echo $this->Form->input('summary', array('type' => 'textarea', 'class' => 'form-control', 'label' => false, 'value' => $packets['Packet']['summary']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                            <button type="submit" class="btn btn-info btn-xs">Lưu <i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                    <?php echo $this->Form->end();?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $(function () {
        $('#li-order').addClass('active open');
        $('#li-packet').addClass('active');
    })
</script>