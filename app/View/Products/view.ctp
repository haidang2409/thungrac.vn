<?php if(count($product) > 0):?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
<!--            <img src="/uploads/advertise/quangcao2.jpg">-->
        </div>

    </div>
    <!--            Breadcrumbs-->
    <div class="row">
        <div class="col-sm-12">
            <ul class="breadcrumb" style="margin-left: 0 !important;">
                <li>
                    <a href="/rao-vat/toan-quoc/mua-ban">Rao vặt</a>
                </li>
                <li>
                    <a href="/rao-vat/toan-quoc/<?php echo $product['Parent']['categorylink']?>"><?php echo $product['Parent']['categoryname'];?></a>
                </li>
                <li>
                    <a href="/rao-vat/toan-quoc/<?php echo $product['Category']['categorylink'];?>"><?php echo $product['Category']['categoryname'];?></a>
                </li>
                <li class="active"><?php echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');?></li>
            </ul>
            <br><br>
        </div>
    </div>
    <!--            End Breadcrumbs-->
    <div class="row">
        <div class="col-sm-9">
<!--            Hình ảnh-->
            <?php
            $sum_image = count($images);
            if($sum_image > 0)
            {
                ?>
                <div class="row">
                    <?php
                    include('view_gallery2.ctp');
                    ?>
                </div>
                <?php
            }
            ?>
<!--            End Hình ảnh-->
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <h1 style="margin: 10px 0 !important;">
                            <?php
                            echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
<!--            Dia chi-->
            <div class="row">
                <div class="col-sm-8">
                    <span class="location">
                        <i class="fa fa-map-marker"> </i>
                        <?php echo $product['District']['districttype'];?>
                        <?php echo $product['District']['districtname'];?>,
                        <?php echo $product['Province']['provincename'];?>
                    </span>
                </div>
                <div class="col-sm-4 text-right">
                    <span><i class="fa fa-clock-o"></i> <?php echo $this->Lib->time_elapsed_string($product['Product']['date_paid']);?></span>
                </div>
            </div>
<!--            Price-->
            <div class="row">
                <div class="col-sm-12">
                    <span class="price color_primary" style="font-size: 1.5em; color: #ec971f">
                        <?php if($product['Product']['price'] == 0):?>
                            Giá thỏa thuận
                        <?php else:?>
                            <i class="fa fa-dollar"></i>
                            <?php echo number_format($product['Product']['price'], 0, '', '.');?>
                        <?php endif ?>
                    </span>
                </div>
            </div>
<!--            Detail-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="product-description">
                        <?php
                        echo nl2br(htmlentities($product['Product']['description'], ENT_QUOTES, 'UTF-8'));
                        ?>
                    </div>
                </div>
            </div>
