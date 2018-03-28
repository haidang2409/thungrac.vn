<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
            <h3 class="blue">Lịch sử nạp tiền</h3>
            <hr class="hr-double">
            <?php echo $this->Session->flash();?>
            <div style="overflow-x: auto">
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
                            <th>Số tiền thực lãnh</th>
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
                                <td align="right">
                                    <?php echo number_format($item['Recharge']['price'] * 0.8, 0, '', '.');?>
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
                //
                if(isset($atms) && count($atms) > 0)
                {
                    $count = 0;
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Số tiền nạp</th>
                            <th>Số tiền thực lãnh</th>
                            <th>Mã hóa đơn</th>
                            <th>Mã giao dịch</th>
                            <th>Ngày giao dịch</th>
                            <th>Xem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum = count($atms);
                        foreach ($atms as $item)
                        {
                            $count = $count + 1;
                            ?>
                            <tr>
                                <td align="center">
                                    <?php echo $count;?>
                                </td>
                                <td align="right">
                                    <?php echo number_format($item['Atm']['total_amount'], 0, '', '.');?>
                                </td>
                                <td align="right">
                                    <?php echo number_format($item['Atm']['net_amount'], 0, '', '.');?>
                                </td>
                                <td align="center">
                                    <?php echo $item['Atm']['order_id']?>
                                </td>
                                <td align="center">
                                    <?php echo $item['Atm']['transaction_id'];?>
                                </td>
                                <td align="center">
                                    <?php echo $this->Lib->convertDateTime_Mysql_to_Date($item['Atm']['created']);?>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-xs">Xem</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-3 col-sm-pull-9">
            <?php
            include ('profile-menu.ctp');
            ?>
        </div>
    </div>
</div>