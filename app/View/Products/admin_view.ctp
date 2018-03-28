<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/products">Tin bất động sản</a> </li>
                <li>Chi tiết tin đăng</li>
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
                    <h1>
                        Chi tiết tin đăng
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo $product['Parentcat']['categoryname']
                            ?>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <?php
                            echo $product['Category']['categoryname']
                            ?>
                        </small>
                    </h1>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <h3 class="blue" style="margin: 10px 0 !important;">
                                    <?php
                                    echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--            Dia chi-->
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="location">
                                <?php echo $product['District']['districttype'];?>
                                <?php echo $product['District']['districtname'];?>,
                                <?php echo $product['Province']['provincename'];?>
                            </span>
                        </div>
                    </div>
                    <!--            Price-->
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="price" style="font-size: 1.5em; color: #1ABB9C">
                                <?php if($product['Product']['price'] == 0):?>
                                    Giá thỏa thuận
                                <?php else:?>
                                    <i class="fa fa-dollar"></i>
                                    <?php echo number_format($product['Product']['price'], 0, '', '.');?>
                                <?php endif ?>
                            </span>
                            <div>
                                <?php
                                echo 'Ngày tạo: ' . $this->Lib->convertDateTime_Mysql_to_DateTime($product['Product']['created']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                        <h4>Thông tin thành viên</h4>
                        <i class="fa fa-user"></i>
                        <a href="/admin/members/view_detail/<?php echo $product['Member']['id'];?>">
                            <?php
                            echo $product['Member']['fullname'];
                            ?>
                        </a>
                        <br>
                        <i class="fa fa-phone"></i>
                        <?php
                        echo $product['Product']['phonenumber'];
                        ?> -
                        <?php
                        echo $product['Member']['phonenumber'];
                        ?>
                        <br>
                        <i class="fa fa-envelope"></i>
                        <?php
                        echo $product['Member']['email'];
                        ?>
                        <hr>
                    </div>
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <div style="font-weight: bold">
                        <?php
                        echo htmlentities($product['Product']['summary'], ENT_QUOTES, 'UTF-8');
                        ?>
                    </div>
                    <div class="product-description">
                        <?php
                        echo nl2br(htmlentities($product['Product']['description'], ENT_QUOTES, 'UTF-8'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin: 10px 0 !important;">Thông tin bất động sản</h3>
                </div>
                <!--                Thong tin co ban-->
                <div class="col-sm-6">
                    <table class="table table-bordered">

                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-bordered">

                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    for($i = 0; $i < count($images); $i++)
                    {
                        ?>
                        <img src="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink']?>" width="25%">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--            End Detail-->

        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $(function () {
        $('#li-product').addClass('active open');
    })
</script>