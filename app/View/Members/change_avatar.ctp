<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <h2>Thay đổi hình ảnh</h2>
            <hr class="hr-double">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                    <?php
                    echo $this->Session->flash();
                    ?>
                    <?php echo $this->Form->create('Member', array('class' => 'form-horizontal', 'novalidate' => true, 'type' => 'file'));?>
                    <div class="form-group has-feedback">
                        <label for="" class="col-sm-5 control-label">Chọn hình ảnh để thay đổi <font class="label-require">(*)</font> </label>
                        <div class="col-sm-7">
                            <?php echo $this->Form->input('avatar', array('id' => 'avatar', 'label' => false, 'title' => 'Chọn hình ảnh', 'type' => 'file'));?>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-index">
                            <i class="fa fa-save"></i>
                            Thay đổi
                        </button>
                    </div>
                    <?php
                    echo $this->Form->end();?>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <?php include ('profile-menu.ctp');?>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#avatar').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail: "large", //| true | large
            maxSize: 500000, //~100 KB
            allowExt:  ['jpg', 'jpeg', 'png'],
            allowMime: ['image/jpg', 'image/jpeg', 'image/png'] //html5 browsers only
            //
        });
    });
</script>