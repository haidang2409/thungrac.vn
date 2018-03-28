<div class="footer text-center-xs">
    <div class="container" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="/a/gioi-thieu">Về chúng tôi</a> |
                <a href="/a/lien-he">Liên hệ</a> |
                <a href="/a/gia-dich-vu-dang-tin">Báo giá dịch vụ</a> |
                <a href="/help/dieu-khoan-su-dung">Điều khoản sử dụng</a> |
                <a href="/help/dieu-khoan-bao-mat">Bảo mật </a>
                <hr class="hr-dotted" style="margin-top: 7px !important; margin-bottom: 7px !important;">
            </div>
            <div class="col-sm-9" style="font-size: 14px">
                Bản quyền <span class="fa fa-copyright"></span> 2017, vui lòng ghi rõ nguồn <u>nhadatphong.com</u> khi phát hành lại thông tin từ website này!
                <br>
                CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO HIỆN THỰC ƯỚC MƠ
                <br>
                <i class="fa fa-phone"></i> 0901 032 320 - <i class="fa fa-envelope"></i> cskh@dream.edu.vn
                <br>
                <i class="fa fa-home"></i>
                Địa chỉ VP: Số 86 Mạc Thiên Tích, Phường Xuân Khánh, Quận Ninh Kiều, TP Cần Thơ
                <br>
                <span>
                    Hoạt động theo giấy phép đăng ký kinh doanh số - Cấp ngày // Sở kế hoạch và đầu tư TP Cần Thơ
                </span>
            </div>
            <div class="col-sm-3 text-center-xs text-right">
                <?php
                echo $this->Html->image('bocongthuong.png', array('width' => '200px', 'alt' => 'Đã đăng ký với bộ công thương'))
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('social-share.ctp');
$path_file = WWW_ROOT . DS . 'counter.txt';
$num = (int)file_get_contents($path_file) + 1;
file_put_contents(WWW_ROOT . DS . 'counter.txt', $num);
?>
<?php
//echo $this->element('sql_dump');
?>
