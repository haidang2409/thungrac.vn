<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Tin đăng</li>
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
                    <div class="col-sm-6">
                        <h1>
                            Sửa tin đăng
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12" data-step="1">
                    <?php
                    echo $this->Session->flash();
                    ?>
                    <?php
                    echo $this->Form->create('Product', array('class' => 'form-horizontal', 'novalidate' => true, 'enctype' => 'multipart/form-data'))
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <!--                                   Tiêu đề-->
                            <div class="form-group">
                                <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                    Tiêu đề tin đăng
                                    <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <?php
                                    echo $this->Form->input('title', array('id' => 'title', 'label' => false, 'class' => 'form-control', 'value' => $product['Product']['title']));
                                    echo $this->Form->input('id', array('id' => 'id', 'label' => false, 'class' => 'form-control', 'value' => $product['Product']['id']))
                                    ?>
                                </div>
                                <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                                    <div class="div-hint">
                                        Tiêu đề ít nhất 20 ký tự và không quá 70 ký tự để được hiển thị tốt hơn <span id="numchar-title">0/70</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!--                                    Category-->
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">Chọn loại <font class="label-require">(*)</font></label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('parent_id', array('id' => 'parent_id', 'type' => 'select', 'options' => $categories_parent, 'label' => false, 'empty' => ' -- Chọn loại -- ', 'style' => 'width: 100% !important', 'default' => $product['Parent']['id']))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right"><font class="label-require">(*)</font></label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('category_id', array('id' => 'category_id', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn -- ', 'options' => $categories_child, 'style' => 'width: 100% !important', 'default' => $product['Category']['id']))
                                    ?>
                                </div>
                            </div>
                            <div id="div_input_feature">
                                <?php
                                if(isset($features) && count($features) > 0)
                                {
                                    ?>
                                    <div class="form-group">
                                        <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right"><?php echo $product['Category']['feature_note'];?></label>
                                        <div class="col-sm-6 col-xs-12">
                                            <?php
                                            echo $this->Form->input('feature_id', array('id' => 'feature', 'type' => 'select', 'options' => $features, 'label' => false, 'empty' => ' -- Chọn -- ', 'style' => 'width: 100% !important', 'default' => $product['Product']['feature_id']))
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--                                Price-->
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">
                                    Giá bán
                                    <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text', 'value' => $product['Product']['price']))
                                    ?>
                                </div>
                                <div class="col-sm-6 col-sm-offset-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label style="padding-left: 10px !important;">
                                                    <?php
                                                    $pri_deal = false;
                                                    echo $this->Form->input('Product.pricedeal', array('id' => 'chk_deal', 'type' => 'checkbox', 'div' => false, 'class' => 'ace', 'label' => false, 'value' => 1, 'checked' => $pri_deal))
                                                    ?>
                                                    <span class="lbl"> Giá thỏa thuận</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="price_convert" style="padding-top: 7px" class="col-sm-6 text-right">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!--                                    SDT-->
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-6">
                                    <div class="checkbox" style="padding-left: 0 !important;">
                                        <label>
                                            <input name="data[Product][deposit]" value="1" class="ace ace-checkbox-2" type="checkbox">
                                            <span class="lbl"> Ký gửi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">
                                    Số điện thoại liên hệ <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('phonenumber', array('id' => 'phonenumber', 'label' => false, 'class' => 'form-control', 'value' => $member['Member']['phonenumber']))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">
                                    Họ tên liên hệ <font class="label-require">(*)</font>
                                </label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('fullname', array('id' => 'fullname', 'label' => false, 'class' => 'form-control', 'value' => $member['Member']['fullname']))
                                    ?>
                                </div>
                            </div>
                            <!--                                    Location-->
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">Bạn đang ở đâu <font class="label-require">(*)</font></label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'options' => $provinces, 'label' => false, 'empty' => ' -- Chọn tỉnh thành -- ', 'style' => 'width: 100% !important', 'default' => $product['Province']['id']))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">Quận huyện <font class="label-require">(*)</font></label>
                                <div class="col-sm-6 col-xs-12">
                                    <?php
                                    echo $this->Form->input('district_id', array('id' => 'district', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn quận huyện -- ', 'options' => $districts, 'style' => 'width: 100% !important', 'default' => $product['District']['id']))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                                    Des-->
                    <div class="form-group">
                        <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                            Tóm tắt
                        </label>
                        <div class="col-sm-9 col-xs-12">
                            <?php
                            echo $this->Form->input('summary', array('id' => 'summary', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '2', 'value' => $product['Product']['summary']))
                            ?>
                        </div>
                    </div>
                    <!--                                    Des-->
                    <div class="form-group">
                        <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                            Mô tả chi tiết <font class="label-require">(*)</font>
                        </label>
                        <div class="col-sm-9 col-xs-12">
                            <?php
                            echo $this->Form->input('description', array('id' => 'description', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '8', 'escape' => true, 'default' => $product['Product']['description']))
                            ?>
                        </div>
                    </div>
                    <!--                                    Hình ảnh-->
                    <div id="div-hinhanh">
                        <div class="form-group">
                            <label for="" class="col-sm-3 col-xs-12 control-label no-padding-right">
                                Hình ảnh <font class="label-require">(*)</font>
                            </label>
                            <div class="col-sm-9 col-xs-12">
                                <label class="ace-file-input ace-file-multiple">
                                    <?php
                                    echo $this->Form->input('Imagesproduct.imagelink. ', array('id' => 'id-input-file-3', 'type' => 'file', 'multiple' => true, 'label' => false, 'div' => false));
                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-sm-offset-3 col-xs-12">
                        <div class="row" style="margin-top: 10px">
                            <?php
                            for($i = 0; $i < count($images); $i++)
                            {
                                ?>
                                <div class="div-image-<?php echo $images[$i]['Image']['id'];?> col-sm-3" style="margin-bottom: 10px;">
                                    <div class="div-image-remove"
                                         style="
                                                 background: url('/uploads/products/thumb/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink']?>');
                                                 background-size: cover;
                                                 background-position: center center;
                                                 height: 120px;
                                                 text-align: right">
                                        <button class="btn-delete-image" data-image_id="<?php echo $images[$i]['Image']['id'];?>" type="button">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            $('#id-input-file-3').ace_file_input({
                                style: 'well',
                                btn_choose: 'Click để chọn hình ảnh. Mỗi hình ảnh dung lượng không quá 2Mb',
                                btn_change: null,
                                no_icon: 'ace-icon fa fa-image',
                                droppable: true,
                                thumbnail: 'large',//large | fit
                                maxSize: 2000000, //~100 KB
                                allowExt:  ['jpg', 'jpeg', 'png', 'PNG', 'JPG'],
                                allowMime: ['image/jpg', 'image/jpeg', 'image/png'],
                                preview_error : function(filename, error_code)
                                {
                                },

                            }).on('change', function(){
                                //console.log($(this).data('ace_input_files'));
                                //console.log($(this).data('ace_input_method'));
                            });
                        })
                    </script>
                    <!--                                    End hinh ảnh-->

                    <div class="text-right">
                        <hr>
                        <button class="btn btn-default btn-xs" type="reset"> <i class="fa fa-refresh"></i> Nhập lại</button>
                        <button class="btn btn-primary btn-xs" type="submit" id="btnSaveProduct">Lưu <i class="fa fa-save"></i> </button>
                    </div>
                    <!--                                    End div houseorland-->
                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<!--End modal-->

<!--Maps-->
<script>
    $(function () {
        var old_price = '<?php echo $product['Product']['price'];?>';
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
                    beforeSend: function()
                    {
                        $('#district').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#district').html(string);

                    }
                });
            }
        });
        $('#parent_id').change(function () {
            var parent_id = $(this).val();
            if(parent_id != '')
            {
                $.ajax({
                    'url': '/categories/get_category',
                    'type': 'post',
                    'dataType': 'html',
                    'data': {
                        'parent_id': parent_id
                    },
                    beforeSend: function()
                    {
                        $('#category_id').html('<option disabled selected>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#category_id').html(string)
                    }
                });
            }
        });
        $('#category_id').change(function () {
            var category_id = $(this).val();
            if(category_id != '')
            {
                $.ajax({
                    url: '/categories/get_feature',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        category_id: category_id
                    },
                    success: function (html) {
                        $('#div_input_feature').html(html)
                    }
                });
            }
        });
        $('#chk_deal').click(function(){
            if($('#chk_deal').is(':checked'))
            {
                $('#price').prop('readonly', true);
                $('#price').attr('value', '0');
            }
            else
            {
                $('#price').attr('value', price_old);
                $('#price').prop('readonly', false);
                $('#price').focus();

            }
        });
        $('#title').keyup(function(){
            var len = $(this).val().length;
            $('#numchar-title').html(len + '/150')
        });
        $('.btn-delete-image').on('click', function(){
            var image_id = $(this).data('image_id');
            if(image_id != '')
            {
                $.ajax({
                    url: '/admin/products/delete_image',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        'image_id': image_id
                    },
                    success: function(st)
                    {
                        if(st == 'success')
                        {
                            $('.div-image-' + image_id).remove();
                        }
                    }
                });
            }
        });
    })
</script>