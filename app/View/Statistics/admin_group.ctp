<div class="main-content" id="content-post">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="menu-icon ace-icon fa fa-home home-icon"></i>
                    <a href="/admin">Trang chủ</a>
                </li>
                <li><a href="/admin/statistics">Thống kê</a> </li>
                <li class="active">Thống kê theo nhóm</li>
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
                    <div class="col-sm-8">
                        <h1>
                            Thống kê theo nhóm
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-4">
                        <form method="get" action="">
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <?php
                                    $year = isset($this->params['url']['year'])? $this->params['url']['year']: '';
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
                                <canvas id="chart" width="270" height="270">

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
                                <canvas id="chart2" width="270" height="270">

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
<script>
    var data_pie = [];
    var data_pie2 = [];
    var year = 2017;
    <?php
    $sum_product = 0;
    if(isset($data))
    {
        $color = array('#FF0000', '#ffA500', '#ffff00', '#008000', '#0000ff', '#800080', '#ff1493', '#EEDD82', '#7EC0EE', '#87CEFF', '#87CEEB', '#A2B5CD', '#BCD2EE', '#CAE1FF', '#7A8B8B', '#B4CDCD', '#D1EEEE', '#E0FFFF', '#9BCD9B', '#B4EEB4','#4EEE94');
        $i = 0;
        foreach ($data as $item)
        {
            $sum_product = $sum_product + $item[0]['sum'];
            echo 'data_pie[' . $i . '] = ';
            echo '{';
            echo '"value": "' . $item[0]['sum'] .'", ';
            echo '"color": "' . $color[$i] .'", ';
            echo '"highlight": "#B5B5B5", ';
            echo '"highlight": "#B5B5B5", ';
            echo '"label": "' . $item['Category']['categoryname'] .'"';
            echo '};';
            $i = $i + 1;
        }
    }
    ?>
    <?php
    $sum_revenue = 0;
    if(isset($data2))
    {
        $color = array('#FF0000', '#ffA500', '#ffff00', '#008000', '#0000ff', '#800080', '#ff1493', '#EEDD82', '#7EC0EE', '#87CEFF', '#87CEEB', '#A2B5CD', '#BCD2EE', '#CAE1FF', '#7A8B8B', '#B4CDCD', '#D1EEEE', '#E0FFFF', '#9BCD9B', '#B4EEB4','#4EEE94');
        $i = 0;
        foreach ($data2 as $item)
        {
            $sum_revenue = $sum_revenue + $item[0]['sum'];
            echo 'data_pie2[' . $i . '] = ';
            echo '{';
            echo '"value": "' . $item[0]['sum'] .'", ';
            echo '"color": "' . $color[$i] .'", ';
            echo '"highlight": "#B5B5B5", ';
            echo '"highlight": "#B5B5B5", ';
            echo '"label": "' . $item['Category']['categoryname'] .'"';
            echo '};';
            $i = $i + 1;
        }
    }
    ?>
    //
    var sum_product = <?php echo $sum_product;?>;
    var sum_all_product = '';
    var sum_revenue = <?php echo $sum_revenue;?>;
    var sum_all_revenue = '';
    var arr =[];
    var arr2 = [];
    for( var i in data_pie ) {
        arr.push(data_pie[i]);
    }
    for( var j in data_pie2 ) {
        arr2.push(data_pie2[j]);
    }
    var pie_ctx = document.getElementById("chart").getContext("2d");
    window.myPie = new Chart(pie_ctx).Pie(arr, {
        tooltipTemplate: "<%=label%>: <%=addCommas(value)%>"
    });
    var pie_ctx2 = document.getElementById("chart2").getContext("2d");
    window.myPie = new Chart(pie_ctx2).Pie(arr2, {
        tooltipTemplate: "<%=label%>: <%=addCommas(value)%>VND"
    });
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
    //
    $(function () {
//        var j = 0;
        //Tong doanh thu theo nam
        //Dua du lieu len table doanh thu
        var html = '';
        var k = 0;
        for(k in arr)
        {
            html = html + '<tr>';
            html = html + '<td>';
            html = html + '<div style="background-color: ' + arr[k]['color'] + '; height: 15px; width: 15px; display: inline-block; margin-right: 10px; padding-top: 5px"></div>';
            html = html + arr[k]['label'];
            html = html + '</td>';
            html = html + '<td align="right">';
            html = html + addCommas(arr[k]['value']);
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
        ///
        html = '';
        k = 0;
        for(k in arr2)
        {
            html = html + '<tr>';
            html = html + '<td>';
            html = html + '<div style="background-color: ' + arr2[k]['color'] + '; height: 15px; width: 15px; display: inline-block; margin-right: 10px; padding-top: 5px"></div>';
            html = html + arr2[k]['label'];
            html = html + '</td>';
            html = html + '<td align="right">';
            html = html + addCommas(arr2[k]['value']);
            html = html + '</td>';
            html = html + '</tr>';
        }
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng năm ' + year + '</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_revenue) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        html = html + '<tr>';
        html = html + '<td>';
        html = html + '<b>Tổng</b>';
        html = html + '</td>';
        html = html + '<td align="right">';
        html = html + '<b>' + addCommas(sum_all_revenue) + '</b>';
        html = html + '</td>';
        html = html + '</tr>';
        $('#table-doanhthu').html(html);
        $('#legend2').show(200);

        $('#li-statistic').addClass('active open');
        $('#li-statistic-group').addClass('active');
    })

</script>