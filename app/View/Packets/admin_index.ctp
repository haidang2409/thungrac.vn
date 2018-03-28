<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Dịch vụ gói tin</li>
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
                            Dịch vụ gói tin
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/packets/add" class="btn btn-xs btn btn-success">
                            Thêm <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($packets))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên gói tin</th>
                                <th>Giá</th>
                                <th>Giảm giá</th>
                                <th>Thời gian</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($packets as $item): ?>
                                <tr>
                                    <td style="text-align: center" width="50">
                                        <?php
                                        echo $count + 1;
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $item['Packet']['packetname'];?></td>
                                    <td align="right">
                                        <?php
                                        echo number_format($item['Packet']['price'], 0, '', '.');
                                        ?>đ
                                    </td>
                                    <td align="right">
                                        <?php
                                        if($item['Packet']['discount'])
                                        {
                                            echo number_format($item['Packet']['discount'], 0, '', '.') . 'đ';
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Packet']['date'] . ' ngày';?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $item['Packet']['summary'];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/packets/edit/<?php echo $item['Packet']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button class="btn btn-xs btn-danger btn-delete-packet" title="Xóa" data-packet_id="<?php echo $item['Packet']['id'];?>" data-packetname="<?php echo $item['Packet']['packetname'];?>" ><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-packet">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa: <b id="text-content"></b></p>
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
        $('#li-order').addClass('active open');
        $('#li-packet').addClass('active');
        $(document).on('click', '.btn-delete-packet',  function(){
            var packet_id = $(this).data('packet_id');
            var packetname = $(this).data('packetname');
            $('.modal-body #text-content').html(packetname);
            $('#btn-comfirm-delete').data('packet_id', packet_id);
            $('#modal-delete-packet').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var packet_id = $(this).data('packet_id');
            if(packet_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/packets/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'packet_id': packet_id
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