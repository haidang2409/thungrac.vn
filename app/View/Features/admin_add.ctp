<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/features">Đặc điểm</a>
                </li>
                <li class="active">Thêm</li>
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
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Thêm đặc điểm
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    echo $this->Form->create('Feature', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Chuyên mục</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php
                            $category_id = isset($this->params['url']['category_id'])? $this->params['url']['category_id']: '';
                            ?>
                            <?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => false, 'options' => $categories, 'class' => 'form-control', 'empty' => ' -- Chọn chuyên mục -- ', 'default' => $category_id));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tên đặc điểm/Chuyên ngành/Hãng xs</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('feature', array('label' => false, 'class' => 'form-control'));?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-xs btn-warning" value="SaveAndAdd" name="btnSaveAndAdd">Lưu và thêm <i class="fa fa-save"></i> </button>
                            <button class="btn btn-xs btn-warning">Lưu <i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
