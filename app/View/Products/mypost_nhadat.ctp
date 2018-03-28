<div class="container">
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="row">
                <div class="col-sm-8">
                    <h4 style="margin-top: 10px !important; margin-bottom: 10px !important;">QUẢN LÝ TIN ĐĂNG</h4>
                </div>
                <div class="col-sm-4 text-right">
                    <i class="fa fa-angle-down bigger-200"></i>
                </div>
                <div class="col-sm-12">
                    <hr style="margin: 0 auto 10px auto !important;">
                    <?php
                    $filter = '';
                    if(isset($this->params['url']['product_filter']))
                    {
                        $filter = $this->params['url']['product_filter'];
                    }
                    ?>
                    <div class="container-search-mypost">
                        <form class="form-horizontal" action="" method="get">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hình thức</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('transactiontype', array('name' => 'transactiontype', 'label' => false, 'type' => 'select', 'options' => $transactiontypes, 'empty' => ' -- Chọn hình thức -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['transactiontype'])?$this->params['url']['transactiontype']:''));?>
                                </div>
                                <label class="col-sm-2 control-label">Nhóm</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('group', array('name' => 'group', 'id' => 'group', 'label' => false, 'type' => 'select', 'options' => $groups, 'empty' => ' -- Chọn nhóm -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['group'])?$this->params['url']['group']:''));?>
                                </div>
                                <label class="col-sm-2 control-label">Loại</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('category', array('name' => 'category', 'id' => 'category', 'label' => false, 'type' => 'select', 'options' => $categories, 'empty' => ' -- Chọn -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['category'])?$this->params['url']['category']:''));?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tỉnh thành</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('province', array('name' => 'province', 'type' => 'select', 'options' => $provinces, 'empty' => ' -- Chọn tỉnh thành - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['province'])?$this->params['url']['province']:''));?>
                                </div>
                                <label class="col-sm-2 control-label">Quận huyện</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('district', array('name' => 'district', 'type' => 'select', 'options' => $districts, 'empty' => ' -- Chọn quận huyện - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['district'])?$this->params['url']['district']:''));?>
                                </div>
                                <label class="col-sm-2 control-label">Phường xã</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('ward', array('name' => 'ward', 'type' => 'select', 'options' => null, 'empty' => ' -- Chọn phường xã - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['ward'])?$this->params['url']['ward']:''));?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Loại tin</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('packet', array('name' => 'packet', 'type' => 'select', 'options' => $packets, 'empty' => ' -- Chọn loại tin - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['packet'])?$this->params['url']['packet']:''));?>
                                </div>
                                <label class="col-sm-2 control-label">Trạng thái</label>
                                <div class="col-sm-2">
                                    <?php echo $this->Form->input('status',
                                        array(
                                            'name' => 'product_filter',
                                            'type' => 'select',
                                            'empty' => ' -- Tất cả - ',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'options' => array(
                                                'visible' => 'Đang hiển thị',
                                                'expired' => 'Tin hết hạn',
                                                'draft' => 'Tin nháp',
                                                'deleted' => 'Đã xóa'
                                            ),
                                            'default' => isset($this->params['url']['product_filter'])?$this->params['url']['product_filter']:''
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                                    <a href="/members/mypost?product_filter=all" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div style="padding-bottom: 10px">
                Hiển thị <span class="orange bolder"><?php echo $this->params['paging']['Product']['current'] . '/' . $this->params['paging']['Product']['count'];?></span> tin đăng
            </div>
            <?php
            echo $this->Session->flash();
            ?>
            <div class="">
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
                                            <div class="col-sm-9 col-xs-12 product-list-summary">
                                                <h4 style="margin-top: -5px !important;">
                                                    <a href="/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                                        <?php
                                                        echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                        ?>
                                                    </a>
                                                </h4>
                                                <div class="">
                                                    <span class="price">
                                                        <?php
                                                        $price = $this->Lib->print_price($item['Product']['price'], $item['Product']['price2'], $item['Product']['opt_price']);
                                                        echo $price;
                                                        echo ' - ';
                                                        $acreage = $this->Lib->print_acreage($item['Product']['acreage'], $item['Product']['acreage2']);
                                                        echo $acreage;
                                                        ?>
                                                    </span>
                                                    <span class="location">
                                                        <i class="fa fa-map-marker"> </i>
                                                        <?php echo $item['Product']['address'] != ''? htmlentities($item['Product']['address'], ENT_QUOTES, 'UTF-8') . ',' : '';?>
                                                        <?php echo $item['Ward']['wardtype'];?>
                                                        <?php echo $item['Ward']['wardname'];?>,
                                                        <?php echo $item['District']['districttype'];?>
                                                        <?php echo $item['District']['districtname'];?>,
                                                        <?php echo $item['Province']['provincename'];?>
                                                    </span>
                                                    <span class="date">
                                                    <i class="fa fa-calendar"> </i>
                                                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);?>
                                                    </span>
                                                    <div class="product-button-action">
                                                        <?php
                                                        $action_edit = '/sua-tin-bat-dong-san';
                                                        if($item['Transactiontype']['id'] == 3 || $item['Transactiontype']['id'] == 4)
                                                        {
                                                            $action_edit = '/sua-tin-can-mua-can-thue';
                                                        }
                                                        if($status == 'visible')
                                                        {
                                                            if($item['Product']['re_up'] > 0)
                                                            {
                                                                echo 'Còn ' . $item['Product']['re_up'] . ' lần up, lần up cuối cùng ' . $this->Lib->convertDateTime_Mysql_to_DateTime($item['Product']['date_re_up']) . '<br>';
                                                                ?>
                                                                <a class="text-primary btn-re-up-product" href="javascript: void(0)"
                                                                   data-product_id="<?php echo $item['Product']['id'];?>"
                                                                   data-product_title="<?php echo $item['Product']['title'];?>">
                                                                    <i class="fa fa-arrow-up"></i> Up tin
                                                                </a> |
                                                                <?php
                                                            }
                                                            ?>
                                                            <a class="text-warning" href="<?php echo $action_edit;?>?pid=<?php echo $item['Product']['id'];?>">
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
                                                                        <a href="https://www.facebook.com/sharer?u=<?php echo $_SERVER['HTTP_HOST'] . '/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẻ lên Facebook" target="_blank">
                                                                            <span class="blue">
                                                                                <i class="ace-icon fa fa-facebook bigger-120"></i>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . '/' .$item['Product']['productlink'] . '-' . $item['Product']['id'] ?>" title="Chia sẽ lên Google+" target="_blank">
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
                                                            <a class="text-warning" href="<?php echo $action_edit;?>?pid=<?php echo $item['Product']['id'];?>">
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
                                                            <a class="text-warning" href="<?php echo $action_edit;?>?pid=<?php echo $item['Product']['id'];?>">
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
                                    </div>
                                </td>
                                <td align="center">
                                    <?php echo $item['Product']['expiry'] != '0000-00-00 00:00:00'? $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['expiry']): '_';?>
                                </td>
                                <td align="center">
                                    <?php
                                    echo $item['Packet']['packetname']? $item['Packet']['packetname']: '_';
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <!--            Paginate-->
                    <?php if($this->params['paging']['Product']['pageCount'] > 1):?>
                        <div class="pagination">
                            <ul class="pagination">
                                <?php
                                // echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                // echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                // echo $this->Paginator->next(__('>>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                echo urldecode($this->Paginator->numbers(
                                    array(
                                        'separator' => '',
                                        'currentTag' => 'a',
                                        'currentClass' => 'active',
                                        'tag' => 'li',
                                        'ellipsis'=>'<li class="ellipsis"><a>...</a></li>',
                                        'modulus' => 4,
                                        'first' => 2,
                                        'last' => 2
                                    )));
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
                <div class="content-before">
                    <p>Xác nhận xóa tin đăng: <b id="text-content"></b></p>
                </div>
                <div class="text-center content-after" style="color: #ec971f; font-size: 2em">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-ban"></i> <?php echo __('Cancel');?> </button>
                <button id="btn-comfirm-delete" type="button" class="btn btn-primary"> <i class="fa fa-trash"></i> <?php echo __('Delete');?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-re-up">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __('Confirm');?></h4>
            </div>
            <div class="modal-body">
                <p>Bạn muốn re-up tin đăng này</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-ban"></i> Hủy</button>
                <button id="btn-comfirm-re-up" type="button" class="btn btn-primary"> <i class="fa fa-trash"></i> Xác nhận</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<script>
    $(function () {

        $('#product-filter').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Lọc'
        });
        $('#province').change(function () {
            var province_id = $('#province').val();
            if(province_id != '')
            {
                $.ajax({
                    'url': '/districts/get_district',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'province_id': province_id
                    },
                    beforeSend: function () {
                        $('#district').html('<option disabled selected>Đang tải</option>')
                        $('#ward').html('<option selected>Xã phường</option>')
                    },
                    success: function(string)
                    {
                        $('#district').html(string)
                    }
                });
            }
        });
        $('#district').change(function () {
            var district_id = $('#district').val();
            if(district_id != '')
            {
                $.ajax({
                    'url': '/wards/get_ward',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'district_id': district_id
                    },
                    beforeSend: function () {
                        $('#ward').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#ward').html(string)
                    }
                });
            }
        });
        $('#group').change(function () {
            var group_id = $('#group').val();
            if(group_id != '')
            {
                $.ajax({
                    'url': '/categories/get_category',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'groupproduct_id': group_id
                    },
                    beforeSend: function () {
                        $('#category').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#category').html(string)
                    }
                });
            }
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

                },
                success: function(){
                    window.location = window.location;
                }
            });
        });
        $('.btn-re-up-product').on('click', function(){
            var product_id = $(this).data('product_id');
            $('#btn-comfirm-re-up').data('product_id', product_id);
            $('#modal-re-up').modal('show');
        });
        $('#btn-comfirm-re-up').click(function(){
            var product_id = $(this).data('product_id');
            $.ajax({
                url: '/members/re_up_mypost',
                type: 'post',
                dataType: 'html',
                data: {
                    'product_id': product_id,
                    're_up_product': true
                },
                beforeSend: function(){

                },
                success: function(){
                    window.location = window.location;
                },
            });
        });


    })
</script>