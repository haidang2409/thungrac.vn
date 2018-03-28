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
                <li class="active">Nạp tiền tài khoản thành viên</li>
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
                            Nạp tiền tài khoản thành viên
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
                    echo $this->Form->create('Recharge', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Email/Username thành viên</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <?php echo $this->Form->input('email', array('id' => 'checkUser', 'class' => 'form-control', 'placeholder' => 'Nhập email hoặc username vào kiểm tra', 'type' => 'text', 'label' => false));?>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-purple btn-sm">
                                        <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                        Kiểm tra
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Số tiền</label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('price', array('type' => 'text', 'label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Hình thức nạp</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php
                            $type = array(
                                'TRUCTIEP' => 'Trực tiếp tại văn phòng',
                                'Agribank' => 'Ngân hàng agribank',
                                'Vietinbank' => 'Ngân hàng Vietinbank',
                                'Vietcombank' => 'Ngân hàng Vietcombank'
                            );
                            ?>
                            <?php echo $this->Form->input('type', array('type' => 'select', 'label' => false, 'options' => $type, 'class' => 'form-control', 'empty' => ' -- Chọn hình thức -- '));?>
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
<script>
    $(function () {
        $('#li-member').addClass('active open');
        $('#li-recharge-member').addClass('active');
    })
</script>