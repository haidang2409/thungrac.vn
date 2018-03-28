<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div style="font-size: 1.2em; color: #8C8C8C">
                <?php
                if(isset($helps))
                {
                    echo str_replace('app/webroot/', '', $helps['Help']['content']);
                }
                ?>
            </div>
        </div>
    </div>
</div>