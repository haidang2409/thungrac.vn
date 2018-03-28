<?php
include '../../header.php';
?>
<div class="container" style="min-height: 350px; color: #E4564F !important;">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h3>GIAO DỊCH ĐÃ BỊ HỦY</h3>
            <br>
            <br>
            <span>Hệ thống tự động chuyển trang sau </span><span id="second-count">5s</span>
        </div>
    </div>
</div>
<?php
include '../../footer.php';
?>
<script>
    setTimeout(function () {
        window.location = '/deposit/';
    }, 5000);
</script>
