<?php
$title = 'Chuyển khoản ngân hàng';
include '../header.php';
?>
<style>
    .div-bank-container
    {
        font-size: 115%;
    }
    .div-bank-container .item-bank
    {
        border: 1px solid #d5d5d5;
        padding: 10px;
        margin-bottom: 15px;
    }
    .div-bank-container .item-bank h4
    {
        margin-bottom: 5px !important;
        font-size: 18px;
    }
    .div-bank-container .item-bank span
    {
        display: block;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h3 class="blue">Quý khách có thể chuyển khoản một trong số ngân hàng sau</h3>
            <hr class="hr-dotted" style="margin-bottom: 15px !important; margin-top: 15px !important;">
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <div class="div-bank-container">
                <div class="item-bank">
                    <h4>AGRIBANK</h4>
                    <span class="number_account">
                        <img src="/img/tick.png" width="15px">
                        Số tài khoản:
                    </span>
                    <span class="name_account">
                        <img src="/img/tick.png" width="15px">
                        Chủ tài khoản:
                    </span>
                    <span class="">
                        <img src="/img/tick.png" width="15px">
                        Mở tại
                    </span>
                </div>
                <div class="item-bank">
                    <h4>AGRIBANK</h4>
                    <span class="number_account">
                        <img src="/img/tick.png" width="15px">
                        Số tài khoản:
                    </span>
                    <span class="name_account">
                        <img src="/img/tick.png" width="15px">
                        Chủ tài khoản:
                    </span>
                    <span class="">
                        <img src="/img/tick.png" width="15px">
                        Mở tại
                    </span>
                </div>
                <div class="item-bank">
                    <h4>AGRIBANK</h4>
                    <span class="number_account">
                        <img src="/img/tick.png" width="15px">
                        Số tài khoản:
                    </span>
                    <span class="name_account">
                        <img src="/img/tick.png" width="15px">
                        Chủ tài khoản:
                    </span>
                    <span class="">
                        <img src="/img/tick.png" width="15px">
                        Mở tại
                    </span>
                </div>
            </div>
            <div class="orange">
                <span class="bigger-120">
                    <i class="fa fa-info"></i>
                    Lưu ý:<br>
                </span>
                - Nội dung chuyển khoản bao gồm: <span class="blue">&lt;&lt;Số điện thoại&gt;&gt;_&lt;&lt;Họ tên&gt;&gt;</span>
                <br>
                - Chúng tôi sẽ liên hệ lại ngay sau khi nhận được thông tin chuyển khoản của quý khách.
                <br>
                - Nếu có vấn đề gì xin vui lòng gọi về số điện thoại ... để được hướng dẫn.
            </div>
            <div class="text-center">
                <hr class="hr-dotted">
                <a class="btn btn-white" href="/deposit/" style="border-radius: 3px !important;">Trở lại</a>
            </div>
        </div>
    </div>
</div>

<?php
include '../footer.php';