<!--            End Detail-->

            <div class="row">
                <div class="col-md-12">
                    <hr class="hr-dotted">
                    <div class="product-search-header">
                        <h3>Tin rao liên quan</h3>
                    </div>
                </div>
                <div class="col-sm-12 product-container">
                    <div class="row">
                        <?php
                        $sum_relative = count($product_relative);
                        for($j = 0; $j < $sum_relative; $j++)
                        {
                            $item = $product_relative[$j];
                            ?>
                            <div class="col-sm-4 list-product-bg-hover">
                                <div class="row list-style-2">
                                    <div class="col-sm-4 col-xs-5 product-list-image">
                                        <a href="/rao-vat/<?php echo $item['Product']['productlink']; ?>-<?php echo $item['Product']['id']; ?>"
                                           title="<?php echo $item['Product']['title']; ?>">
                                            <?php
                                            $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/no-image-product.png';
                                            if ($item['Product']['image']) {
                                                $imglink = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/' . $item['Product']['image'];
                                            }
                                            ?>
                                            <div class=""
                                                 style="height: 100px;background-image: url('<?php echo $imglink; ?>'); background-repeat: no-repeat; background-position: center center; background-size: cover">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-8 col-xs-7 product-list-summary">
                                        <hr>
                                        <h4 style="font-size: 17px">
                                            <a href="/rao-vat/<?php echo $item['Product']['productlink']; ?>-<?php echo $item['Product']['id']; ?>"
                                               title="<?php echo $item['Product']['title']; ?>" style="text-decoration: none">
                                                <?php
                                                $title = $this->Lib->hidden_text($item['Product']['title'], 70);
                                                echo $title;
                                                ?>
                                            </a>
                                        </h4>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <span class="price color_primary">
                                                    <?php
                                                    if ($item['Product']['price'] == 0)
                                                    {
                                                        echo 'Thỏa thuận';
                                                    }
                                                    else
                                                    {
                                                        echo number_format($item['Product']['price'], 0, '', '.');
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-sm-12">
                                                <span class="location">
<!--                                                    <i class="fa fa-map-marker" style="padding-left: 2px !important;"> </i>-->
                                                    <?php echo $item['District']['districttype'];?>
                                                    <?php echo $item['District']['districtname'];?>,
                                                    <?php echo $item['Province']['provincename'];?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($j != 0 && ($j + 1 )%3 == 0)
                            {
                                echo '<div class="clearfix"></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--            Comments-->
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="input-comment">
                        <hr>
                        <h3 class="blue" style="margin-bottom: 10px !important;">Đăng bình luận</h3>
                        <textarea id="inputComment" rows="1" type="text" class="form-control" placeholder="Nhập nội dung... "></textarea>
                        <input type="hidden" value="<?php echo $this->Session->check('Member')? md5($this->Session->read('Member.id')): '';?>" name="token" id="token">
                        <div class="text-right"  style="padding: 5px 0">
                            <button class="btn btn-warning btn-mini" id="btnCommentProduct" data-product_id="<?php echo $product['Product']['id'];?>"><i class="fa fa-send"></i> Gửi</button>
                        </div>
                    </div>
                    <div class="timeline-container" id="timeline-container">

                    </div><!-- /.timeline-container -->
                    <div class="text-center" id="div-pre-more-comment">
                    </div>
                    <div class="text-center" id="div-more-comment">
                    </div>
                </div>
            </div>
            <!--            End comments-->

        </div>
        <div class="col-sm-3">
            <div class="product-contact">
                <div class="product-search-header product-search-header-first">
                    <h3>Thông tin liên hệ</h3>
                </div>
                <div class="contact">
                    <table style="width: 100%">
                        <tr>
                            <td style="vertical-align: middle; text-align: center">
                                <?php
                                $fullname = $product['Product']['fullname'];
                                $phonenumber = $product['Product']['phonenumber'];
                                $email = $product['Member']['email'];
                                $confirm_passport = $profiles['Profile']['confirmpassport'];
                                $images = $product['Member']['image'];
                                if($product['Product']['deposit'] == 1)
                                {
                                    $fullname = 'Admin';
                                    $phonenumber = '0901 032 320';
                                    $email = 'cskh@dream.edu.vn';
                                    $confirm_passport = 1;
                                    $images = 'admin_003A.jpg';
                                }
                                ?>
                                <img src="/img/members/<?php echo $images;?>" class="img-circle" width="80px" height="80px" style="max-width: 80px">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 1.3em; text-align: center; width: 100%">
                                <?php
                                echo $fullname;
                                ?>
                                <br>
                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                    <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $phonenumber;?>">
                                        <a style="color: orangered" href="tel:<?php echo $phonenumber;?>"><?php echo $this->Lib->hide_phonenumber($phonenumber);?></a>
                                    </span>
                                </span>
                                <br>
                                <span style="font-size: 15px">
                                    <!--<?php echo $email;?>-->
                                </span>
                                <span style="font-size: 0.7em !important; display: block">
                                    <?php
                                    echo $confirm_passport == 1? '<i class="fa fa-check-circle green"></i> Đã xác thực CMND': '';
                                    ?>
                                </span>
                                <hr class="hr-dotted">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=""><!-- style="background-color: #D5D5D5; padding: 5px 10px"> -->
                    <form class="form-horizontal form_has_addon" id="form-register-product" method="post" action="">
                        <h4 style="margin-bottom: 15px !important;" class="text-center blue">Hoặc đăng ký nhận thông tin</h4>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <input class="form-control" type="hidden" name="product_id" id="product_id" placeholder="id" value="<?php echo $product['Product']['id'];?>">
                                <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Họ tên">
                                <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <input class='form-control' type="text" id="email" name="email" placeholder="Địa chỉ email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <input class='form-control' type="text" id="phonenumber" name="phonenumber" placeholder="Số điện thoại">
                                <span class="glyphicon glyphicon-earphone form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <textarea style="resize: none" class='form-control' id="content" name="content" placeholder="Nội dung"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center-xs text-right">
                                <button class="btn btn-white" id="save-product" type="button" title="Lưu tin bất động sản này" data-product_id="<?php echo $product['Product']['id'];?>"><i class="fa fa-heart"> </i> Lưu tin</button>
                                <button class="btn btn-index" id="btnRegister_Info" type="button">Đăng ký <i class="fa fa-arrow-right"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<!--            Rating-->
            <div class="">
                <a href="http://dream.edu.vn" target="_blank">
                    <img src="http://nhadatphong.com/uploads/advertise/quang-cao-2.jpg" alt="Nghệ thuật hiện thực hóa ước mơ" width="100%">
                </a>
            </div>

        </div>
    </div>
</div>
<?php else:?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php echo $this->element('error'); ?>
        </div>
    </div>
</div>
<?php endif?>
<!--Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer" style="display: none">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a href="/members/login" type="button" class="btn btn-primary">Đăng nhập</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End modal-->
<?php echo $this->Html->script('register_info'); ?>
<script>
    $(function () {
        $('.phone-number').on('click', function(){
            var phone = $(this).data('phonenumber');
            $(this).html(phone)
        });
        $('#save-product').click(function(){
            var product_id = $(this).data('product_id');
            $.ajax({
                'url': '/products/add_favorite',
                'type': 'post',
                'dataType': 'html',
                'data': {
                    'product_id': product_id
                },
                'success': function(data)
                {
                    var info = JSON.parse(data);
                    if(info.status == 'not_login')
                    {
                        $('.modal-body').html('Vui lòng <a href="/members/login">đăng nhập</a> trước khi lưu');
                        $('.modal-footer').show();
                        $('#myModal').modal('show');
                    }
                    else if(info.status == 'success')
                    {
                        $('.modal-body').html(info.message);
                        $('#myModal').modal('show');
                    }
                    else
                    {
                        alert('Lỗi');
                    }
                }
            })
        })
    })
</script>
<?php echo $this->Html->script('comment_products.min');?>
<script>
    $(function () {
        var post_id = <?php echo $product['Product']['id'];?>;
        load_comment(1, post_id);
    });
</script>