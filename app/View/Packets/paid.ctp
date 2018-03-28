<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
                    <ul class="steps" style="margin-left: 0">
                        <li data-step="1" class="complete">
                            <span class="step">1</span>
                            <span class="title">Nhập thông tin</span>
                        </li>
                        <li data-step="2" class="active">
                            <span class="step">2</span>
                            <span class="title">Chọn dịch vụ và thanh toán</span>
                        </li>
                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Hoàn thành</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="step-content pos-rel">
                    <div class="row">
                        <form id="formPaidProduct" method="post" action="<?php echo $_SERVER[ 'REQUEST_URI'];?>">
                            <div class="col-sm-9">
                                <?php
                                echo $this->Session->flash();
                                $item = $products;
                                ?>
                                <h2 style="margin-bottom: 15px !important;">Chọn dịch vụ và thanh toán</h2>
                                <?php if(isset($packets)):?>
                                    <?php for($i = 0; $i < count($packets); $i++):?>
                                        <div class="packet">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="radio">
                                                        <label>
                                                            <input name="packet_id" class="ace packet_id" type="radio" data-packet="<?php echo $packets[$i]['Packet']['id'];?>" value="<?php echo $packets[$i]['Packet']['id'];?>">
                                                            <span class="lbl"> <?php echo $packets[$i]['Packet']['packetname'];?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 text-right price">
                                                    <?php
                                                    $price = 0;
                                                    if($packets[$i]['Packet']['discount'] > 0)
                                                    {
                                                        $price =  $packets[$i]['Packet']['discount'];
                                                    }
                                                    else
                                                    {
                                                        $price = $packets[$i]['Packet']['price'];
                                                    }
                                                    echo number_format($price, 0, '', '.') . 'đ/' . $packets[$i]['Packet']['date'] . ' Ngày&nbsp&nbsp';
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="packet-summary">
                                                <?php echo nl2br($packets[$i]['Packet']['summary']);?>
                                            </div>
                                        </div>
                                    <?php endfor?>
                                <?php else:?>
                                    <h2 style="margin-bottom: 20px !important;">Chưa có dịch vụ</h2>
                                <?php endif?>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-search-header product-search-header-first">
                                    <h3>Thông tin tài khoản</h3>
                                </div>
                                <div class="packet-member">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            Tài khoản chính
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <?php
                                            echo number_format($member['Profile']['account'], 0, '', '.');
                                            ?>
                                        </div>
                                        <div class="col-sm-12 text-right" style="margin-top: 10px">
                                            <button class="btn btn-index" type="button" id="btnPaid"> Thanh toán <i class="fa fa-cc-visa"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 product-container-list">
<!--                            Style 1-->
                            <?php
                            for($i = 1; $i <=1; $i++)
                            {
                                ?>
                                <h4>Tin của bạn sẽ được hiện thị như sau</h4>
                                <div class="x_title"></div>
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
                                                <div class="product_bg_image" style="background-image: url('<?php echo $image?>'); -moz-background-size: 100% auto; background-position: center center; width: 100%; height: 125px"></div>
                                            </a>
                                        </div>
                                        <div class="col-sm-9 col-xs-7">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <h3>
                                                        <a title="<?php echo $item['Product']['title'];?>" class="title" href="/rao-vat/<?php echo $item['Product']['productlink'];?>-<?php echo $item['Product']['id'];?>">
                                                            <?php
                                                            echo $item['Product']['title'];
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
                                                    echo $item['Product']['summary'];
                                                    ?>
                                                </div>
                                                <div class="">
                                                    <i class="fa fa-map-marker"></i>
                                                    <?php echo $item['District']['districttype'] . ' ' . $item['District']['districtname'] . ' - ' . $item['Province']['provincename'];?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <?php
                                                        $fullname = $item['Member']['fullname'];
                                                        $phonenumber = $item['Product']['phonenumber'];
                                                        $email = $item['Member']['email'];
                                                        $image_member = $item['Member']['image'];
                                                        if($item['Product']['deposit'] == 1)
                                                        {
                                                            $fullname = 'Admin';
                                                            $phonenumber = '0901 032 320';
                                                            $email = 'cskh@dream.edu.vn';
                                                            $image_member = 'admin_003A.jpg';
                                                        }
                                                        ?>
                                                        <span class="member">
                                                    <img src="/img/members/<?php echo $image_member;?>" width="25px" height="25px" class="img-circle">
                                                            <?php echo $fullname;?>
                                                            <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                                        <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $phonenumber;?>">
                                                            <a style="color: orangered" href="tel:<?php echo $phonenumber;?>"><?php echo $this->Lib->hide_phonenumber($phonenumber);?></a>
                                                        </span>
                                                    </span>
                                                </span>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                <span class="date">
                                                <i class="fa fa-clock-o"> </i>
                                                    Hôm nay
<!--                                                    --><?php //echo $this->Lib->time_elapsed_string($item['Product']['date_paid']);?>
                                                    <br>
                                            </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 visible-xs">
                                            <div class="summary">
                                                <?php
                                                echo $item['Product']['summary'];
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
                                        <img src="/img/members/<?php echo $image_member;?>" width="25px" height="25px" class="img-circle">
                                                <?php echo $fullname;?>
                                                <span class="show-phonenumber"><i class="fa fa-phone"> </i>
                                            <span title="Click vào để xem số điện thoại" class="phone-number" data-phonenumber="<?php echo $phonenumber;?>">
                                                <a style="color: orangered" href="tel:<?php echo $phonenumber;?>"><?php echo $this->Lib->hide_phonenumber($phonenumber);?></a>
                                            </span>
                                        </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-product-bg-hover packet-choose" id="style<?php echo $i;?>">
                                    <div class="row list-style-<?php echo $i;?>">

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.widget-body -->
            <!--            Steps-->
    </div>
</div>
<?php echo $this->Html->script('select2.min');?>
<!--Maps-->
<script>
    $(function () {
        $('.packet_id').click(function () {
            var packet_id = $(this).data('packet');
            if(packet_id == 1)
            {
                $('#style1').removeClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 2)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').removeClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 3)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').removeClass('packet-choose');
                $('#style4').addClass('packet-choose');
            }
            if(packet_id == 4)
            {
                $('#style1').addClass('packet-choose');
                $('#style2').addClass('packet-choose');
                $('#style3').addClass('packet-choose');
                $('#style4').removeClass('packet-choose');
            }
        });
        $('#').change(function () {
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
                    success: function(string)
                    {
                        $('#district').html(string)
                        $('#district').select2();

                    }
                });
            }
        });
        $('#btnPaid').click(function () {
            $('#formPaidProduct').submit();
            $(this).attr('disabled', true);
            $(this).html('Đang lưu <i class="fa fa-spin fa-spinner"></i>');
        })
    })
</script>