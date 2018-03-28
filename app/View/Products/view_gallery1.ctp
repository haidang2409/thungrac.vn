<div class="col-sm-12">
    <div class="div-product-image">
        <ul class="ace-thumbnails clearfix">
            <!--                                Ảnh chính-->
            <?php
            $loop = $sum_image;
            if($sum_image >= 5)
            {
                $loop = 4;
            }
            for($i = 0; $i < $loop; $i++)
            {
                ?>
                <li>
                    <a href="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink'];?>" data-rel="colorbox" class="cboxElement">
                        <img alt="<?php echo $product['Product']['title'];?>" src="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink'];?>">
                        <div class="text">
                            <div class="inner">Phóng to ảnh</div>
                        </div>
                    </a>
                </li>
                <?php
            }
            ?>
            <?php
            //Tại vị trí ảnh thứ 5 cần thêm label còn hay hết ảnh (+)
            if($sum_image >= 5)
            {
                ?>
                <li>
                    <a href="/uploads/products/<?php echo $images[4]['Image']['imagedir'];?>/<?php echo $images[4]['Image']['imagelink'];?>" data-rel="colorbox" class="cboxElement">
                        <img alt="<?php echo $product['Product']['title'];?>" src="/uploads/products/<?php echo $images[4]['Image']['imagedir'];?>/<?php echo $images[4]['Image']['imagelink'];?>">
                        <?php
                        //Nếu = 4 ảnh thì không cần thêm label +
                        if($sum_image == 5)
                        {
                            ?>
                            <div class="text">
                                <div class="inner">
                                    Phóng to ảnh
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            //Nếu lớn hơn 4 ảnh thì thêm lable +
                            ?>
                            <div class="text text-last">
                                <div class="inner">
                                    <i class="fa fa-image"> </i>
                                    <?php echo ($sum_image - 5);?> +
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </a>
                </li>
                <?php
            }
            //Ẩn các ảnh sau ảnh thứ tư style dislay none
            if($sum_image > 5)
            {
                for($j = 5; $j < $sum_image; $j++)
                {
                    ?>
                    <li style="display: none">
                        <a href="/uploads/products/<?php echo $images[$j]['Image']['imagedir'];?>/<?php echo $images[$j]['Image']['imagelink'];?>" data-rel="colorbox" class="cboxElement">
                        </a>
                    </li>
                    <?php
                }
            }
            //Nếu không đủ 4 ảnh => Chèn ảnh no-image vào
            if($sum_image < 5)
            {
                $loop_no = 5 - $sum_image;
                for($k = 0; $k < $loop_no; $k++)
                {
                    ?>
                    <li>
                        <a href="/uploads/products/no-image-product.png" data-rel="colorbox" class="cboxElement">
                            <img alt="" src="/uploads/products/no-image-product.png">
                        </a>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div><!-- PAGE CONTENT ENDS -->
    <script type="text/javascript">
        jQuery(function($) {
            var $overflow = '';
            var colorbox_params = {
                title: false,
                rel: 'colorbox',
                reposition:true,
                scalePhotos:true,
                scrolling:false,
                previous:'<i class="ace-icon fa fa-arrow-left"></i>',
                next:'<i class="ace-icon fa fa-arrow-right"></i>',
                close:'&times;',
                current:'{current}/{total}',
                maxWidth:'100%',
                maxHeight:'100%',
                onOpen:function(){
                    $overflow = document.body.style.overflow;
                    document.body.style.overflow.x = 'scroll';
                    document.body.style.overflow.y = 'hidden';
                },
                onClosed:function(){
                    document.body.style.overflow = $overflow;
                },
                onComplete:function(){
                    $.colorbox.resize();
                }
            };

            $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
            $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
            $(document).one('ajaxloadstart.page', function(e) {
                $('#colorbox, #cboxOverlay').remove();
            });
        })
    </script>
</div>