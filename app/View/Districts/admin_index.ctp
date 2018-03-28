<?php
$this->Paginator->options(array(
    "update" => "#content-district",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-district">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Quận huyện</li>
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
                    <label class="col-sm-2 control-label">Quận huyện</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" value="<?php echo isset($this->params['url']['name'])? $this->params['url']['name']:'';?>">
                    </div>
                    <label class="col-sm-2 control-label">Loại</label>
                    <div class="col-sm-4">
                        <select name="type" class="form-control">
                            <option value=""> -- Loại -- </option>
                            <option <?php if(isset($this->params['url']['type']) && $this->params['url']['type'] == 'Quận') { echo 'selected';};?> value="Quận">Quận</option>
                            <option <?php if(isset($this->params['url']['type']) && $this->params['url']['type'] == 'Huyện') { echo 'selected';};?> value="Huyện">Huyện</option>
                            <option <?php if(isset($this->params['url']['type']) && $this->params['url']['type'] == 'Thị Xã') { echo 'selected';};?> value="Thị Xã">Thị Xã</option>
                            <option <?php if(isset($this->params['url']['type']) && $this->params['url']['type'] == 'Thành Phố') { echo 'selected';};?> value="Thành Phố">Thành Phố</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tỉnh thành</label>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('province', array('name' => 'province', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['province'])?$this->params['url']['province']:''));?>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/districts" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
        <!--            End search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>
                            Danh sách quận huyện
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php
                                echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                                ?>
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/districts/add" class="btn btn-xs btn-success"> Thêm <i class="fa fa-plus"></i> </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($districts))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th><?php echo $this->Paginator->sort('districtname', 'Quận huyện');?></th>
                                <th><?php echo $this->Paginator->sort('districttype', 'Loại');?></th>
                                <th>
                                    <?php echo $this->Paginator->sort('Province.provincename', 'Tỉnh thành');?>
                                </th>
                                <th>
                                    Link
                                </th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($districts as $district): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['District']['page'] - 1) * $paginate['District']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $district['District']['districtname'];?></td>
                                    <td align="center"><?php echo $district['District']['districttype'];?></td>
                                    <td><?php echo $district['Province']['provincetype'] . ' ' . $district['Province']['provincename'];?></td>
                                    <td><?php echo $district['District']['districtlink'];?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/districts/edit/<?php echo $district['District']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button class="btn btn-xs btn-danger btn-delete-district" title="Xóa" data-district_id="<?php echo $district['District']['id'];?>" data-districtname="<?php echo $district['District']['districtname'];?>" ><i class="fa fa-trash"></i> </button>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-district">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa quận huyện: <b id="text-content"></b></p>
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
        $('#li-district').addClass('active');
        $(document).on('click', '.btn-delete-district',  function(){
            var district_id = $(this).data('district_id');
            var districtname = $(this).data('districtname');
            $('.modal-body #text-content').html(districtname);
            $('#btn-comfirm-delete').data('district_id', district_id);
            $('#modal-delete-district').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var district_id = $(this).data('district_id');
            if(district_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/districts/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'district_id': district_id
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