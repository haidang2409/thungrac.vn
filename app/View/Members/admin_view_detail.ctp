<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/members">Thành viên</a> </li>
                <li  class="active">Thông tin thành viên</li>
            </ul><!-- /.breadcrumb -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Thông tin thành viên
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        overview &amp; stats
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Session->flash();
                    ?>
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    Tên đăng nhập
                                </td>
                                <td>
                                    <?php echo $members['Member']['username'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Họ tên
                                </td>
                                <td>
                                    <?php echo $members['Member']['fullname'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Giới tính
                                </td>
                                <td>
                                    <?php
                                    if($members['Member']['gender'] == '1')
                                    {
                                        echo 'Nam';
                                    }
                                    else if($members['Member']['gender'] == '0')
                                    {
                                        echo 'Nữ';
                                    }
                                    else
                                    {
                                        echo '_';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Ngày sinh</td>
                                <td>
                                    <?php echo $members['Member']['birthday'] != '0000-00-00'? $this->Lib->convertDateTime_Mysql_to_Date($members['Member']['birthday']): '_';?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>
                                    <?php echo $members['Member']['address'];?>
                                    <?php echo $members['District']['districtname'];?>
                                    <?php echo $members['Province']['provincename'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Hộ chiếu/CMND
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>Ngày đăng ký</td>
                                <td>
                                    <?php echo $this->Lib->convertDateTime_Mysql_to_DateTime($members['Member']['created']);?>
                                </td>
                            </tr>
                            <tr>
                                <td>Ngày cập nhật</td>
                                <td>
                                    <?php echo $this->Lib->convertDateTime_Mysql_to_DateTime($members['Member']['updated']);?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hoạt động lần cuối</td>
                                <td>
                                    <?php echo $this->Lib->convertDateTime_Mysql_to_DateTime($members['Member']['lastlogin']);?>
                                </td>
                            </tr>
                            <tr>
                                <td>Đang kích hoạt</td>
                                <td>
                                    <?php
                                    if($members['Member']['status'] == 1)
                                    {
                                        echo 'Đang kích hoạt';
                                    }
                                    else
                                    {
                                        echo 'Đã khóa';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tài khoản chính
                                </td>
                                <td>
                                    <?php echo number_format($members['Profile']['account'], 0, '', '.');?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số tin đã đăng
                                </td>
                                <td>
                                    <?php echo number_format($sum_product, 0, '', '.');?>
                                    <a href="/admin/members/post_product/<?php echo $members['Member']['id'];?>">
                                        Xem các tin của thành viên này
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <h3>
                        Lịch sử nạp tiền
                    </h3>
                    <?php
                    if(isset($recharges) && count($recharges) > 0)
                    {
                        $count = 0;
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Mệnh giá</th>
                                <th>Loại</th>
                                <th>Mã thẻ</th>
                                <th>Seri</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sum = count($recharges);
                            foreach ($recharges as $item)
                            {
                                $count = $count + 1;
                                ?>
                                <tr>
                                    <td align="center">
                                        <?php echo $count;?>
                                    </td>
                                    <td align="right">
                                        <?php echo number_format($item['Recharge']['price'], 0, '', '.');?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['type']?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['cardcode'];?>
                                    </td>
                                    <td align="center">
                                        <?php echo $item['Recharge']['seri'];?>
                                    </td>
                                    <td align="center">
                                        <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Recharge']['created']);?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="alert alert-warning">
                            Không có giao dịch
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
