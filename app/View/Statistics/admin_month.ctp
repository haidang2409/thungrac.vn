<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/statistics">Thống kê</a> </li>
                <li class="active">Thống kê theo tháng</li>
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
                <div class="row">
                    <div class="col-sm-6">
                        <h1>
                            Thống kê theo tháng
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <form method="get" action="">
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <?php
                                    $date = getdate();
                                    $year = isset($this->params['url']['year'])? $this->params['url']['year']: $date['year'];
                                    ?>
                                    <select name="year" class="form-control">
                                        <option value=""> -- Chọn năm -- </option>
                                        <option value="2017" <?php if($year == 2017) { echo 'selected';}?>>2017</option>
                                        <option value="2018" <?php if($year == 2018) { echo 'selected';}?>>2018</option>
                                        <option value="2019" <?php if($year == 2019) { echo 'selected';}?>>2019</option>
                                        <option value="2020" <?php if($year == 2020) { echo 'selected';}?>>2020</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-info btn-xs" type="submit">Xem <i class="fa fa-eye"></i> </button>
                                    <a href="/admin/statistics/group" class="btn btn-danger btn-xs" type="submit">Xóa <i class="fa fa-remove"></i> </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-7 col-xs-12">
                            <div id="" style="text-align: center; overflow-x: auto">
                                <canvas id="chart" width="600" height="480">

                                </canvas>
                                <br><br>
                                <b>
                                    <i>
                                        Thống kê tổng số tin đăng
                                        <?php
                                        if($year != '')
                                        {
                                            echo ' năm ' . $year;
                                        }
                                        ?>
                                    </i>
                                </b>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div id="legend" style="display: none">
                                <table class="table table-hover" id="table-sum-product">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-sm-7 col-xs-12">
                            <div id="" style="text-align: center; overflow-x: auto">
                                <canvas id="chart2" width="600" height="480">

                                </canvas>
                                <br><br>
                                <b>
                                    <i>
                                        Thống kê doanh thu
                                        <?php
                                        if($year != '')
                                        {
                                            echo ' năm ' . $year;
                                        }
                                        ?>
                                    </i>
                                </b>

                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div id="legend2" style="display: none">
                                <table class="table table-hover" id="table-doanhthu">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<!--End modal-->
<?php
echo $this->Html->script('Chart.min');
?>
<script type="text/javascript">
    var lable = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
    var year = <?php echo $year;?>;
    var product = {<?php
    $i = 0;
    $sum_product = 0;
    foreach ($data as $item)
    {
        $sum_product = $sum_product + $item[0];
        echo $i . ':' . $item[0] . ',';
        $i = $i + 1;
    }
    ?>};
    var order = {<?php
        $i = 0;
        $sum_order = 0;
        foreach ($data2 as $item)
        {
            $sum_order = $sum_order + $item[0];
            echo $i . ':' . $item[0] . ',';
            $i = $i + 1;
        }
        ?>};
    var data = {
        labels: lable,
        datasets: [
            {
                label: 'My data',
                fillColor: "rgba(100,149,237,0.5)",
                strokeColor: "rgba(100,149,240,0.8)",
                data: product
            }
        ]
    };
    var data2 = {
        labels: lable,
        datasets: [
            {
                label: 'My data',
                fillColor: "rgba(100,149,237,0.5)",
                strokeColor: "rgba(100,149,240,0.8)",
                data: order
            }
        ]
    };
    var options =
        {
            tooltipTemplate: "<%= addCommas(value)%>",
        };
    var options2 =
        {
            scaleLabel: "<%= addCommas(value)%>",
            tooltipTemplate: "<%= addCommas(value)%>VND",
        };
    var ctx = document.getElementById("chart").getContext("2d");
    var myBarChart = new Chart(ctx).Bar(data, options);
    var ctx2 = document.getElementById("chart2").getContext("2d");
    var myBarChart2 = new Chart(ctx2).Bar(data2, options2);
    function addCommas(nStr)
    {
        nStr += '';
        x1 = nStr;
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1;
    }
    function add(a, b)
    {
        return a + b;
    }


    $(function () {
        var j = 0;
        var sum_product = <?php echo $sum_product?>;
        var sum_all_product = '';
        //Dua du lieu len table doanh thu
        var html = '';
        for(var k = 0 in lable)
        {
            html = html + '<tr>';
            html = html + '<td>';
            html = html + lable[k];
            html = html + '</td>';
            html = html + '<td align="right">';
            html = html + addCommas(product[k]);
            html = html + '</td>';
            html = html + '</tr>';
        }
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng năm ' + year + '</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_product) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_all_product) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        $('#table-sum-product').html(html);

        $('#legend').show(200);

        var sum_order = <?php echo $sum_order?>;
        var sum_all_order = '';
        //Dua du lieu len table doanh thu
        html = '';
        for(var k = 0 in lable)
        {
            html = html + '<tr>';
            html = html + '<td>';
            html = html + lable[k];
            html = html + '</td>';
            html = html + '<td align="right">';
            html = html + addCommas(order[k]);
            html = html + '</td>';
            html = html + '</tr>';
        }
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng năm ' + year + '</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_order) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_all_order) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        $('#table-doanhthu').html(html);

        $('#legend2').show(200);

        $('#li-statistic').addClass('active open');
        $('#li-statistic-month').addClass('active');
    })
</script>
