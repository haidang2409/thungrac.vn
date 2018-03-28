<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <h2>Thông tin tài khoản</h2>
            <hr class="hr-double">
            <?php echo $this->Session->flash();?>
            <?php
            if(isset($members) && count($members) > 0)
            {
                ?>
                <table class="table table-bordered" align="center" style="width: 100%">
                    <tr>
                        <td style="padding-bottom: 15px">
                            <h3>Tài khoản chính</h3>
                        </td>
                        <td align="right" style="padding-bottom: 15px">
                            <h3><?php echo number_format($members['Profile']['account'], 0, '', '.');?></h3>
                        </td>
                    </tr>
                </table>
                <div class="text-right">
                    <a class="btn btn-index" style="border-radius: 3px !important;" href="/members/recharge">Nạp tiền</a>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
    </div>
</div>