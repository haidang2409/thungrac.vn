<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
                </li>
                <li class="active">Nhân viên</li>
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
                    <div class="col-sm-6">
                        <h1>
                            Danh sách nhân viên
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-success btn-xs" href="/admin/staffs/add">Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <!--Nội dung chính-->
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th><?php echo $this->Paginator->sort('email', 'Email');?></th>
                            <th><?php echo $this->Paginator->sort('fullname', 'Họ tên');?></th>
                            <th><?php echo $this->Paginator->sort('gender', 'Giới tính');?></th>
                            <th><?php echo $this->Paginator->sort('birthday', 'Ngày sinh');?></th>
                            <th><?php echo $this->Paginator->sort('phonenumber', 'Số điện thoại');?></th>
                            <th><?php echo $this->Paginator->sort('address', 'Địa chỉ');?></th>
                            <th><?php echo $this->Paginator->sort('role', 'Role');?></th>
                            <th><?php echo $this->Paginator->sort('status', 'Active');?></th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 0;
                        ?>
                        <?php foreach($staffs as $staff): ?>
                            <tr>
                                <td align="center">
                                    <?php
                                    echo $count + 1;
                                    $count = $count + 1;
                                    ?>
                                </td>
                                <td>
                                    <a href="/admin/staffs/view/<?php echo $staff['Staff']['id'];?>">
                                        <?php echo $staff['Staff']['fullname'];?>
                                    </a>
                                </td>
                                <td><?php echo $staff['Staff']['fullname']; ?></td>
                                <td align="center">
                                    <?php
                                    if($staff['Staff']['gender'] == '1')
                                    {
                                        echo 'Nam';
                                    }
                                    else if($staff['Staff']['gender'] == '0')
                                    {
                                        echo 'Nữ';
                                    }
                                    else
                                    {
                                        echo '_';
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php echo $staff['Staff']['birthday'] != '0000-00-00'? $this->Lib->convertDateTime_Mysql_to_Date($staff['Staff']['birthday']): '_';?>
                                </td>
                                <td><?php echo $staff['Staff']['phonenumber']; ?></td>
                                <td>
                                    <?php echo $staff['Staff']['address'];?>
                                </td>
                                <td align="center"><?php echo $staff['Staff']['role']; ?></td>
                                <td align="center">
                                    <?php echo $staff['Staff']['status'] == 1? '<i class="green fa fa-check"></i>': ''; ?>
                                </td>
                                <td align="center">
                                    <?php
                                    if($staff['Staff']['status'] == 1)
                                    {
                                        ?>
                                        <button data-staff_id="<?php echo $staff['Staff']['id'];?>" data-fullname="<?php echo $staff['Staff']['fullname'];?>" class="btn btn-danger btn-xs  btnDisable" title="Khóa tài khoản">
                                            <i class="fa fa-lock"></i>
                                        </button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <button data-staff_id="<?php echo $staff['Staff']['id'];?>" data-fullname="<?php echo $staff['Staff']['fullname'];?>" class="btn btn-success btn-xs btnEnable" title="Kích hoạt tài khoản">
                                            <i class="fa fa-unlock"></i>
                                        </button>
                                        <?php
                                    }
                                    ?>
                                    <a class="btn btn-warning btn-xs" href="/admin/staffs/edit/<?php echo $staff['Staff']['id']?>"><i class="fa fa-pencil"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-enable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Mở khóa tài khoản: <b id="text-content-enable"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-enable" type="button" class="btn btn-primary btn-xs"> Mở khóa <i class="fa fa-unlock"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-disable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Khóa tài khoản: <b id="text-content-disable"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default  btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-disable" type="button" class="btn btn-primary btn-xs"> Khóa <i class="fa fa-lock"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $('#li-staff').addClass('active open');
        $('#li-list-staff').addClass('active');
        $(document).on('click', '.btnEnable',  function(){
            var staff_id = $(this).data('staff_id');
            var fullname = $(this).data('fullname');
            $('.modal-body #text-content-enable').html(fullname);
            $('#btn-comfirm-enable').data('staff_id', staff_id);
            $('#modal-enable').modal('show');
        });
        $('#btn-comfirm-enable').click(function(){
            var staff_id = $(this).data('staff_id');
            if(staff_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/staffs/enable',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'staff_id': staff_id,
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
        $(document).on('click', '.btnDisable',  function(){
            var staff_id = $(this).data('staff_id');
            var fullname = $(this).data('fullname');
            $('.modal-body #text-content-disable').html(fullname);
            $('#btn-comfirm-disable').data('staff_id', staff_id);
            $('#modal-disable').modal('show');
        });
        $('#btn-comfirm-disable').click(function(){
            var staff_id = $(this).data('staff_id');
            if(staff_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/staffs/disable',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'staff_id': staff_id,
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
    })
</script>