<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="blue">BÁO GIÁ DỊCH VỤ ĐĂNG</h3>
            <hr class="hr-dotted">
            <?php if(isset($packets)):?>
            <div class="row">
                <div class="col-xs-4 col-sm-3 pricing-span-header">
                    <div class="widget-box transparent">
                        <div class="widget-header">
                            <h5 class="widget-title bigger lighter">Gói dịch vụ</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <ul class="list-unstyled list-striped pricing-table-header">
                                    <li>Giá</li>
                                    <li>Giá khuyến mãi</li>
                                    <li>Tiêu đề</li>
                                    <li>Hình ảnh</li>
                                    <li>Vị trí</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-8 col-sm-9 pricing-span-body">
                <?php
                if(isset($packets[0]))
                {
                    ?>
                    <div class="pricing-span">
                        <div class="widget-box pricing-box-small widget-color-orange">
                            <div class="widget-header text-center">
                                <h5 class="widget-title bigger lighter">
                                    <?php echo $packets[0]['Packet']['packetname'];?>
                                </h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <ul class="list-unstyled list-striped pricing-table">
                                        <li>
                                            <?php
                                            echo number_format($packets[0]['Packet']['price'], 0, '', '.') . 'đ/' . $packets[0]['Packet']['date'] . 'ngày';
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if($packets[0]['Packet']['discount'] > 0)
                                            {
                                                echo number_format($packets[0]['Packet']['discount'], 0, '', '.') . 'đ/' . $packets[0]['Packet']['date'] . 'ngày';
                                            }
                                            ?>
                                        </li>
                                        <li>Màu cam</li>
                                        <li>Hiển thị hình ảnh</li>
                                        <li>Trên cùng</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if(isset($packets[1]))
                {
                    ?>
                    <div class="pricing-span">
                        <div class="widget-box pricing-box-small widget-color-blue">
                            <div class="widget-header  text-center">
                                <h5 class="widget-title bigger lighter"><?php echo $packets[1]['Packet']['packetname'];?></h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <ul class="list-unstyled list-striped pricing-table">
                                        <li>
                                            <?php
                                            echo number_format($packets[1]['Packet']['price'], 0, '', '.') . 'đ/' . $packets[1]['Packet']['date'] . 'ngày';
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if($packets[1]['Packet']['discount'] > 0)
                                            {
                                                echo number_format($packets[1]['Packet']['discount'], 0, '', '.') . 'đ/' . $packets[1]['Packet']['date'] . 'ngày';
                                            }
                                            else
                                            {
                                                echo '_';
                                            }
                                            ?>
                                        </li>
                                        <li>Màu xanh</li>
                                        <li>Hiển thị hình ảnh</li>
                                        <li>Sau Top List 1</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if(isset($packets[2]))
                {
                    ?>
                    <div class="pricing-span">
                        <div class="widget-box pricing-box-small widget-color-blue">
                            <div class="widget-header  text-center">
                                <h5 class="widget-title bigger lighter"><?php echo $packets[2]['Packet']['packetname'];?></h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <ul class="list-unstyled list-striped pricing-table">
                                        <li>
                                            <?php
                                            echo number_format($packets[2]['Packet']['price'], 0, '', '.') . 'đ/' . $packets[2]['Packet']['date'] . 'ngày';
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if($packets[2]['Packet']['discount'] > 0)
                                            {
                                                echo number_format($packets[2]['Packet']['discount'], 0, '', '.') . 'đ/' . $packets[2]['Packet']['date'] . 'ngày';
                                            }
                                            else
                                            {
                                                echo '_';
                                            }
                                            ?>
                                        </li>
                                        <li>Màu xanh</li>
                                        <li>Không hiển thị hình ảnh</li>
                                        <li>Sau Top List 2</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if(isset($packets[3]))
                {
                    ?>
                    <div class="pricing-span">
                        <div class="widget-box pricing-box-small widget-color-grey">
                            <div class="widget-header  text-center">
                                <h5 class="widget-title bigger lighter"><?php echo $packets[3]['Packet']['packetname'];?></h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                    <ul class="list-unstyled list-striped pricing-table">
                                        <li>
                                            <?php
                                            echo number_format($packets[3]['Packet']['price'], 0, '', '.') . 'đ/' . $packets[3]['Packet']['date'] . 'ngày';
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if($packets[3]['Packet']['discount'] > 0)
                                            {
                                                echo number_format($packets[3]['Packet']['discount'], 0, '', '.') . 'đ/' . $packets[3]['Packet']['date'] . 'ngày';
                                            }
                                            else
                                            {
                                                echo '_';
                                            }
                                            ?>
                                        </li>
                                        <li>Màu đen</li>
                                        <li>Không hiển thị hình ảnh</li>
                                        <li>Hiển thị sau cùng</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
            <?php else:?>
                <h2 style="margin-bottom: 20px !important;">Chưa có dịch vụ</h2>
            <?php endif?>
<!--            Khuyến mãi-->
        </div>
    </div>
</div>