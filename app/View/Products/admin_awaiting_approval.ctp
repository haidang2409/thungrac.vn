<?php
$this->Paginator->options(array(
    "update" => "#content-product",
    "before" => $this->Js->get("#spinner")->effect("fadeIn", array("buffer" => false)),
    "complete" => $this->Js->get("#spinner")->effect("fadeOut", array("buffer" => false)),
    'evalScripts' => true,
));
?>
<div class="main-content" id="content-product">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Tin đang chờ duyệt</li>
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
        <!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <h1>
                        Tin đang chờ duyệt
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo 'Showing ' . $this->Paginator->param('current') . ' of ' . $this->Paginator->param('count');
                            ?>
                        </small>
                    </h1>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12 product-container">
                    <?php
                    echo $this->Session->flash();
                    if(isset($products) && count($products) > 0)
                    {
                        $sum_product = count($products);
                        for($i = 0; $i < $sum_product; $i++)
                        {
                            $item = $products[$i];
                            ?>
                            <div class="list-product-bg-hover">
                                <div class="row list-style-1">
                                    <div class="col-sm-2 col-xs-5 product-list-image">
                                        <a href="/admin/products/view/<?php echo $item['Product']['id'];?>">
                                            <?php
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                            if($item['Product']['image'])
                                            {
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                            }
                                            ?>
                                            <div class=""
                                                 style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                                <div class="" style="background-color: #ecd5a2; padding: 5px; font-size: 20px">
                                                    <?php echo $item['Packet']['packetname'];?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-9 col-xs-7 product-list-summary">
                                        <hr>
                                        <h4>
                                            <a href="/admin/products/view/<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
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
                                            <div class="summary">
                                                <?php
                                                echo $item['Product']['summary'];
                                                ?>
                                            </div>
                                            <span class="date">
                                                <i class="fa fa-calendar"> </i>
                                                <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);?>
                                            </span>
                                            <span class="member">
                                                <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                                <?php echo $item['Member']['fullname'];?>
                                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                    <span class="phone-number">
                                                        <?php echo $item['Product']['phonenumber'];?>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <button class="btn btn-info btn-xs btnApprovalProduct" data-order_id="<?php echo $item['Order']['id'];?>" data-product_id="<?php echo $item['Product']['id'];?>" data-title="<?php echo $item['Product']['title'];?>"> Duyệt <i class="fa fa-check"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="pagination">
                            <?php echo $this->Paginator->prev('<< ' . __('Previous', true), array(), null, array('class'=>'disabled'));?>
                            <?php echo $this->Paginator->numbers(array(
                                'class' => 'numbers',
                            ));?>
                            <?php echo $this->Paginator->next(__('Next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-warning">Không có tin</div>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-approval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <div id="content-before">
                    <p>Duyệt tin: <b id="text-content"></b></p>
                </div>
                <div id="content-after" class="text-center" style="display: none; color: #ec971f; font-size: 2em">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal"> Hủy <i class="fa fa-ban"></i></button>
                <button id="btn-comfirm-approval" type="button" class="btn btn-primary btn-xs"> Duyệt <i class="fa fa-check"></i> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {
        $('#li-product').addClass('active open');
        $('#li-awaiting-approval').addClass('active');
        $(document).on('click', '.btnApprovalProduct',  function(){
            var product_id = $(this).data('product_id');
            var order_id = $(this).data('order_id');
            var title = $(this).data('title');
            $('.modal-body #text-content').html(title);
            $('#btn-comfirm-approval').data('product_id', product_id);
            $('#btn-comfirm-approval').data('order_id', order_id);
            $('#modal-approval').modal('show');
        });
        $('#btn-comfirm-approval').click(function(){
            var product_id = $(this).data('product_id');
            var order_id = $(this).data('order_id');
            if(product_id != '' && order_id != '')
            {
                $('.modal-body #content-before').hide();
                $('.modal-body #content-after').show();
                $.ajax({
                    url: '/admin/products/confirm_approval',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'product_id': product_id,
                        'order_id' : order_id
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