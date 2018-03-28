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
                <li class="active">Tin rao vặt</li>
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
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('parent_id', array('name' => 'parent_id', 'id' => 'parent_id', 'label' => false, 'type' => 'select', 'options' => $parents, 'empty' => ' -- Chọn nhóm -- ', 'class' => 'form-control', 'default' => isset($this->params['url']['parent_id'])?$this->params['url']['parent_id']:''));?>
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
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Thành viên</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('member', array('name' => 'member', 'class' => 'form-control', 'label' => false, 'value' => isset($this->params['url']['member'])?$this->params['url']['member']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Loại tin</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('packet', array('name' => 'packet', 'type' => 'select', 'options' => $packets, 'empty' => ' -- Chọn loại tin - ', 'class' => 'form-control', 'label' => false, 'default' => isset($this->params['url']['packet'])?$this->params['url']['packet']:''));?>
                    </div>
                    <label class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-2">
                        <?php echo $this->Form->input('status',
                            array(
                                'name' => 'filter',
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
                                'default' => isset($this->params['url']['filter'])?$this->params['url']['filter']:''
                            )
                        );
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-xs btn-warning"> Tìm <i class="fa fa-search"></i> </button>
                        <a href="/admin/products" type="submit" class="btn btn-xs btn-danger"> Xóa <i class="fa fa-remove"></i> </a>
                    </div>
                </div>
            </form>
        </div>
<!--        End form search-->
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <h1>
                        Danh sách tin
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
                                <div class="row list-style-<?php echo $item['Packet']['id'];?>">
                                    <div class="col-sm-2 col-xs-5 product-list-image">
                                        <a href="/admin/products/view/<?php echo $item['Product']['id'];?>">
                                            <?php
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                            if($item['Product']['image'])
                                            {
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/'.$item['Product']['image'];
                                            }
                                            ?>
                                            <div class="" style="height: 150px;background-image: url('<?php echo $imglink;?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
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
                                            <div class="summary">
                                                <?php
                                                echo htmlentities($item['Product']['summary'], ENT_QUOTES, 'UTF-8');
                                                ?>
                                            </div>
                                            <span class="location">
                                                <i class="fa fa-map-marker"> </i>
                                                <?php echo $item['District']['districttype'];?>
                                                <?php echo $item['District']['districtname'];?>,
                                                <?php echo $item['Province']['provincename'];?>
                                            </span>
                                            <span class="date">
                                                Ngày tạo:
                                                <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['created']);?>
                                                <?php
                                                $expiry = $item['Product']['expiry'] != ''? $this->Lib->convertDateTime_Mysql_to_Date($item['Product']['expiry']): '';
                                                echo 'Hết hạn: ' . $expiry;
                                                ?>
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
                                        <a class="btn btn-warning btn-xs" href="/admin/products/edit/<?php echo $item['Product']['id'];?>"><i class="fa fa-pencil"></i> </a>
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
                        echo '<div class="alert alert-warning">Không có tin</div>';
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php
$filter = isset($this->params['url']['filter'])? $this->params['url']['filter']: '';

?>
<?php echo $this->Js->writeBuffer();?>
<script>
    $(function () {
        var action = '<?php echo $filter;?>';
        $('#li-product').addClass('active open');
        $("#li-list-product-" + action).addClass('active');
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
                    },
                    success: function(string)
                    {
                        $('#district').html(string)
                    }
                });
            }
        });
        $('#parent_id').change(function () {
            var parent_id = $('#parent_id').val();
            if(parent_id != '')
            {
                $.ajax({
                    'url': '/categories/get_category',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'parent_id': parent_id
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
    })
</script>