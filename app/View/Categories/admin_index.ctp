<?php
//$this->Paginator->options(array(
//    "update" => "#content-category",
//    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
//    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
//    'evalScripts' => true,
//));
?>
<div class="main-content" id="content-category">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Chuyên mục</li>
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
                    <label class="col-sm-2 control-label">Nhóm</label>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('parent', array('name' => 'parent', 'type' => 'select', 'options' => $parents, 'empty' => ' -- Chọn nhóm - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['parent'])?$this->params['url']['parent']:''));?>
                    </div>
                    <div class="col-sm-6 text-left">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/categories" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
<!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>
                            Chuyên mục
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/categories/add" class="btn btn-xs btn btn-success">
                            Thêm <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    if(isset($categories))
                    {
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên loại</th>
                                <th>Link</th>
                                <th>Nhóm</th>
                                <th>Sắp xếp</th>
                                <th>
                                    Thao tác
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            ?>
                            <?php foreach($categories as $category): ?>
                                <tr>
                                    <td style="text-align: center" width="100px">
                                        <?php
                                        $paginate = $this->request->param('paging');
                                        echo ($count + 1) + (($paginate['Category']['page'] - 1) * $paginate['Category']['limit']);
                                        $count = $count + 1;
                                        ?>
                                    </td>
                                    <td><?php echo $category['Category']['categoryname'];?></td>
                                    <td><?php echo $category['Category']['categorylink'];?></td>
                                    <td><?php echo $category['Parent']['categoryname'];?></td>
                                    <td align="center"><?php echo $category['Category']['sort'];?></td>
                                    <td align="center">
                                        <a class="btn btn-xs btn-warning" title="Sửa" href="/admin/categories/edit/<?php echo $category['Category']['id'];?>"><i class="fa fa-pencil"></i> </a>
                                        <button type="button" data-category_id="<?php echo $category['Category']['id'];?>" data-categoryname="<?php echo $category['Category']['categoryname'];?>" class="btn btn-xs btn-danger btn-delete-category" title="Xóa" href=""><i class="fa fa-trash"></i> </button>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-category">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa chuyên mục: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-primary btn-xs"> Xóa <i class="fa fa-trash"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $('#li-product').addClass('active open');
        $('#li-category').addClass('active');
        $(document).on('click', '.btn-delete-category',  function(){
            var category_id = $(this).data('category_id');
            var categoryname = $(this).data('categoryname');
            $('.modal-body #text-content').html(categoryname);
            $('#btn-comfirm-delete').data('category_id', category_id);
            $('#modal-delete-category').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var category_id = $(this).data('category_id');
            if(category_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/categories/delete',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'category_id': category_id
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


