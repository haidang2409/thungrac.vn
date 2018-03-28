<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="#">Trang chủ</a>
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
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            Trang chủ
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Tổng quan
                            </small>
                        </h1>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <!--Nội dung chính-->
                <div class="col-sm-12">



                </div>
<!--                Member recent-->
                <div class="col-sm-12">
                    <div class="widget-box transparent" id="recent-box">
                        <div class="widget-header">
                            <h4 class="widget-title lighter smaller">
                                <i class="ace-icon fa fa-rss orange"></i>HOẠT ĐỘNG
                            </h4>

                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="recent-tab">
                                    <li class="active">
                                        <a data-toggle="tab" href="#overview-tab" aria-expanded="true">Tổng quan</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#task-tab" aria-expanded="false">Tin đăng</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#member-tab" aria-expanded="false">Thành viên</a>
                                    </li>

                                    <li class="">
                                        <a data-toggle="tab" href="#comment-tab" aria-expanded="false">Bình luận</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-4">
                                <div class="tab-content padding-8">
                                    <div id="overview-tab" class="tab-pane active">
                                        <div class="infobox-container">
                                            <div class="infobox infobox-green">
                                                <div class="infobox-icon">
                                                    <i class="ace-icon fa fa-comments"></i>
                                                </div>

                                                <div class="infobox-data">
                                                    <span class="infobox-data-number">32</span>
                                                    <div class="infobox-content">comments + 2 reviews</div>
                                                </div>

                                                <div class="stat stat-success">8%</div>
                                            </div>

                                            <div class="infobox infobox-blue">
                                                <div class="infobox-icon">
                                                    <i class="ace-icon fa fa-file-text-o"></i>
                                                </div>

                                                <div class="infobox-data">
                                                    <span class="infobox-data-number">
                                                        <?php
                                                        if (isset($counter_product['all']))
                                                        {
                                                            echo $counter_product['all'];
                                                        }
                                                        ?>
                                                    </span>
                                                    <div class="infobox-content">tin đăng</div>
                                                </div>

                                                <div class="badge badge-success">
                                                    +32%
                                                    <i class="ace-icon fa fa-arrow-up"></i>
                                                </div>
                                            </div>
