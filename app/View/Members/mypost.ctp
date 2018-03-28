<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 10px !important; margin-bottom: 10px !important;">Tin đăng của tôi</h3>
                    <br>
                </div>
                <div class="col-sm-12">
                    <?php
                    $filter = isset($this->params['url']['product_filter'])? $this->params['url']['product_filter']: '';
                    $category = isset($this->params['url']['category'])? $this->params['url']['category']: '';
                    ?>
                    <form class="form-horizontal" method="get" action="">
                        <div class="form-group" style="margin-bottom: 10px !important;">
                            <label class="col-sm-2 hidden-xs control-label">Trạng thái</label>
                            <div class="col-sm-3 col-xs-12">
                                <select name="product_filter" style="width: 100%" id="product-filter">
                                    <option value="all"><?php echo __('All');?></option>
                                    <option <?php if($filter == 'visible'){ echo 'selected';}?> value="visible"><?php echo __('Visible');?></option>
                                    <option <?php if($filter == 'expired'){ echo 'selected';}?> value="expired"><?php echo __('Expired');?></option>
                                    <option <?php if($filter == 'draft'){ echo 'selected';}?> value="draft"><?php echo __('Draft');?></option>
                                </select>
                            </div>
                            <label class="col-sm-2 hidden-xs control-label">Danh mục</label>
                            <div class="col-sm-3 col-xs-12">
                                <?php echo $this->Form->input('category', array('type' => 'select', 'name' => 'category', 'options' => $categories, 'style' => 'width: 100% important!', 'label' => false, 'empty' => '-- Tất cả --', 'default' => $category));?>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-index" type="submit"><i class="fa fa-search"></i> TÌM</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <div class="" style="overflow-x: auto">
                <?php if(count($products) > 0):?>
                    <table class="table">
                        <tr>
                            <th>
                                Tin đăng
                            </th>
                            <th class="center">
                                Hết hạn
                            </th>
                            <th class="center">
                                Gói tin
                            </th>
                        </tr>
                        <tbody>
                        <?php
                        $sum_product = count($products);
                        for($i = 0; $i < $sum_product; $i++)
                        {
                            $item = $products[$i];
                            //status of product
                            $date = getdate();
                            $cur_date = new DateTime($date['year'] . '-' . $date['mon'] . '-' . $date['mday']);
                            $timestamp_curr = $cur_date->getTimestamp();
                            $date_expiry = new DateTime($item['Product']['expiry']);
                            $timestamp_expiry = $date_expiry->getTimestamp();
                            //test
                            $status = '';
                            //visible
                            if($timestamp_expiry >= $timestamp_curr && $item['Product']['status'] == 1 && $item['Product']['paid'] == 1 && $item['Product']['deleted'] == 0)
                            {
                                $status = 'visible';
                            }
                            //Expired
                            if($timestamp_expiry < $timestamp_curr && $item['Product']['expiry'] > 0 && $item['Product']['status'] == 1 && $item['Product']['paid'] == 1 && $item['Product']['deleted'] == 0)
                            {
                                $status = 'expired';
                            }
                            //draft
                            if($item['Product']['status'] == 0 && $item['Product']['paid'] == 0 && $item['Product']['deleted'] == 0)
                            {
                                $status = 'draft';
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <div class="row list-style-2">
                                            <div class="col-sm-3 hidden-xs product-list-image">
                                                <a href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
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
                                            <div class="col-sm-9 col-xs-12 product-list-summary">
                                                <h4>
                                                    <a href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                        <?php
                                                        echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                        ?>
                                                    </a>
                                                </h4>
                                                <div class="">
                                                    <span class="price">
                                                        <?php if($item['Product']['price'] == 0):?>
                                                            Giá thỏa thuận
                                                        <?php else:?>
                                                            <i class="fa fa-dollar"></i>
                                                            <?php echo number_format($item['Product']['price'], 0, '', '.');?>
                                                        <?php endif ?>
                                                    </span>
                                                    <span class="location">
                                                        <i class="fa fa-map-marker"> </i>
                                                        <?php echo $item['District']['districttype'];?>
                                                        <?php echo $item['District']['districtname'];?>,
                                                        <?php echo $item['Province']['provincename'];?>
                                                    </span>
                                                    <span class="date">
                                                        <i class="fa fa-calendar"> </i>
                                                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);?>
                                                    </span>
                                                </div>
                                                <div class="product-button-action">
                                                    <?php
                                                    if($status == 'visible')
                                                    {
//                                                        if($item['Product']['re_up'] > 0)
//                                                        {
//                                                            echo 'Còn ' . $item['Product']['re_up'] . ' lần up, lần up cuối cùng ' . $this->Lib->convertDateTime_Mysql_to_DateTime($item['Product']['date_re_up']) . '<br>';
//                                                            ?>
<!--                                                            <a class="text-primary btn-re-up-product" href="javascript: void(0)"-->
<!--                                                               data-product_id="--><?php //echo $item['Product']['id'];?><!--"-->
<!--                                                               data-product_title="--><?php //echo $item['Product']['title'];?><!--">-->
<!--                                                                <i class="fa fa-arrow-up"></i> Up tin-->
<!--                                                            </a> |-->
<!--                                                            --><?php
//                                                        }
                                                        ?>
                                                        <a class="text-warning" href="/sua-tin?pid=<?php echo $item['Product']['id'];?>">
                                                            <i class="fa fa-pencil"></i> Sửa
                                                        </a> |
                                                        <a class="text-danger btn-delete-product" href="javascript: void(0)"
                                                           data-product_id="<?php echo $item['Product']['id'];?>"
                                                           data-product_title="<?php echo $item['Product']['title'];?>">
                                                            <i class="fa fa-trash-o"></i> Xóa
                                                        </a> |
                                                        <div class="inline pos-rel">
                                                            <a href="javascript: void(0)" class="dropdown-toggle" data-toggle="dropdown" data-position="auto" aria-expanded="false">
                                                                <i class="ace-icon fa fa-share icon-only bigger-110"></i> Chia sẻ
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                <li>
                                                                    <a href="https://www.facebook.com/sharer?u=<?php echo $_SERVER['HTTP_HOST'] . '/rao-vat/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẻ lên Facebook" target="_blank">
                                                                            <span class="blue">
                                                                                <i class="ace-icon fa fa-facebook bigger-120"></i>
                                                                            </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . '/rao-vat/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẽ lên Google+" target="_blank">
                                                                            <span class="red">
                                                                                <i class="ace-icon fa fa-google-plus bigger-120"></i>
                                                                            </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?php
                                                    }
                                                    elseif($status == 'expired')
                                                    {
                                                        ?>
                                                        <a class="text-success" href="/packets/paid?pid=<?php echo $item['Product']['id'];?>">
                                                            <i class="fa fa-refresh"></i> Gia hạn
                                                        </a> |
                                                        <a class="text-warning" href="/sua-tin?pid=<?php echo $item['Product']['id'];?>">
                                                            <i class="fa fa-pencil"></i> Sửa
                                                        </a> |
                                                        <a class="text-danger btn-delete-product" href="javascript: void(0)"
                                                           data-product_id="<?php echo $item['Product']['id'];?>"
                                                           data-product_title="<?php echo $item['Product']['title'];?>">
                                                            <i class="fa fa-trash-o"></i> Xóa
                                                        </a>
                                                        <?php
                                                    }
                                                    elseif($status == 'draft')
                                                    {
                                                        ?>
                                                        <a class="text-warning" href="/sua-tin?pid=<?php echo $item['Product']['id'];?>">
                                                            <i class="fa fa-pencil"></i> Sửa
                                                        </a> |
                                                        <a class="text-success" href="/packets/paid?pid=<?php echo $item['Product']['id'];?>">
                                                            <i class="fa fa-cc-visa"></i> Thanh toán
                                                        </a> |
                                                        <a class="text-danger btn-delete-product" href="javascript: void(0)"
                                                           data-product_id="<?php echo $item['Product']['id'];?>"
                                                           data-product_title="<?php echo $item['Product']['title'];?>">
                                                            <i class="fa fa-trash-o"></i> Xóa
                                                        </a>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        echo '<span class="text-warning">Đang chờ duyệt</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td align="center">
                                    <?php echo $item['Product']['expiry'] != '0000-00-00 00:00:00' && $item['Product']['expiry'] != ''? $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['expiry']): '-';?>
                                </td>
                                <td align="center">
                                    <?php echo $item['Packet']['packetname'];?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <!--            Paginate-->
                    <?php if($this->params['paging']['Product']['pageCount'] > 1):?>
                        <div>
                            Hiển thị <?php echo $this->params['paging']['Product']['current'];?>
                            /<?php echo $this->params['paging']['Product']['count'];?>
                        </div>
                        <div class="pagination">
                            <ul class="pagination">
                                <?php
                                echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next(__('>>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                ?>
                            </ul>
                        </div>
                    <?php endif;?>

                    <!--            End paginate-->
                <?php else:?>
                    <div class="alert alert-warning">
                        Không có tin
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete-product">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __('Confirm');?></h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Xác nhận xóa tin đăng: <b id="text-content"></b></p>
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
        $('#product-filter, #category').select2({
            minimumResultsForSearch: -1,
        });
        $('.btn-delete-product').on('click', function(){
            var product_id = $(this).data('product_id');
            var product_title = $(this).data('product_title');
            $('.modal-body #text-content').text(product_title).html();
            $('#btn-comfirm-delete').data('product_id', product_id);
            $('#modal-delete-product').modal('show');
        });
        $('#btn-comfirm-delete').click(function(){
            var product_id = $(this).data('product_id');
            $.ajax({
                url: '/members/delete_mypost',
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