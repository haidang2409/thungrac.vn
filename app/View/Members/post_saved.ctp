<div class="container">
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 10px !important; margin-bottom: 10px !important;">Tin đăng đã lưu</h3>
                </div>
            </div>
            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <div class="">
                <?php if(count($product_saved) > 0):?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>
                                Tin đã lưu
                            </th>
                            <th>
                                Xóa
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum_product = count($product_saved);
                        for($i = 0; $i < $sum_product; $i++)
                        {
                            $item = $product_saved[$i];
                            ?>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <div class="row list-style-2">
                                            <div class="col-sm-3 col-xs-5 product-list-image">
                                                <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                    <?php
                                                    $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                                    if($item['Product']['image'])
                                                    {
                                                        $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                                    }
                                                    ?>
                                                    <div class=""
                                                         style="height: 100px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-9 col-xs-7 product-list-summary">
                                                <h4>
                                                    <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                        <?php
                                                        echo $item['Product']['title'];
                                                        ?>
                                                    </a>
                                                </h4>
                                                <div class="">
                                                    <span class="price">
                                                    <?php if($item['Product']['price'] == 0):?>
                                                        Giá thỏa thuận
                                                    <?php elseif ($item['Product']['price'] > 0 && $item['Product']['price2'] > $item['Product']['price']): ?>
                                                        <i class="fa fa-dollar"></i>
                                                        <?php echo 'Giá ' . $this->Lib->format_price_onlynumber($item['Product']['price']) . ' - ' . $this->Lib->format_price($item['Product']['price2']);?>
                                                    <?php else:?>
                                                        <i class="fa fa-dollar"></i>
                                                        <?php echo $this->Lib->format_price($item['Product']['price']);?>
                                                    <?php endif ?>
                                                        <!--                                    Acreage-->
                                                    - <i class="fa fa-book"></i>
                                                        <?php if ($item['Product']['acreage'] > 0 && $item['Product']['acreage2'] > $item['Product']['acreage']): ?>
                                                            <?php echo number_format($item['Product']['acreage'], 0, '', '.') . ' - ' . number_format($item['Product']['acreage2'], 0, '', '.');?>m<sup>2</sup>
                                                        <?php else:?>
                                                            <?php echo number_format($item['Product']['acreage'], 0, '', '.');?>m<sup>2</sup>
                                                        <?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td align="center">
                                    <button class="btn btn-danger btnDeletePostSaved" title="Xóa tin đã lưu" data-product_id="<?php echo $item['Product']['id'];?>"><i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                <?php else:?>
                    <div class="alert alert-warning">
                        Không có tin lưu
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-product-saved">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __('Confirm');?></h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa?</p>
                </div>
                <div id="content-after" class="text-center" style="color: #ec971f; font-size: 2em">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-ban"></i> <?php echo __('Cancel');?> </button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-primary"> <i class="fa fa-trash"></i> <?php echo __('Delete');?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $('.btnDeletePostSaved').on('click', function(){
            var product_id = $(this).data('product_id');
            $('#btn-comfirm-delete').data('product_id', product_id);
            $('#modal-delete-product-saved').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var product_id = $(this).data('product_id');
            $.ajax({
                url: '/members/delete_postsaved',
                type: 'post',
                dataType: 'html',
                data: {
                    'product_id': product_id,
                    'delete_product': true
                },
                beforeSend: function(){
                    $('#content-before').hide();
                    $('#content-after').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(){
                    window.location = window.location;
                },
            });
        });
    })
</script>