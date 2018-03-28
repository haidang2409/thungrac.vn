/**
 * Created by nhdang on 1/31/2018.
 */
$(function(){
    jQuery.support.cors = true;
    $.ajax({
        url: 'http://thanhlycantho.com/products/api_get_products',
        type: 'POST',
        dataType: 'JSON',
        data: {
            serect_key: 'thanhlycantho.com',
            site_key: 'api_cdc001'
        },
        beforeSend: function()
        {
            $('#api-get-cdc-new').html('<div class="text-center" style="margin-top: 20px"><i class="fa fa-spin fa-spinner text-center" style="color: #d5d5d5; font-size: 3em"></i><br>Đang tải</div>');
        },
        success: function(data)
        {
            $('#api-get-cdc-new').html('');
            var sum = data.length;
            if(sum > 0)
            {
                $('#api-get-cdc-new').html('<h3><a href="http://thanhlycantho.com">ĐỒ CŨ - THANH LÝ</a></h3>');
                var i = 0;
                for(i; i < sum; i++)
                {
                    var html = '<div class="item">';
                    html = html + '<div class="col-xs-12"><h4><a target="_blank" href="' + data[i].productlink + '">' + data[i].title +'</a></h4></div>';
                    html = html + '<div class="col-xs-4"><a target="_blank" href="' + data[i].productlink + '"><div class="bg" style="background: url(' + data[i].image + ')"></div></a></div>';
                    html = html + '<div class="col-xs-8">' +
                        '<div class="text-center bolder bigger-120" style="color: #1ABB9C">' + data[i].price + '</div> ' +
                        '<div class=""><i class="fa fa-map-marker"> </i> ' + data[i].address + '</div> ' +
                        '</div>';
                    html = html + '</div>';
                    $('#api-get-cdc-new').append(html);
                }
            }
        }
    })
});
