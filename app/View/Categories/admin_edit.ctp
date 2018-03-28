<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li>
                    <a href="/admin/categories">Chuyên mục</a>
                </li>
                <li class="active">Sửa</li>
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
                            Sửa chuyên mục
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
                    echo $this->Form->create('Category', array('class' => 'form-horizontal', 'novalidate' => true));
                    ?>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Nhóm chuyên mục</label>
                        <div class="col-sm-4 col-xs-12">
                            <?php echo $this->Form->input('groupproduct_id', array('type' => 'select', 'label' => false, 'options' => $parents, 'class' => 'form-control', 'empty' => ' -- Chọn nhóm -- ', 'default' => $categories['Category']['parent_id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Tên loại</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('categoryname', array('label' => false, 'class' => 'form-control', 'value' => $categories['Category']['categoryname']));?>
                            <?php echo $this->Form->input('id', array('label' => false, 'class' => 'form-control', 'value' => $categories['Category']['id']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Link</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('categorylink', array('label' => false, 'class' => 'form-control', 'value' => $categories['Category']['categorylink']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryname" class="col-sm-4 control-label">Sắp xếp</label>
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('sort', array('label' => false, 'class' => 'form-control', 'value' => $categories['Category']['sort']));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-xs btn-warning">Save <i class="fa fa-save"></i> </button>
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