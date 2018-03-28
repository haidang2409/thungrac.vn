<div class="main-content" id="content-group">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/settings/">Thiết lập</a></li>
                <li> Tài khoản email</li>
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
                            Tài khoản email
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/emailaccs/add" class="btn btn-xs btn-success">Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($emailaccs))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Mật khẩu</th>
                                <th>Host name</th>
                                <th>Port</th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($emailaccs as $emailacc): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        echo ($count + 1);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $emailacc['Emailacc']['name'];?></td>
                                    <td><?php echo $emailacc['Emailacc']['email'];?></td>
                                    <td><?php echo $emailacc['Emailacc']['password'];?></td>
                                    <td><?php echo $emailacc['Emailacc']['host'];?></td>
                                    <td align="center"><?php echo $emailacc['Emailacc']['port'];?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/emailaccs/edit/<?php echo $emailacc['Emailacc']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button data-emailacc_id="<?php echo $emailacc['Emailacc']['id'];?>" data-email="<?php echo $emailacc['Emailacc']['email'];?>" class="btn btn-xs btn-danger btn-delete-emailacc" title="Xóa" href=""><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-emailacc">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa email: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-primary"> Xóa <i class="fa fa-trash"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $(document).on('click', '.btn-delete-emailacc',  function(){
            var emailacc_id = $(this).data('emailacc_id');
            var email = $(this).data('email');
            $('.modal-body #text-content').html(email);
            $('#btn-comfirm-delete').data('emailacc_id', emailacc_id);
            $('#modal-delete-emailacc').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var emailacc_id = $(this).data('emailacc_id');
            if(emailacc_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/emailaccs/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'emailacc_id': emailacc_id
                    },
                    success: function()
                    {
                        window.location = window.location;
                    },
                    error: function()
                    {
                        window.location = window.location;
                    }

                })
            }
        });
    })
</script>