<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
                    <ul class="steps" style="margin-left: 0">
                        <li data-step="1" class="complete">
                            <span class="step">1</span>
                            <span class="title">Nhập thông tin</span>
                        </li>
                        <li data-step="2" class="complete">
                            <span class="step">2</span>
                            <span class="title">Chọn dịch vụ và thanh toán</span>
                        </li>
                        <li data-step="3" class="complete">
                            <span class="step">3</span>
                            <span class="title">Hoàn thành</span>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="step-content pos-rel">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2" style="min-height: 350px">
                            <div class="" style="min-height: 200px">
                                <?php
                                echo $this->Session->flash();
                                ?>
                                <div class="text-center">
                                    <h4>
                                        Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi
                                    </h4>
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="/" class="btn btn-index">  <i class="fa fa-arrow-left"> </i> Trở về trang chủ</a>
                                    <a href="/members/mypost" class="btn btn-index">Tin đăng của bạn <i class="fa fa-arrow-right"> </i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.widget-body -->
        <!--            Steps-->
    </div>
</div>
<!--Maps-->
</script>