<?php
include "header_product.ctp";
    echo $this->fetch('content');
include "footer.ctp";
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('ace.min');
echo $this->Html->script('select2.min');
echo $this->Html->script('wizard.min');
echo $this->Html->script('ace-elements.min');
echo $this->Html->script('bootbox');
echo $this->Html->script('mscript');
echo $this->Html->script('jquery.colorbox.min');
?>
<script>
    $(function () {
        $(".menu-xs #accordian h4").click(function(){
            $(".menu-xs #accordian ul ul").slideUp();
            if(!$(this).next().is(":visible"))
            {
                $(this).next().slideDown();
            }
        });
        $('.a-close-menu').click(function(){
            $('.menu-xs').hide();
            $('body').css('overflow-y','scroll');
            $('#btn-menu-xs').data('status', true);
        });
        $('#btn-menu-xs').click(function () {
            var status = $(this).data('status');
            if(status == true)
            {
                $(".menu-xs").show("drop");
                $('body').css('overflow-y','hidden');
                $('#btn-menu-xs').data('status', false);
            }
            else
            {
                $('.menu-xs').hide('drop');
                $('body').css('overflow-y','scroll');
                $('#btn-menu-xs').data('status', true);
            }
        });
        $(window).resize(function () {
            if($(window).width() > 768)
            {
                $('.menu-xs').hide();
                $('body').css('overflow-y', 'scroll');
            }
        });
    })
</script>
</body>
</html>
