<?php
include 'admin_header.ctp';
echo $this->fetch('content');
//echo $this->element('sql_dump');
include 'admin_footer.ctp';
?>
<script>
    $(function () {
        $('#sidebar-toggle-icon').click(function () {
            var st = $(this).data('st');
            if(st == '1')
            {
                $('#sidebar-toggle-icon').data('st', '1');
                $.post('/admin/staffs/set_status_menu',{'status': 'true'},function(data){});
            }
            else
            {
                $('#sidebar-toggle-icon').data('st', '0');
                $.post('/admin/staffs/set_status_menu',{'status': 'false'},function(data){});
            }
        })
    })
</script>

