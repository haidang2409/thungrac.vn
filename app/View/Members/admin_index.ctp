<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Thành viên</li>
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
        <!--            Search-->
        <div class="div-form-timkiem">
            <form class="form-horizontal" action="" method="get">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email/Tên đăng nhập</label>
                    <div class="col-sm-4">
                        <input placeholder="Nhập email hoặc tên đăng nhập" type="text" name="name" class="form-control" value="<?php echo isset($this->params['url']['name'])? $this->params['url']['name']:'';?>">
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/districts" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
<!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Danh sách thành viên
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?php
                        echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                        ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($members) && count($members) > 0)
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th><?php echo $this->Paginator->sort('username', 'Tên đăng nhập');?></th>
                                <th><?php echo $this->Paginator->sort('fullname', 'Họ tên');?></th>
                                <th><?php echo $this->Paginator->sort('email', 'Email');?></th>
                                <th><?php echo $this->Paginator->sort('gender', 'Giới tính');?></th>
                                <th><?php echo $this->Paginator->sort('birthday', 'Ngày sinh');?></th>
                                <th><?php echo $this->Paginator->sort('phonenumber', 'Số điện thoại');?></th>
                                <th><?php echo $this->Paginator->sort('address', 'Địa chỉ');?></th>
                                <th><?php echo $this->Paginator->sort('status', 'Active');?></th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($members as $member): ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $count + 1;
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $this->Html->link(htmlspecialchars($member['Member']['username'])  ,   array('action'=>'view_detail', $member['Member']['id']),array('escape' => false) );?></td>
                                    <td><?php echo $member['Member']['fullname']; ?></td>
                                    <td><?php echo $member['Member']['email']; ?></td>
                                    <td align="center">
                                        <?php
                                        if($member['Member']['gender'] == '1')
                                        {
                                            echo 'Nam';
                                        }
                                        else if($member['Member']['gender'] == '0')
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
                                        <?php echo $member['Member']['birthday'] != '0000-00-00'? $this->Lib->convertDateTime_Mysql_to_Date($member['Member']['birthday']): '_';?>
                                    </td>
                                    <td><?php echo $member['Member']['phonenumber']; ?></td>
                                    <td>
                                        <?php echo $member['Member']['address'];?>,
                                        <?php echo $member['District']['districtname'];?>,
                                        <?php echo $member['Province']['provincename'];?>
                                    </td>
                                    <td align="center">
                                        <?php echo $member['Member']['status'] == 1? '<i class="fa fa-check green"></i>': ''; ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        if($member['Member']['status'] == 1)
                                        {
                                            ?>
                                            <button data-member_id="<?php echo $member['Member']['id'];?>" data-fullname="<?php echo $member['Member']['fullname'];?>" class="btn btn-warning btn-xs btn-disactive-member" title="Khóa tài khoản">
                                                <i class="fa fa-lock"></i>
                                            </button>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button data-member_id="<?php echo $member['Member']['id'];?>" data-fullname="<?php echo $member['Member']['fullname'];?>" class="btn btn-success btn-xs btn-active-member" title="Kích hoạt tài khoản">
                                                <i class="fa fa-unlock"></i>
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
                            <?php echo $this->Paginator->numbers(array('class' => 'numbers'));?>
                            <?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo '<div class="alert alert-warning">Không có thành viên</div>';
                    }
                    ?>

                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-disactive-member">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận khóa tài khoản: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-xs btn-primary"> Khóa <i class="fa fa-lock"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-active-member">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận mở khóa tài khoản: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-active" type="button" class="btn btn-xs btn-primary"> Mở khóa <i class="fa fa-unlock"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $('#li-member').addClass('active open');
        $('#li-list-member').addClass('active');
        $(document).on('click', '.btn-disactive-member',  function(){
            var member_id = $(this).data('member_id');
            var fullname = $(this).data('fullname');
            $('.modal-body #text-content').html(fullname);
            $('#btn-comfirm-delete').data('member_id', member_id);
            $('#modal-disactive-member').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var member_id = $(this).data('member_id');
            if(member_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/members/disactive',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'member_id': member_id
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
        $(document).on('click', '.btn-active-member',  function(){
            var member_id = $(this).data('member_id');
            var fullname = $(this).data('fullname');
            $('.modal-body #text-content').html(fullname);
            $('#btn-comfirm-active').data('member_id', member_id);
            $('#modal-active-member').modal('show');
        });
        $('#btn-comfirm-active').click(function(){
            var member_id = $(this).data('member_id');
            if(member_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/members/active',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'member_id': member_id
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