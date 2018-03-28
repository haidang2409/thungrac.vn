<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <?php
            echo $this->Session->flash();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div style="font-size: 1.2em; color: #474747">
                <h2>Liên hệ</h2>
                <div class="div-contact">
                    <p style="padding-left: 45px">Quý khách có yêu cầu, thắc mắc hay góp ý về dịch vụ xin vui lòng liên hệ với chúng tôi qua:</p>
                    <p style="font-size: 1.2em"><b>Công ty TNHH Tư Vấn Và Đào Tạo Hiện Thực Ước Mơ</b></p>
                    <p><i class="fa fa-phone"></i> Số điện thoại: <a href="tel:0901032320">0901 032 320</a> </p>
                    <p><i class="fa fa-envelope"></i> Email: <a href="mailto:cskh@dream.edu.vn">cskh@dream.edu.vn</a> </p>
                    <p><i class="fa fa-envelope"></i> Hỗ trợ kỹ thuật: <a href="mailto:hotro@dream.edu.vn">hotro@dream.edu.vn</a> </p>
                    <p><i class="fa fa-home"></i> Địa chỉ VP: Số 86 Mạc Thiên Tích, P. Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ </p>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <h3 style="margin-bottom: 15px !important;" class="blue">Liên hệ qua email</h3>
            <div style="">
                <form class="form-horizontal form-login form-register-info" id="formContact" method="post" action="">
                    <p style="padding: 10px 0">Hoặc để lại thông tin của bạn chúng tôi sẽ liên hệ qua email</p>
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">Họ tên (*)</label>
                    <div class="col-sm-8">
                        <input class="form-control popover-error" type="text" id="fullname" name="fullname" data-rel="popover" data-placement="top">
                        <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">Email (*)</label>
                    <div class="col-sm-8">
                        <input class='form-control' type="text" id="email" name="email" data-rel="popover" data-placement="top">
                        <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">Số điện thoại (*)</label>
                    <div class="col-sm-8">
                        <input class='form-control' type="text" id="phonenumber" name="phonenumber" data-rel="popover" data-placement="top">
                        <span class="glyphicon glyphicon-earphone form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label col-sm-4">Nội dung (*)</label>
                    <div class="col-sm-8">
                        <textarea style="resize: none" class='form-control' id="content" name="content" data-rel="popover" data-placement="top"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center-xs text-right">
                        <button class="btn btn-index" id="btnRegisterContact" type="button">Gửi <i class="fa fa-arrow-right"></i> </button>
                    </div>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.867008818582!2d105.77079711416663!3d10.027831675307388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a088237e8ca827%3A0x765c14afc9c1466a!2zQ8O0bmcgVHkgVE5ISCBUxrAgVuG6pW4gVsOgIMSQw6BvIFThuqFvIEhp4buHbiBUaOG7sWMgxq_hu5tjIE3GoQ!5e0!3m2!1svi!2s!4v1503714257752" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
<style>
    .popover-content
    {
        color: #E74C3C !important;
    }
</style>
<?php echo $this->Html->script('jquery.validate.min');?>
<script>
    $(function () {
//        $('[data-rel=popover]').popover();
        $('#btnRegisterContact').click(function () {
            clearVal();
            if($.trim($('#fullname').val()) == '')
            {
                $('#fullname').attr('data-content', 'Nhập họ tên');
                $('#fullname').popover('show');
                return false;
            }
            else
            {
                $('#fullname').popover('hide');
            }
            //
            if($.trim($('#email').val()) == '')
            {
                $('#email').attr('data-content', 'Nhập địa chỉ email');
                $('#email').popover('show');
                return false;
            }
            else
            {
                if(!validateemail($('#email').val()))
                {
                    $('#email').attr('data-content', 'Nhập đúng địa chỉ email');
                    $('#email').popover('show');
                    return false;
                }
                else
                {
                    $('#email').popover('hide');
                }
            }
            //Phone
            if($.trim($('#phonenumber').val()) == '')
            {
                $('#phonenumber').attr('data-content', 'Nhập số điện thoại');
                $('#phonenumber').popover('show');
                return false;
            }
            else
            {
                if(!validatePhone($('#phonenumber').val()) || $.trim($('#phonenumber').val()).length < 10 || $.trim($('#phonenumber').val()).length > 11)
                {
                    $('#phonenumber').attr('data-content', 'Nhập đúng số điện thoại');
                    $('#phonenumber').popover('show');
                    return false;
                }
                else
                {
                    $('#phonenumber').popover('hide');
                }
            }
            //Content
            if($.trim($('#content').val()) == '')
            {
                $('#content').attr('data-content', 'Nhập nội dung');
                $('#content').popover('show');
                return false;
            }
            else
            {
                $('#content').popover('hide');
            }
            $(this).attr('disabled', true);
            $(this).html('Đang gửi <i class="fa fa-spin fa-spinner"></i>')
            $.ajax({
                url: '/contacts/add_contact',
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#fullname').val(),
                    email: $('#email').val(),
                    phone: $('#phonenumber').val(),
                    content: $('#content').val()
                },
                success: function (data) {
                    if(data)
                    {
                        window.location = window.location;
                    }
                }
            })

        });
        //Function
        function clearVal()
        {
            $("input").removeClass('input-error');
        }
        function validateemail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        function validatePhone(phone)
        {
            var filter = /^[0-9-+]+$/;
            var result = false;
            if (filter.test(phone))
            {
                result = true;
            }
            return result;
        }
    })
</script>