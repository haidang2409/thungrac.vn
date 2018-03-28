<?php
$action = $this->params['action'];
$product_filter = isset($this->params['url']['product_filter'])? $this->params['url']['product_filter']: '';
?>
<div id="accordian-profile">
    <ul>
        <li>
            <h4><a href="/members/profile" <?php if($action == 'profile'){ echo 'class="link-active"';}?>><?php echo __('My profile');?></a>
            </h4>
            <ul>
                <li>
                    <a href="/members/profile_update" <?php if($action == 'profile_update'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Change profile');?>
                    </a>
                </li>
                <li>
                    <a href="/members/change_avatar" <?php if($action == 'change_avatar'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Change avatar');?>
                    </a>
                </li>
                <li>
                    <a href="/members/change_password" <?php if($action == 'change_password'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Change password');?>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <h4><a href="javascript: void(0)"><?php echo __('My account');?></a>
            </h4>
            <ul>
                <li>
                    <a href="/members/account_info" <?php if($action == 'account_info'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Account info');?>
                    </a>
                </li>
                <li>
                    <a href="/members/history_recharge" <?php if($action == 'history_recharge'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Recharge history');?>
                    </a>
                </li>
                <li>
                    <a href="/deposit/" <?php if($action == 'recharge'){ echo 'class="link-active"';}?>>
                        <i class="fa fa-caret-right"></i>
                        <?php echo __('Recharge');?>
                    </a>
                </li>
            </ul>
        </li>
        <li><h4><a href="/members/orders" <?php if($action == 'orders'){ echo 'class="link-active"';}?>>Hóa đơn</a> </h4></li>
        <li>
            <h4><a href="/members/mypost?product_filter=all">Quản lý tin đăng</a>
            </h4>
        </li>
        <li><h4><a href="/members/logout">Thoát</a> </h4></li>
    </ul>
</div>