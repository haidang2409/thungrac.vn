<div class="div-index-primary">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="div-search-index">
                    <form class="form_search_index">
                        <table style="width: 100%">
                        <tr>
                            <td colspan="3" align="center">
                                <h1>BẠN CẦN TÌM GÌ</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                <div class="form-group has-feedback">
                                    <select style="width: 100% !important;" id="sltCategory">
                                    <option value=""> -- Danh mục -- </option>
                                    <?php
                                    if(isset($categories_menu))
                                    {
                                        $sum_parent = count($categories_menu);
                                        for($i = 0; $i < $sum_parent; $i++)
                                        {
                                            ?>
                                            <optgroup label="<?php echo $categories_menu[$i]['Category']['categoryname'];?>">
                                                <?php
                                                $children = $categories_menu[$i]['children'];
                                                $sum_children = count($children);
                                                for($j = 0; $j < $sum_children; $j++)
                                                {
                                                    ?>
                                                    <option value="<?php echo $children[$j]['Category']['categorylink'];?>">
                                                        <?php echo $children[$j]['Category']['categoryname'];?>
                                                    </option>
                                                    <?php
                                                }
                                               ?>
                                           </optgroup>
                                           <?php
                                       }
                                    }
                                    ?>
                                    </select>
                                    <span class="glyphicon  glyphicon-list form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </td>
                            <td style="width: 50%; margin-left: -5px !important;">
                                <div class="form-group has-feedback">
                                    <?php echo $this->Form->input('sltProvince', array('type' => 'select', 'label' => false, 'id' => 'sltProvince', 'options' => $province_location, 'empty' => ' -- Vị trí -- ', 'style' => 'width: 100% !important'));?>
                                    <span class="glyphicon glyphicon-map-marker form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" style="padding: 15px">
                                <button type="button" id="btnSearchIndex" class="btn btn-index bolder"><i class="fa fa-search"> </i> TÌM KIẾM </button>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
