<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <a class="btn btn-success" href="/admin/statistics/" title="Thống kê">
            <i class="ace-icon fa fa-signal"></i>
        </a>

        <a class="btn btn-info" href="/admin/helps/" title="Edit page">
            <i class="ace-icon fa fa-info-circle"></i>
        </a>

        <button class="btn btn-warning">
            <i class="ace-icon fa fa-users"></i>
        </button>

        <a class="btn btn-danger" href="/admin/settings/" title="Thiết lập">
            <i class="ace-icon fa fa-cogs"></i>
        </a>
    </div>

    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>

        <span class="btn btn-info"></span>

        <span class="btn btn-warning"></span>

        <span class="btn btn-danger"></span>
    </div>
</div><!-- /.sidebar-shortcuts -->

<ul class="nav nav-list">
    <li class=""  id="li-index">
        <a href="/admin/home">
            <i class="menu-icon fa fa-home"></i>
            <span class="menu-text"> TRANG CHỦ </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li class="" id="li-staff">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text">
                NHÂN VIÊN
            </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <ul class="submenu">
            <li class=""  id="li-list-staff">
                <a href="/admin/staffs" class="">
                    <i class="menu-icon fa fa-caret-right"></i>
                    DANH SÁCH NHÂN VIÊN
                </a>
            </li>
        </ul>
    </li>
    <!--Thành viên-->
    <li class="" id="li-member">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text"> THÀNH VIÊN </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="" id="li-list-member">
                <a href="/admin/members/">
                    <i class="menu-icon fa fa-caret-right"></i>
                    DANH SÁCH THÀNH VIÊN
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-account-member">
                <a href="/admin/members/accounts">
                    <i class="menu-icon fa fa-caret-right"></i>
                    TÀI KHOẢN
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-recharge-member">
                <a href="/admin/members/recharge">
                    <i class="menu-icon fa fa-caret-right"></i>
                    NẠP TIỀN
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-history-recharge-member">
                <a href="/admin/members/history_recharges">
                    <i class="menu-icon fa fa-caret-right"></i>
                    LỊCH SỬ NẠP TIỀN
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>
    <!--Tin đăng-->
<!--    Dự án-->
    <li class="" id="li-product">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> TIN ĐĂNG </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="" id="li-awaiting-approval">
                <a href="/admin/products/awaiting_approval">
                    <i class="menu-icon fa fa-caret-right"></i>
                    CHỜ DUYỆT
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-list-product-visible">
                <a href="/admin/products?filter=visible" id="li-list-product">
                    <i class="menu-icon fa fa-caret-right"></i>
                    ĐANG HIỂN THỊ
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-list-product-expired">
                <a href="/admin/products?filter=expired" id="li-list-product">
                    <i class="menu-icon fa fa-caret-right"></i>
                    TIN HẾT HẠN
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-list-product-draft">
                <a href="/admin/products?filter=draft" id="li-list-product">
                    <i class="menu-icon fa fa-caret-right"></i>
                    TIN NHÁP
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-list-product-deleted">
                <a href="/admin/products?filter=deleted" id="li-list-product">
                    <i class="menu-icon fa fa-caret-right"></i>
                    TIN ĐÃ XÓA
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-register-product">
                <a href="/admin/products/register_products">
                    <i class="menu-icon fa fa-caret-right"></i>
                    ĐĂNG KÝ
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-category">
                <a href="/admin/categories/">
                    <i class="menu-icon fa fa-caret-right"></i>
                    DANH MỤC
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>
    <!--Danh sách đăng ký-->
    <li class="" id="li-order">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-file-text-o"></i>
            <span class="menu-text"> HÓA ĐƠN</span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="" id="li-list-order">
                <a href="/admin/orders/">
                    <i class="menu-icon fa fa-caret-right"></i>
                    DANH SÁCH HÓA ĐƠN
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-packet">
                <a href="/admin/packets">
                    <i class="menu-icon fa fa-caret-right"></i>
                    DỊCH VỤ TIN ĐĂNG
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>

    <li class="" id="li-province">
        <a href="/admin/provinces/">
            <i class="menu-icon fa fa-list-alt"></i>
            <span class="menu-text"> TỈNH THÀNH </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li class="" id="li-district">
        <a href="/admin/districts/">
            <i class="menu-icon fa fa-list-alt"></i>
            <span class="menu-text"> QUẬN/HUYỆN </span>
        </a>
        <b class="arrow"></b>
    </li>
    <li class="" id="li-statistic">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-briefcase"></i>
            <span class="menu-text"> THỐNG KÊ</span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
            <li class="" id="li-statistic-month">
                <a href="/admin/statistics/month">
                    <i class="menu-icon fa fa-caret-right"></i>
                    THỐNG KÊ THEO THÁNG
                </a>
                <b class="arrow"></b>
            </li>
            <li class="" id="li-statistic-group">
                <a href="/admin/statistics/group">
                    <i class="menu-icon fa fa-caret-right"></i>
                    THỐNG KÊ THEO NHÓM
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
    </li>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon ace-save-state <?php if($this->Session->check('min-menu') && $this->Session->read('min-menu') == 'true'){echo 'fa fa-angle-double-right';} else {echo 'fa fa-angle-double-left';}?>" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right" data-st="<?php if($this->Session->read('min-menu') == 'true'){echo '0';} else {echo '1';}?>"></i>
    </div>
</ul>