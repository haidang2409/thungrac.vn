<div class="row">
    <div class="col-sm-3">
        <h3>Về chúng tôi</h3>
        <a href="/a/gioi-thieu">Giới thiệu về chúng tôi</a><br>
        <a href="/tuyen-dung">Tuyển dụng</a><br>
        <a href="/a/lien-he">Liên hệ</a><br>
        <div class="div-link-social">
            <a href="https://www.facebook.com" class="btn-social facebook"><i class="fa fa-facebook"></i> </a>
            <a href="https://www.plus.google.com" class="btn-social google-plus"><i class="fa fa-google-plus"></i> </a>
            <a href="https://www.youtube.com" class="btn-social youtube"><i class="fa fa-youtube"></i> </a>
            <a href="https://www.twitter.com" class="btn-social twitter"><i class="fa fa-twitter"></i> </a>
            <a href="https://www.linkedin.com" class="btn-social linkedin"><i class="fa fa-linkedin"></i> </a>
        </div>
        <?php
        $path_file = WWW_ROOT . DS . 'counter.txt';
        $num = (int)file_get_contents($path_file) + 1;
        file_put_contents(WWW_ROOT . DS . 'counter.txt', $num);
        echo number_format($num, 0, '', '.') . ' lượt truy cập';
        ?>
    </div>
    <div class="col-sm-3">
        <h3>Hướng dẫn</h3>
        <a href="/help/huong-dan-dang-tin">Hướng dẫn đăng tin</a><br>
        <a href="/help/huong-dan-thanh-toan">Hướng dẫn thanh toán</a><br>
        <a href="/help/huong-dan-nap-tien">Hướng dẫn nạp tiền</a><br>
        <a href="/help/dieu-khoan-su-dung">Điều khoản sử dụng</a><br>
        <a href="/help/dieu-khoan-bao-mat">Điều khoản bảo mật</a>
    </div>
    <div class="col-sm-3">
        <h3>Báo giá dịch vụ</h3>
        <a href="/a/gia-dich-vu-dang-tin">Giá dịch vụ đăng tin</a><br>
        <a href="/a/gia-dich-vu-quang-cao">Giá dịch vụ quảng cáo</a><br>

    </div>
    <div class="col-sm-3">
        <h3>Bất động sản</h3>

    </div>
</div>