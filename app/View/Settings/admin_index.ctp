<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li class="active">Thiết lập</li>
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
                    <div class="col-sm-6">
                        <h1>
                            Thiết lập
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
                    <a href="/admin/emailaccs" class="btn btn-app btn-primary no-radius">
                        <i class="ace-icon fa fa-envelope bigger-230"></i>
                        Email
                    </a>
<!--                    -->
                    <a id="backup-data" href="javascript: void(0)" class="btn btn-app btn-warning no-radius">
                        <i class="ace-icon fa fa-database bigger-230"></i>
                        Backup data
                    </a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script type="text/javascript">
    $(function () {
        $('#backup-data').click(function () {
            $(this).addClass('disabled');
            $(this).html('<i class="ace-icon fa fa-spin fa-spinner bigger-230"></i> Loading ... ');
            window.location = '/admin/settings/database_mysql_dump';
            $(this).removeClass('disabled');
            $(this).html('<i class="ace-icon fa fa-database bigger-230"></i> Backup data');
        })
    })
</script>