<!--            Chuyen muc-->
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="margin-top: 15px; margin-bottom: 15px">
        <div class="col-sm-12">
            <h3>Chuyên mục rao vặt</h3>
            <div class="x_title"></div>
            <div class="row text-center" style="margin-top: 15px; margin-bottom: 15px">
                <?php

                if(isset($categories_menu) && count($categories_menu) > 0)
                {
                    $sum = 8;
                    if(count($categories_menu) < 8)
                    {
                        $sum = count($categories_menu);
                    }
                    for($i = 0; $i < $sum; $i++)
                    {
                        $item = $categories_menu[$i];
                        ?>
                        <div class="col-sm-2 col-xs-6 cat-index">
                            <a class="img-category" href="/rao-vat/toan-quoc/<?php echo $item['Category']['categorylink'];?>">
                                <img src="/img/categories/<?php echo $item['Category']['image'];?>">
                            </a>
                            <br>
                            <a class="name-category" href="/rao-vat/toan-quoc/<?php echo $item['Category']['categorylink'];?>">
                                <?php echo $item['Category']['categoryname'];?>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <h3>Tin mới đăng</h3>
            <div class="x_title"></div>
            <div class="product-container-list">
                <?php
                if(isset($products) && count($products) > 0)
                {
                    $sum_product = count($products);
                    foreach ($products as $item)
                    {
                        ?>
                        <div class="product-item">
                            <div class="row">
                                <div class="col-sm-3 col-xs-5" style="margin-top: 7px">
                                    <?php
                                    $image = '/uploads/products/no-image-product.png';
                                    if($item['Product']['image'] != '')// && file_exists('http://' . $_SERVER['HTTP_HOST'] . '/uploads/products/thumb/' . $item['Product']['image']))
                                    {
                                        $image = '/uploads/products/thumb/' . $item['Product']['image'];
                                    }
                                    ?>
                                    <a href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>" title="<?php echo $item['Product']['title'];?>">
                                        <div class="product_bg_image" style="background-image: url('<?php echo $image?>'); background-size: cover; background-position: center center; height: 115px"></div>
                                    </a>
                                </div>
                                <div class="col-sm-9 col-xs-7">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h3>
                                                <a title="<?php echo $item['Product']['title'];?>" class="title" href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>">
                                                    <?php
                                                    echo htmlentities($item['Product']['title'], ENT_QUOTES, 'UTF-8');
                                                    ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <span class="price">
                                                <?php
                                                if($item['Product']['price'] == 0)
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
                                    </div>
                                    <div class="hidden-xs">
                                        <div class="summary">
                                            <?php
                                            $summary = '';
                                            if($item['Product']['summary'] != '')
                                            {
                                                $summary = $this->Lib->hidden_text($item['Product']['summary'], 200);
                                            }
                                            else
                                            {
                                                $summary = $this->Lib->hidden_text($item['Product']['description'], 200);
                                            }
                                            echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                            ?>
                                        </div>
                                        <div class="">
                                            <i class="fa fa-map-marker"></i>
                                            <?php echo $item['District']['districttype'] . ' ' . $item['District']['districtname'] . ' - ' . $item['Province']['provincename'];?>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <span class="member">
                                                    <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                                            <?php echo $item['Product']['fullname'];?>
                                                            <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                        <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                                            <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <span class="date">
                                                    <i class="fa fa-clock-o"> </i>
                                                    <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                                    <br>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 visible-xs">
                                    <div class="summary">
                                        <?php
                                        echo htmlentities($summary, ENT_QUOTES, 'UTF-8');
                                        ?>
                                    </div>
                                    <div class="">
                                        <i class="fa fa-map-marker"></i>
                                        <?php echo $item['District']['districttype'] . ' ' . $item['District']['districtname'] . ' - ' . $item['Province']['provincename'];?>
                                    </div>
                                    <span class="date">
                                        <i class="fa fa-clock-o"> </i>
                                        <?php echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                        <br>
                                    </span>
                                    <span class="member">
                                        <img src="/img/members/<?php echo $item['Member']['image'];?>" width="25px" height="25px" class="img-circle">
                                        <?php echo $item['Product']['fullname'];?>
                                        <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $item['Product']['phonenumber'];?>">
                                                <a style="color: orangered" href="tel:<?php echo $item['Product']['phonenumber'];?>"><?php echo $this->Lib->hide_phonenumber($item['Product']['phonenumber']);?></a>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="alert alert-warning">Không có tin</div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="http://dream.edu.vn" target="_blank">
                <img src="http://nhadatphong.com/uploads/advertise/quang-cao-2.jpg" alt="Nghệ thuật hiện thực hóa ước mơ" width="100%">
            </a>
            <div>
                <!--            API product_new-->
            <link rel="stylesheet" type="text/css" href="http://nhadatphong.com/api/api_product_new.css"/>
            <script type="text/javascript" src="http://nhadatphong.com/api/api_product_new.js"></script>
            <div id="api-get-ndp-new">

            </div>
<!--            End API product_new-->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.div-search-index').show(100);
        $('#sltCategory').select2({
            minimumResultsForSearch: -1
        });
        $('#sltProvince').select2({
            minimumResultsForSearch: -1
        });
        $(".accordian-search h4").click(function(){
            $(".accordian-search ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        });
        $('.icon-plus-expand').on('click', function(){
            $('.icon-plus-expand').addClass('fa-plus');
            var data = $(this).data('expand');
            if(data == '1')
            {
                $(this).data('expand', '0');
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
            }
            else
            {
                $(this).data('expand', '1');
                $(this).removeClass('fa-minus');
                $(this).addClass('fa-plus');
            }

        });
        $('#btnSearchIndex').click(function () {
            var category = $('#sltCategory').val();
            if($.trim(category) == '')
            {
                category = 'mua-ban';
            }
            var province = $('#sltProvince').val();
            if($.trim(province) == '')
            {
                province = 'toan-quoc'
            }
            window.location = '/rao-vat/' + province + '/' + category
        })
    })
</script>