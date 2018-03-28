<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/staffs">Nhân viên</a>
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
                            Sửa thông tin nhân viên
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
                    echo $this->Form->create('Staff', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Email <font class="label-require">(*)</font></label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'value' => $staffs['Staff']['email']));?>
                            <?php echo $this->Form->input('id', array('label' => false, 'class' => 'form-control', 'value' => $staffs['Staff']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Họ tên <font class="label-require">(*)</font></label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('fullname', array('label' => false, 'class' => 'form-control', 'value' => $staffs['Staff']['fullname']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-xs-12 control-label no-padding-right">Giới tính </label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="radio">
                                <?php
                                $gender = $staffs['Staff']['gender'];
                                ?>
                                <label>
                                    <input name="data[Staff][gender]" class="ace" type="radio" value="1" <?php if($gender == '1'){ echo 'checked';}?>>
                                    <span class="lbl"> Nam </span>
                                </label>
                                <label>
                                    <input name="data[Staff][gender]" class="ace" type="radio" value="0" <?php if($gender == '0'){ echo 'checked';}?>>
                                    <span class="lbl"> Nữ </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Ngày sinh</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('birth', array('type' => 'text', 'id' => 'birthday', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Ngày/tháng/năm', 'value' => $this->Lib->convertDateTime_Mysql_to_Date($staffs['Staff']['birthday'])));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Số điện thoại</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('phonenumber', array('type' => 'text', 'label' => false, 'class' => 'form-control', 'value' => $staffs['Staff']['phonenumber']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Địa chỉ</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('address', array('type' => 'text', 'id' => '', 'label' => false, 'class' => 'form-control', 'value' => $staffs['Staff']['address']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Quyền</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('role', array('type' => 'select', 'label' => false, 'options' => array('1' => 1, '2' => 2, '3' => 3), 'class' => 'form-control', 'empty' => ' -- Chọn quyền -- ', 'value' => $staffs['Staff']['role']));?>
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
        $('#birthday').datepicker({
            dateFormat: 'dd/mm/yy'
        });
    })
</script>