<!--                                            Order-->
                                            <div class="infobox infobox-pink">
                                                <div class="infobox-icon">
                                                    <i class="ace-icon fa fa-shopping-cart"></i>
                                                </div>

                                                <div class="infobox-data">
                                                    <span class="infobox-data-number">
                                                        <?php
                                                        if(isset($counter_order['all']))
                                                        {
                                                            echo 'Tổng: ' . $counter_order['all'];
                                                        }
                                                        ?>
                                                    </span>
                                                    <div class="infobox-content">
                                                        <?php
                                                        if(isset($counter_order['approval']))
                                                        {
                                                            echo '<a href="/admin/orders/?status=1">Đã duyệt: ' . $counter_order['approval'] . '</a>';
                                                        }
                                                        echo '<br>';
                                                        if(isset($counter_order['not_approval']))
                                                        {
                                                            echo '<a href="/admin/orders/?status=0">Chưa duyệt: ' . $counter_order['not_approval'] . '</a>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="stat stat-important">4%</div>
                                            </div>

                                            <div class="infobox infobox-red">
                                                <div class="infobox-icon">
                                                    <i class="ace-icon fa fa-users"></i>
                                                </div>

                                                <div class="infobox-data">
                                                    <span class="infobox-data-number">
                                                        <?php
                                                        if(isset($counter_member['all']))
                                                        {
                                                            echo number_format($counter_member['all'], 0, '', '.');
                                                        }
                                                        ?>
                                                    </span>
                                                    <div class="infobox-content">Thành viên</div>
                                                </div>
                                            </div>
<!--                                            View pages-->
                                            <div class="infobox infobox-orange2">
                                                <div class="infobox-data">
                                                    <span class="infobox-data-number">
                                                        <?php
                                                        $path_file = WWW_ROOT . DS . 'counter.txt';
                                                        $num = (int)file_get_contents($path_file) + 1;
                                                        echo number_format($num, 0, '', '.');
                                                        ?>
                                                    </span>
                                                    <div class="infobox-content">Lượt truy cập</div>
                                                </div>

                                                <div class="badge badge-success">
                                                    7.2%
                                                    <i class="ace-icon fa fa-arrow-up"></i>
                                                </div>
                                            </div>

                                            <div class="infobox infobox-blue2">
                                                <div class="infobox-progress">
                                                    <div class="easy-pie-chart percentage" data-percent="42" data-size="46" style="height: 46px; width: 46px; line-height: 45px;">
                                                        <span class="percent">42</span>%
                                                        <canvas height="46" width="46"></canvas></div>
                                                </div>

                                                <div class="infobox-data">
                                                    <span class="infobox-text">traffic used</span>

                                                    <div class="infobox-content">
                                                        <span class="bigger-110">~</span>
                                                        58GB remaining
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-6"></div>

                                            <div class="infobox infobox-green infobox-small infobox-dark">
                                                <div class="infobox-progress">
                                                    <div class="easy-pie-chart percentage" data-percent="61" data-size="39" style="height: 39px; width: 39px; line-height: 38px;">
                                                        <span class="percent">61</span>%
                                                        <canvas height="39" width="39"></canvas></div>
                                                </div>

                                                <div class="infobox-data">
                                                    <div class="infobox-content">Task</div>
                                                    <div class="infobox-content">Completion</div>
                                                </div>
                                            </div>

                                            <div class="infobox infobox-blue infobox-small infobox-dark">
                                                <div class="infobox-chart">
                                                    <span class="sparkline" data-values="3,4,2,3,4,4,2,2"><canvas style="display: inline-block; width: 39px; height: 20px; vertical-align: top;" width="39" height="20"></canvas></span>
                                                </div>

                                                <div class="infobox-data">
                                                    <div class="infobox-content">Earnings</div>
                                                    <div class="infobox-content">$32,000</div>
                                                </div>
                                            </div>

                                            <div class="infobox infobox-grey infobox-small infobox-dark">
                                                <div class="infobox-icon">
                                                    <i class="ace-icon fa fa-download"></i>
                                                </div>

                                                <div class="infobox-data">
                                                    <div class="infobox-content">Downloads</div>
                                                    <div class="infobox-content">1,205</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="task-tab" class="tab-pane">
                                        <div class="comments" style="max-height: 500px; overflow-y: scroll">
                                            <?php
                                            if(isset($product_news) && count($product_news) > 0)
                                            {
                                                foreach ($product_news as $item)
                                                {
                                                    ?>
                                                    <div class="itemdiv commentdiv">
                                                        <div class="user">
                                                            <?php
                                                            $image = '/img/members/default_user.jpg';
                                                            if($item['Member']['image'] != '')// && file_exists($item['Member']['image']))
                                                            {
                                                                $image = '/img/members/' . $item['Member']['image'];
                                                            }
                                                            ?>
                                                            <img height="50px" width="50px" alt="<?php echo htmlentities($item['Member']['fullname'], ENT_QUOTES, 'UTF-8')?>" src="<?php echo $image;?>">
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="/admin/members/view_detail/<?php echo $item['Member']['id'];?>">
                                                                    <?php echo htmlentities($item['Member']['fullname'], ENT_QUOTES, 'UTF-8')?>
                                                                </a>
                                                            </div>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">
                                                                    <?php
                                                                    echo $this->Lib->time_elapsed_string($item['Product']['created'])
                                                                    ?>
                                                                </span>
                                                            </div>

                                                            <div class="text">
                                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                                <a href="/admin/products/view/<?php echo $item['Product']['id'];?>">
                                                                    <?php echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8')?>
                                                                </a>
                                                                <br>
                                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                                <span class="price" style="display: inline">
                                                                    <?php if($item['Product']['price'] == 0):?>
                                                                        Giá thỏa thuận
                                                                    <?php else:?>
                                                                        <i class="fa fa-dollar"></i>
                                                                        <?php echo number_format($item['Product']['price'], 0, '', '.');?>
                                                                    <?php endif ?>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="tools">
                                                            <div class="action-buttons bigger-125">
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-eye blue"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-pencil orange2"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-trash-o red"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div id="member-tab" class="tab-pane">
                                        <div class="clearfix">
                                            <?php
                                            if(isset($members) && count($members) > 0)
                                            {
                                                foreach ($members as $item)
                                                {
                                                    ?>
                                                    <div class="itemdiv memberdiv">
                                                        <div class="user">
                                                            <?php
                                                            $image = '/img/members/default_user.jpg';
                                                            if($item['Member']['image'] != '')// && file_exists($item['Member']['image']))
                                                            {
                                                                $image = '/img/members/' . $item['Member']['image'];
                                                            }
                                                            ?>
                                                            <img height="50px" width="50px" alt="<?php echo htmlentities($item['Member']['fullname'], ENT_QUOTES, 'UTF-8')?>" src="<?php echo $image;?>">
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a title="<?php echo $item['Member']['fullname'];?>" href="/admin/members/view_detail/<?php echo $item['Member']['id'];?>">
                                                                    <?php echo $item['Member']['fullname'];?>
                                                                </a>
                                                            </div>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">
                                                                    <?php
                                                                    echo $this->Lib->time_elapsed_string($item['Member']['lastlogin']);
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="space-4"></div>

                                        <div class="center">
                                            <i class="ace-icon fa fa-users fa-2x green middle"></i>
                                            <a href="/admin/members" class="btn btn-sm btn-white btn-info">
                                                Xem tất cả
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="hr hr-double hr8"></div>
                                    </div><!-- /.#member-tab -->

                                    <div id="comment-tab" class="tab-pane">
                                        <div class="comments" style="max-height: 500px; overflow-y: scroll">
                                            <?php
                                            if(isset($comment_products) && count($comment_products) > 0)
                                            {
                                                foreach ($comment_products as $item)
                                                {
                                                    ?>
                                                    <div class="itemdiv commentdiv">
                                                        <div class="user">
                                                            <?php
                                                            $image = '/img/members/default_user.jpg';
                                                            if($item['Member']['image'] != '')// && file_exists($item['Member']['image']))
                                                            {
                                                                $image = '/img/members/' . $item['Member']['image'];
                                                            }
                                                            ?>
                                                            <img height="50px" width="50px" alt="<?php echo htmlentities($item['Member']['fullname'], ENT_QUOTES, 'UTF-8')?>" src="<?php echo $image;?>">
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="/admin/members/view_detail/<?php echo $item['Member']['id'];?>">
                                                                    <?php echo htmlentities($item['Member']['fullname'], ENT_QUOTES, 'UTF-8')?>
                                                                </a>
                                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                                <a href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>">
                                                                    <?php echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8')?>
                                                                </a>
                                                            </div>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span class="green">
                                                                    <?php
                                                                    echo $this->Lib->time_elapsed_string($item['Commentproduct']['created'])
                                                                    ?>
                                                                </span>
                                                            </div>

                                                            <div class="text">
                                                                <i class="ace-icon fa fa-quote-left"></i>
                                                                <?php
                                                                echo nl2br(htmlentities($item['Commentproduct']['comment'], ENT_QUOTES, 'UTF-8'));
                                                                ?>

                                                            </div>
                                                        </div>

                                                        <div class="tools">
                                                            <div class="action-buttons bigger-125">
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-eye blue"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-pencil orange2"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="ace-icon fa fa-trash-o red"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="hr hr8"></div>

                                        <div class="center">
                                            <i class="ace-icon fa fa-comments-o fa-2x green middle"></i>
                                            &nbsp;
                                            <a href="/admin/commentposts" class="btn btn-sm btn-white btn-info">
                                                Xem tất cả
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="hr hr-double hr8"></div>
                                    </div>
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div>
<!--                End member recent-->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<!--End modal-->
<script>

</script>