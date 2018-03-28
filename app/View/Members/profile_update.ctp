<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <h2>Cập nhật thông tin</h2>
            <hr class="hr-double">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-xs-12">

                    <?php
                    echo $this->Session->flash();
                    ?>
                    <?php echo $this->Form->create('Member', array('class' => 'form-horizontal form_has_addon', 'novalidate' => true));?>
                    <div class="form-group has-feedback">
                        <label for="username" class="col-sm-4 control-label">
                            <?php echo __('Username');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'title' => 'Tên đăng nhập', 'value' => $member['Member']['username'], 'style' => "background-color: transparent !important; border: none"));?>
                            <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="email" class="col-sm-4 control-label">
                            <?php echo __('Email address');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'title' => 'Địa chỉ email', 'value' => $member['Member']['email'], 'style' => "background-color: transparent !important; border: none"));?>
                            <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="fullname" class="col-sm-4 control-label">
                            <?php echo __('Full name');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('fullname', array('label' => false, 'class' => 'form-control', 'title' => 'Họ tên', 'value' => $member['Member']['fullname']));?>
                            <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="gender" class="col-sm-4 control-label">
                            <?php echo __('Gender');?>
                        </label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input value="1" type="radio" name="Member[gender]" <?php if($member['Member']['gender'] == '1'){ echo 'checked';}?>>
                                <?php echo __('Male');?>
                            </label>
                            <label class="radio-inline">
                                <input value="0" type="radio" name="Member[gender]" <?php if($member['Member']['gender'] == '0'){ echo 'checked';}?>>
                                <?php echo __('Female');?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phonenumber" class="col-sm-4 control-label">
                            <?php echo __('Birthday');?>
                        </label>
                        <div class="col-sm-8">
                            <?php $birth = $member['Member']['birthday'] != '0000-00-00'? $this->Lib->convertDateTime_Mysql_to_Date($member['Member']['birthday']): '';?>
                            <?php echo $this->Form->input('birth', array('id' => 'birthday', 'type' => 'text', 'label' => false, 'class' => 'form-control', 'title' => 'Ngày sinh', 'value' => $birth));?>
                            <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phonenumber" class="col-sm-4 control-label">
                            <?php echo __('Phone number');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('phonenumber', array('label' => false, 'class' => 'form-control', 'title' => 'Số điện thoại', 'value' => $member['Member']['phonenumber']));?>
                            <span class="glyphicon glyphicon-earphone form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phonenumber" class="col-sm-4 control-label">
                            <?php echo __('Province');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('province', array('id' => 'province', 'label' => false, 'class' => 'form-control', 'title' => 'Tỉnh/Thành phố', 'options' => $province, 'type' => 'select', 'empty' => ' -- Chọn tỉnh thành -- ', 'default' => $province_id, 'style' => 'width: 100%'));?>
                            <span class="glyphicon glyphicon-map-marker form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phonenumber" class="col-sm-4 control-label">
                            <?php echo __('District');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('district_id', array('id' => 'district', 'label' => false, 'class' => 'form-control', 'title' => 'Quận huyện', 'options' => $district, 'type' => 'select', 'empty' => ' -- Chọn quận huyện -- ', 'default' => $district_id, 'style' => 'width: 100%'));?>
                            <span class="glyphicon glyphicon-map-marker form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="address" class="col-sm-4 control-label">
                            <?php echo __('Address');?>
                        </label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('address', array('label' => false, 'class' => 'form-control', 'title' => 'Địa chỉ, số nhà, tên đường', 'value' => $member['Member']['address']));?>
                            <span class="glyphicon glyphicon-book form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-index">
                            <i class="fa fa-save"></i>
                            <?php echo __('Save');?>
                        </button>
                    </div>
                    <?php
                    echo $this->Form->end();?>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <div class="text-center">
            </div>
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
    </div>
</div>
<script>
    $(function () {
        $.datepicker.regional['cs'] = {
            monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            dayNames: ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
            dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        };
        $.datepicker.setDefaults($.datepicker.regional['cs']);
        $('#birthday').datepicker({
            dateFormat: 'dd/mm/yy',
            defaultDate: '1/1/1991'
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
                        $('#district').html('<option selected disabled>Đang tải</option>');
                    },
                    success: function(string)
                    {
                        $('#district').html(string)

                    }
                });
            }
        });
    })
</script>