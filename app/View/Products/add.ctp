<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
                    <ul class="steps" style="margin-left: 0">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Nhập thông tin</span>
                        </li>
                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Chọn dịch vụ và thanh toán</span>
                        </li>
                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Hoàn thành</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
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
                                        echo $this->Form->input('title', array('id' => 'title', 'label' => false, 'class' => 'form-control'))
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
                                        echo $this->Form->input('parent_id', array('id' => 'parent_id', 'type' => 'select', 'options' => $categories_parent, 'label' => false, 'empty' => ' -- Chọn loại -- ', 'style' => 'width: 100% !important'))
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right"><font class="label-require">(*)</font></label>
                                    <div class="col-sm-6 col-xs-12">
                                        <?php
                                        echo $this->Form->input('category_id', array('id' => 'category_id', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn -- ', 'options' => $categories_child, 'style' => 'width: 100% !important'))
                                        ?>
                                    </div>
                                </div>
                                <div id="div_input_feature">

                                </div>
<!--                                Price-->
                                <div class="form-group">
                                    <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">
                                        Giá bán
                                        <font class="label-require">(*)</font>
                                    </label>
                                    <div class="col-sm-6 col-xs-12">
                                        <?php
                                        echo $this->Form->input('price', array('id' => 'price', 'label' => false, 'class' => 'form-control', 'type' => 'text'))
                                        ?>
                                    </div>
                                    <div class="col-sm-6 col-sm-offset-6 col-xs-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="checkbox">
                                                    <label style="padding-left: 10px !important;">
                                                        <?php
                                                        $pri_deal = false;
                                                        echo $this->Form->input('Product.pricedeal', array('id' => 'chk_deal', 'type' => 'checkbox', 'div' => false, 'class' => 'ace ace-checkbox-2', 'label' => false, 'value' => 1, 'checked' => $pri_deal))
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
                                        <hr class="visible-xs hr-dotted" style="margin-top: 7px; margin-bottom: 7px">
                                        <div class="checkbox" style="">
                                            <label style="padding-left: 10px !important;">
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
                                        echo $this->Form->input('province', array('id' => 'province', 'type' => 'select', 'options' => $provinces, 'label' => false, 'empty' => ' -- Chọn tỉnh thành -- ', 'style' => 'width: 100% !important'))
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-6 col-xs-12 control-label no-padding-right">Quận huyện <font class="label-require">(*)</font></label>
                                    <div class="col-sm-6 col-xs-12">
                                        <?php
                                        echo $this->Form->input('district_id', array('id' => 'district', 'type' => 'select', 'label' => false, 'empty' => ' -- Chọn quận huyện -- ', 'options' => $districts, 'style' => 'width: 100% !important'))
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
                                echo $this->Form->input('summary', array('id' => 'summary', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '2'))
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
                                echo $this->Form->input('description', array('id' => 'description', 'label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '8', 'escape' => true))
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
                            <button class="btn btn-white" type="reset"> <i class="fa fa-refresh"></i> Nhập lại</button>
                            <button class="btn btn-index" type="button" id="btnSaveProduct">Tiếp tục <i class="fa fa-arrow-right"></i> </button>
                        </div>
        <!--                                    End div houseorland-->
                        <?php
                        echo $this->Form->end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
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
                $('#price').prop('disabled', true);
                $('#price').val('0');
            }
            else
            {
                $('#price').prop('disabled', false);
                $('#price').prop('readonly', false);
                $('#price').focus();

            }
        });
        $('#title').keyup(function(){
            var len = $(this).val().length;
            $('#numchar-title').html(len + '/150')
        });
        $('#btnSaveProduct').click(function () {
            $('#ProductAddForm').submit();
            $(this).attr('disabled', true);
            $(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>');
        });
        $('#price').keyup(function () {
            var price = $(this).val();
            if(parseInt(price))
            {
                $('#price_convert').html(addCommas(price) + ' đồng');
            }
            else
            {
                $('#price_convert').html('');
            }
        })

    });
    //Function
    function addCommas(nStr)
    {
        nStr += '';
        x1 = nStr;
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1;
    }
</script>