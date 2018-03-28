<div class="div-social hidden-xs" style="display: none">
    <a class="btn btn-primary" title="Share Facebook" href="https://www.facebook.com/sharer?u=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" target="_blank">
        <i class="fa fa-facebook">

        </i>
    </a>
    <a class="btn btn-primary" title="Share Google +" href="https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" target="_blank">
        <i class="fa fa-google-plus">

        </i>
    </a>
    <a class="btn btn-primary" title="Share Twitter">
        <i class="fa fa-twitter">

        </i>
    </a>
    <i id="btn-hide-div-social" class="ace-icon fa fa-angle-double-right orange2"></i>

</div>
<script>
    $(function () {
        setTimeout(function () {
            $(".div-social").animate({width:'toggle'}, 1000);
//            $('.div-social').show("drop");
        }, 2500)
    })
</script>