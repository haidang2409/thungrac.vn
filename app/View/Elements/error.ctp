<?php
if(isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')
{
    ?>
    <div class="main-content" id="content-category">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                        <a href="/admin">Trang chủ</a>
                    </li>
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
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="error-container">
                                    <div class="well">
                                        <h1 class="grey lighter smaller">
                                            <span class="blue bigger-125">
                                                <i class="ace-icon fa fa-sitemap"></i>
                                                404
                                            </span>
                                            Page Not Found
                                        </h1>

                                        <hr>
                                        <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>
                                        <div>
                                            <form class="form-search">
                                                <span class="input-icon align-middle">
                                                    <i class="ace-icon fa fa-search"></i>

                                                    <input class="search-query" placeholder="Give it a search..." type="text">
                                                </span>
                                                <button class="btn btn-sm" type="button" style="height: 33px !important;">Go!</button>
                                            </form>
                                            <div class="space"></div>
                                            <h4 class="smaller">Try one of the following:</h4>
                                            <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Re-check the url for typos
                                                </li>

                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Read the faq
                                                </li>

                                                <li>
                                                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                                                    Tell us about it
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="space"></div>

                                        <div class="center">
                                            <a href="javascript:history.back()" class="btn btn-grey">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Trở lại
                                            </a>

                                            <a href="/admin/home" class="btn btn-primary">
                                                <i class="ace-icon fa fa-home"></i>
                                                Trang chủ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="error-container">
                    <div class="well">
                        <h1 class="grey lighter smaller">
                        <span class="blue bigger-125">
                            <i class="ace-icon fa fa-sitemap"></i>
                            404
                        </span>
                            Page Not Found
                        </h1>

                        <hr>
                        <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>

                        <div>
                            <form class="form-search">
                            <span class="input-icon align-middle">
                                <i class="ace-icon fa fa-search"></i>

                                <input class="search-query" placeholder="Give it a search..." type="text">
                            </span>
                                <button class="btn btn-sm" type="button" style="height: 33px !important;">Go!</button>
                            </form>

                            <div class="space"></div>
                            <h4 class="smaller">Try one of the following:</h4>
                            <div class="col-sm-4 col-sm-offset-4 text-left">
                                <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        Re-check the url for typos
                                    </li>

                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        Read the faq
                                    </li>

                                    <li>
                                        <i class="ace-icon fa fa-hand-o-right blue"></i>
                                        Tell us about it
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <hr>
                        <div class="space"></div>

                        <div class="center">
                            <a href="javascript:history.back()" class="btn btn-white">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Trở lại
                            </a>

                            <a href="/" class="btn btn-index">
                                <i class="ace-icon fa fa-home"></i>
                                Trang chủ
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

