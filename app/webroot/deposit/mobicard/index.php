<?php
$title = 'Nạp tiền bằng thẻ cào';
include '../header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h3 class="blue">Nạp thẻ cào</h3>
            <hr class="hr-dotted" style="margin-top: 15px !important; margin-bottom: 15px !important;">
            <?php
            if(isset($_SESSION['success_mobicard']))
            {
                ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success_mobicard'];
                    unset($_SESSION['success_mobicard']);
                    ?>
                </div>
                <?php
            }
            if(isset($_SESSION['error_mobicard']))
            {
                ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error_mobicard'];
                    unset($_SESSION['error_mobicard']);
                    ?>
                </div>
                <?php
            }
            ?>
            <form class="form-horizontal form-bk" role="form" method="post" action="/members/mobicard">
                <div class="form-group">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <label>
                                    <input name="chonmang" class="ace" value="VIETEL" type="radio">
                                    <span class="lbl">
                                        <img src="/img/mobicard/viettel.png" width="150px">
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <label>
                                    <input name="chonmang" class="ace" value="MOBI" type="radio">
                                    <span class="lbl">
                                        <img src="/img/mobicard/mobifone.png" width="150px">
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <label>
                                    <input name="chonmang" class="ace" value="VINA" type="radio">
                                    <span class="lbl">
                                        <img src="/img/mobicard/vinaphone.png" width="150px">
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <label>
                                    <input name="chonmang" class="ace" value="GATE" type="radio">
                                    <span class="lbl">
                                        <img src="/img/mobicard/gate.png" width="150px">
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="txtpin" class="col-sm-3 control-label">Mã thẻ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtseri" class="col-sm-3 control-label">Số seri</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 orange">
                        <span class="bigger-120">
                            <i class="fa fa-info"></i>
                            Lưu ý:
                        </span>
                        Khi quý khách nạp tiền bằng thẻ điện thoại, chi phí phải chi trả cho nhà mạng là 20% giá trị nạp.
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6 text-center">
                        <a class="btn btn-white radius-4" style="border-radius: 3px !important;" href="/deposit/">Trở lại</a>
                        <button type="submit" class="btn btn-index" name="napthe">Nạp thẻ</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
include '../footer.php';