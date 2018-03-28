<?php
require_once('constants.php');
require_once('baokim_payment_pro.php');
require_once('baokim_payment.php');

$baokim = new BaoKimPaymentPro();
$banks = $baokim->get_seller_info();
$title = 'ATM Online';
include '../header.php';

?>
<script src="js/jquery.number.js"></script>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="wrapper">
                <!-- payment -->
                <div class="payment_list">
                    <div id="select_payment">
                        <h3 class="blue">Thông tin thanh toán</h3>
                        <hr class="hr-dotted" style="margin-top: 10px !important; margin-bottom: 10px !important;">
                        <?php
                        if(isset($_SESSION['atm_success']))
                        {
                            ?>
                            <div class="alert alert-success">
                                <?php
                                echo $_SESSION['atm_success'];
                                unset($_SESSION['atm_success']);
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <form method="post" action="" class="form-horizontal" id="form-action">
                            <div class="row-fluid customer_info ">
                                <div class="info">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Họ tên <font class="label-require">(*)</font> </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="payer_name" value="<?php echo $_SESSION['Member']['fullname'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Số điện thoại <font class="label-require">(*)</font> </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="payer_phone_no" value="<?php echo $_SESSION['Member']['phonenumber'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Địa chỉ email <font class="label-require">(*)</font> </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="payer_email" value="<?php echo $_SESSION['Member']['email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Địa chỉ <font class="label-require">(*)</font> </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="address" value="<?php echo $_SESSION['Member']['address'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Số tiền nạp <font class="label-require">(*)</font> </label>
                                        <div class="col-sm-8">
                                            <input id="total_amount" type="text" name="total_amount" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="method row-fluid" id="2">
                                <div class="icon"><img src="images/creditcard.png" border="0"/></div>
                                <div class="info">
                                    <span class="title">Thanh toán trực tuyến bằng thẻ quốc tế <!--<img src="images/safe.png" border="0" style="vertical-align: bottom; margin-left: 5px;" />--></span>

                                    <div class="bank_list">
                                        <ul id="b_l">
                                            <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_CREDIT_CARD); ?>
                                        </ul>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="check_box"></div>
                            </div>
                            <div class="row-fluid method" id="3">
                                <div class="icon"><img src="images/transfer.png" border="0"/></div>
                                <div class="info">
                                    <span class="title">Chuyển khoản InternetBanking</span>
                                    <span class="desc">Chọn ngân hàng thanh toán</span>

                                    <div class="bank_list">
                                        <ul id="b_l">
                                            <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_INTERNET_BANKING); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="check_box"></div>
                            </div>
                            <div class="row-fluid method" id="1">
                                <div class="icon"><img src="images/atm.png" border="0"/></div>
                                <div class="info">
                                    <span class="title">Thanh toán trực tuyến bằng thẻ ATM nội địa</span>
                                    <span class="desc">Chọn ngân hàng thanh toán</span>

                                    <div class="bank_list">
                                        <ul id="b_l">
                                            <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_LOCAL_CARD); ?>
                                        </ul>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="check_box"></div>
                            </div>

                            <input type="hidden" name="active_submit" value="submit"/>
                            <input type="hidden" name="bank_payment_method_id" id="bank_payment_method_id" value=""/>
                            <input type="hidden" name="shipping_address" size="30" value="Hà Nội"/>
                            <input type="hidden" name="payer_message" size="30" value="Ok"/>
                            <input type="hidden" name="extra_fields_value" size="30" value=""/>
                            <input type="hidden" name="extra_payment" id="extra_payment" value=""/>
                            <div class="orange">
                                <span class="bigger-120"><i class="fa fa-info"></i> Lưu ý:</span>
                                Khi quý khách nạp tiền bằng hình thức thanh toán trực tuyến bằng thẻ ATM, ATM của quý khách cần phải đăng ký dịch vụ thanh toán online với ngân hàng. Phí giao dịch tùy thuộc vào ngân hàng cung cấp dịch vụ.
                            </div>
                            <div class="text-center">
                                <a href="/huong-dan-nap-tien/"> Hướng dẫn nạp tiền? </a>
                                <br>
                                <br>
                                <a class="btn btn-white radius-4" style="border-radius: 3px !important;" href="/deposit/">Trở lại</a>
                                <input type="submit" class="btn btn-index pm_submit" style="border-radius: 3px !important;" name="submit" value="Tiếp tục"/>

                            </div>
                        </form>
                    </div>

                </div>
                <!--/ end payment -->
            </div>
        </div>
    </div>
</div>
<script>
	$("#total_amount").number( true, 0 , ',','.' );
	$(function () {
		$('.method').click(function () {
			$(this).siblings().children().find('img').removeClass('img-active');
			$('.method').removeClass('selected');
			$('.check_box').removeClass('checked_box');
			$(this).addClass('selected');
			$('.selected .check_box').addClass('checked_box');
			var method = $(this).attr('id');
			if (method != 0) {
				//$('.mode').css('display','block');
				$('.info1').slideDown();
				$('.selected img').click(function () {
					$('.method img').removeClass('img-active');
					$(this).addClass('img-active');
					var id = $(this).attr('id');
					$('#bank_payment_method_id').val(id);

				});
			}
			else {
				//$('.mode').css('display','none');
				$('.info1').slideUp('slow');
				$('.method img').removeClass('img-active');
			}
			$('#form-action').attr('action', 'request.php');
		});

		$('.input-mode').click(function () {
			var a = $(this).val();
			if (a == 2) {
				$('#daykeep').css('display', 'block');
			}
			if (a == 1) {
				$('#daykeep').css('display', 'none');
			}

		});
	});
</script>
<?php
include "../footer.php";
?>
</body>
</html>
