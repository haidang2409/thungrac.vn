<?php
$title = 'Nạp tiền vào tài khoản';
include 'header.php';
?>
<style>
    .deposit-index a
    {
        line-height: 40px;
        text-decoration: none !important;
    }
    .deposit-index a:hover
    {
        color: #1ABB9C;
    }
    .deposit-index img
    {
        border: 1px solid #d5d5d5;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 deposit-index">
            <h3 class="blue">Chọn hình thức nạp tiền</h3>
            <hr class="hr-dotted" style="margin-top: 15px !important; margin-bottom: 15px !important;">
            <?php
            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'cancel')
            {
                ?>
                <div class="alert alert-danger">
                    Giao dịch đã bị hủy
                </div>
                <?php
            }
            ?>
            <div class="col-sm-4 text-center">
                <a href="/deposit/mobicard/">
                    <img src="/img/mobicard.jpg" width="100%" height="180px" style="max-width: 300px">
                    <br>
                    THẺ CÀO ĐIỆN THOẠI
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <a href="/deposit/atm/">
                    <img src="/img/atm_card.png" width="100%" height="180px" style="max-width: 300px">
                    <br>
                    ATM ONLINE
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <a href="/deposit/bank_account/">
                    <img src="/img/hand_money.png" width="100%" height="180px" style="max-width: 300px">
                    <br>
                    CHUYỂN KHOẢN NGÂN HÀNG
                </a>
            </div>
        </div>
        <div class="col-sm-8 col-sm-offset-2 orange">
            <span class="bigger-120">
                <br>
                <i class="fa fa-info"></i>
                Lưu ý: Trong quá trình nạp tiền vào tài khoản trên <?php echo $_SERVER['HTTP_HOST'];?>, nếu có vấn đề gì quý khách vui lòng liên hệ với bộ phận kỹ thuật qua số điện thoại: 0901 032 320
            </span>
        </div>
    </div>
</div>
<?php
include 'footer.php';