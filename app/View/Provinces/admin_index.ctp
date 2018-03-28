<?php
$this->Paginator->options(array(
    "update" => "#content-province",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-province">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Tỉnh thành</li>
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
                            Danh sách tỉnh thành
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                                ?>
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-xs btn btn-success" href="/admin/provinces/add"> Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($provinces))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>
                                    <?php echo $this->Paginator->sort('provincename', 'Tỉnh thành phố');?>
                                </th>
                                <th><?php echo $this->Paginator->sort('provincetype', 'Loại');?></th>
                                <th>Link</th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($provinces as $province): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['Province']['page'] - 1) * $paginate['Province']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $province['Province']['provincename'];?></td>
                                    <td align="center"><?php echo $province['Province']['provincetype'];?></td>
                                    <td><?php echo $province['Province']['provincelink'];?></td>
                                    <td align="center" style="width: 100px !important;">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/provinces/edit/<?php echo $province['Province']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-xs btn-danger btn-delete-province" data-province_id="<?php echo $province['Province']['id'];?>" data-provincename="<?php echo $province['Province']['provincename'];?>" title="Xóa" href="javascript:void(0)"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
                            <?php echo $this->Paginator->numbers(array(
                                'class' => 'numbers',
                            ));?>
                            <?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php echo $this->Js->writeBuffer();?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-province">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa tỉnh thành: <b id="text-content"></b></p>
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
        $('#li-province').addClass('active');
        $(document).on('click', '.btn-delete-province',  function(){
            var province_id = $(this).data('province_id');
            var provincename = $(this).data('provincename');
            $('.modal-body #text-content').html(provincename);
            $('#btn-comfirm-delete').data('province_id', province_id);
            $('#modal-delete-province').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var province_id = $(this).data('province_id');
            if(province_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/provinces/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'province_id': province_id
                    },
                    success: function(st)
                    {
                        window.location = window.location;
                    }
                })
            }
        });
        $('th a').append(' <i class="fa fa-sort"></i>');
        $('th a.asc i').attr('class', 'fa fa-sort-asc');
        $('th a.desc i').attr('class', 'fa fa-sort-desc');
        $('.pagination span a').on('click', function(){
            var url = this.href;
            history.pushState(null, '', url);
        });
        $('th a').on('click', function(){
            var url = this.href;
            history.pushState(null, '', url);
        });
    })
</script>