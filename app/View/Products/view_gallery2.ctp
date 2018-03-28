<div class="col-md-12">
    <style>
        .gallery-opt-2
        {
            width: 100%;
        }
        .gallery-opt-2 ul {
            list-style: none outside none;
            padding-left: 0;
            margin-bottom:0;
            margin-left: 0 !important;
        }
        .gallery-opt-2 li {
            width: 100%;
            display: block;
            float: left;
            margin-right: 6px;
            cursor:pointer;
            background-color: rgba(229, 229, 229, 1);
            text-align: center;
        }
        .gallery-opt-2 img {
            display: block;
            height: auto;
            width: 100%;
            margin: auto;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/js/lightslider.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.3/css/lightslider.min.css"/>
    <div class="demo gallery-opt-2">
        <ul id="lightSlider">
            <?php
            for($i = 0; $i < $sum_image; $i++)
            {
                ?>
                <li data-thumb="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink'];?>">
                    <img src="/uploads/products/<?php echo $images[$i]['Image']['imagedir'];?>/<?php echo $images[$i]['Image']['imagelink'];?>"
                         alt="<?php echo htmlentities($product['Product']['title'], ENT_QUOTES, 'UTF-8');?>"/>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <script>
        $(function () {
            $('#lightSlider').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                slideMargin: 0,
                thumbItem: 9
            });
        })
    </script>
</div>