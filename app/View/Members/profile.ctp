<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <h2>Thông tin thành viên</h2>

            <hr class="hr-double">
            <?php
            echo $this->Session->flash();
            ?>
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name">Hình ảnh</div>
                    <div class="profile-info-value">
                        <img src="/img/members/<?php echo $members['Member']['image'];?>" width="170px" height="170px" class="img-circle">
                        <br>
                        <a href="/members/change_avatar">Thay đổi</a>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Họ tên</div>

                    <div class="profile-info-value">
                        <?php echo htmlentities($members['Member']['fullname'], ENT_QUOTES, 'UTF-8');?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Giới tính</div>

                    <div class="profile-info-value">
                        <?php echo ($members['Member']['gender'] == '1')? 'Nam': ''?>
                        <?php echo ($members['Member']['gender'] == '0')? 'Nữ': ''?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Ngày sinh</div>

                    <div class="profile-info-value">
                        <?php echo $members['Member']['birthday'] != '0000-00-00'? $this->Lib->convertDateTime_Mysql_to_Date($members['Member']['birthday']): '';?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Địa chỉ email</div>

                    <div class="profile-info-value">
                        <?php echo $members['Member']['email'];?>
                        <?php
                        if($members['Profile']['activedemail'] == 1)
                        {
                            echo ' <font color="blue"> <i class="fa fa-check-circle-o"></i> </font> Đã xác thực';
                        }
                        else
                        {
                            echo ' <font color="#ff4500"> <i class="fa fa-info-circle"> </i> </font> Chưa xác thực';
                            echo '<br><a href="javascript: void(0)" id="btnSendEmailVerify">Gửi lại email xác thực</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Số điện thoại</div>
                    <div class="profile-info-value">
                        <?php echo $members['Member']['phonenumber'];?>
                        <?php
                        if($members['Profile']['activenumberphone'] == 1)
                        {
                            echo ' <font color="blue"> <i class="fa fa-check-circle-o"></i> </font> Đã xác thực';
                        }
                        else
                        {
                            echo ' <font color="#ff4500"> <i class="fa fa-info-circle"> </i> </font> Chưa xác thực';
                            echo '<br><a href="javascript: void(0)" id="btnSendSmsVerify">Gửi lại sms xác thực</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Hộ chiếu/CMDND</div>
                    <div class="profile-info-value">
                        <?php
                        if($members['Profile']['passport'] != '')
                        {
                            echo $members['Profile']['passport']; ?>
                            <?php
                            if ($members['Profile']['confirmpassport'] == 1) {
                                echo ' <font color="blue"> <i class="fa fa-check-circle-o"></i> </font> Đã xác thực';
                            } else {
                                echo ' <font color="#ff4500"> <i class="fa fa-info-circle"> </i> </font> Chưa xác thực';
                            }
                        }
                        else
                        {
                            echo '-';
                        }
                        ?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Địa chỉ</div>

                    <div class="profile-info-value">
                        <?php
                        echo ($members['Member']['address'] != ''? htmlentities($members['Member']['address'], ENT_QUOTES, 'UTF-8') . ', ' : '');
                        echo ($members['District']['districtname'] != ''? $members['District']['districtname'] . ', ' : '');
                        echo ($members['Province']['provincename'] != ''? $members['Province']['provincename']: '');
                        ?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Ngày tham gia</div>

                    <div class="profile-info-value">
                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($members['Member']['created']);?>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">Hoạt động lần cuối</div>

                    <div class="profile-info-value">
                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($members['Member']['lastlogin']);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <div class="text-center">
            </div>
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
    </div>
</div>