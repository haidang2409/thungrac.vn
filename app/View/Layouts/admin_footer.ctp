<?php //echo $this->Element('sql_dump');?>
<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
            <span class="bigger-120">
                <span class="blue bolder">BDS</span>
                Copyright &copy; 2017
            </span>
            <span class="action-buttons">
                <a href="#">
                    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                </a>
                <a href="#">
                    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                </a>
                <a href="#">
                    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                </a>
            </span>
        </div>
    </div>
</div>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
<?php
echo $this->Html->script('bootstrap');
echo $this->Html->script('jquery-ui');
echo $this->Html->script('jquery.validate.min');
echo $this->Html->script('ace-elements.min');
echo $this->Html->script('select2.min');
echo $this->Html->script('ace.min');
//
echo $this->Html->script('moment.min');


//
?>
</body>
</html>