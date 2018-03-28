<div class="col-xs-12">
    <i class="ace-icon fa fa-arrow-left"></i>
</div>
<div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
    <div>
        <ul class="ace-thumbnails clearfix">
            <li>
                <a href="/img/temp/gallery/image-1.jpg" title="Photo Title" data-rel="colorbox" class="cboxElement">
                    <img alt="150x150" src="/img/temp/gallery/thumb-1.jpg" width="150" height="150">
                </a>

                <div class="tags">
												<span class="label-holder">
													<span class="label label-info">breakfast</span>
												</span>

                    <span class="label-holder">
													<span class="label label-danger">fruits</span>
												</span>

                    <span class="label-holder">
													<span class="label label-success">toast</span>
												</span>

                    <span class="label-holder">
													<span class="label label-warning arrowed-in">diet</span>
												</span>
                </div>

                <div class="tools">
                    <a href="#">
                        <i class="ace-icon fa fa-link"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-paperclip"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-times red"></i>
                    </a>
                </div>
            </li>

            <li>
                <a href="/img/temp/gallery/image-2.jpg" data-rel="colorbox" class="cboxElement">
                    <img alt="150x150" src="/img/temp/gallery/thumb-2.jpg" width="150" height="150">
                    <div class="text">
                        <div class="inner">Sample Caption on Hover</div>
                    </div>
                </a>
            </li>

            <li>
                <a href="/img/temp/gallery/image-3.jpg" data-rel="colorbox" class="cboxElement">
                    <img alt="150x150" src="/img/temp/gallery/thumb-3.jpg" width="150" height="150">
                    <div class="text">
                        <div class="inner">Sample Caption on Hover</div>
                    </div>
                </a>

                <div class="tools tools-bottom">
                    <a href="#">
                        <i class="ace-icon fa fa-link"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-paperclip"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-times red"></i>
                    </a>
                </div>
            </li>

            <li>
                <a href="/img/temp/gallery/image-4.jpg" data-rel="colorbox" class="cboxElement">
                    <img alt="150x150" src="/img/temp/gallery/thumb-4.jpg" width="150" height="150">
                    <div class="tags">
													<span class="label-holder">
														<span class="label label-info arrowed">fountain</span>
													</span>

                        <span class="label-holder">
														<span class="label label-danger">recreation</span>
													</span>
                    </div>
                </a>

                <div class="tools tools-top">
                    <a href="#">
                        <i class="ace-icon fa fa-link"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-paperclip"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-times red"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div><!-- PAGE CONTENT ENDS -->
</div>
<script type="text/javascript">
    jQuery(function($) {
        var $overflow = '';
        var colorbox_params = {
            rel: 'colorbox',
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="ace-icon fa fa-arrow-left"></i>',
            next:'<i class="ace-icon fa fa-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'scroll';
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