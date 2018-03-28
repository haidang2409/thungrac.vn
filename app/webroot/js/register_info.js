/**
 * Created by nhdang on 8/10/2017.
 */
$(function () {
    $('#btnRegister_Info').click(function () {
        clearVal();
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var phonenumber = $('#phonenumber').val();
        var content = $('#content').val();
        var product_id = $('#product_id').val();
        if($.trim(fullname) == '')
        {
            $('#fullname').focus;
            $('#fullname').addClass('errorClass');
            $('#fullname').next().after('<label class="errorLabel">Nhập họ tên của bạn</label>');
            return false;
        }
        if($.trim(email) == '')
        {
            $('#email').focus;
            $('#email').addClass('errorClass');
            $('#email').next().after('<label class="errorLabel">Nhập email của bạn</label>');
            return false;
        }
        if(!validateemail($.trim(email)))
        {
            $('#email').focus;
            $('#email').addClass('errorClass');
            $('#email').next().after('<label class="errorLabel">Nhập đúng email của bạn</label>');
            return false;
        }
        if($.trim(phonenumber) == '')
        {
            $('#phonenumber').focus;
            $('#phonenumber').addClass('errorClass');
            $('#phonenumber').next().after('<label class="errorLabel">Nhập số điện thoại của bạn</label>');
            return false;
        }
        if(!validatePhone($.trim(phonenumber)))
        {
            $('#phonenumber').focus;
            $('#phonenumber').addClass('errorClass');
            $('#phonenumber').next().after('<label class="errorLabel">Điện thoại phải là số</label>');
            return false;
        }
        if($.trim(phonenumber).length < 10 || $.trim(phonenumber).length  > 11)
        {
            $('#phonenumber').focus;
            $('#phonenumber').addClass('errorClass');
            $('#phonenumber').next().after('<label class="errorLabel">Điện thoại từ 10 đến 11 số</label>');
            return false;
        }
        //
        var data = {
            fullname: fullname,
            email: email,
            phonenumber: phonenumber,
            product_id: product_id,
            content: content
        };

        $.ajax({
            url: '/registerproducts/register_info',
            type: 'post',
            dataType: 'html',
            data: data,
            success: function(data)
            {
                if(data = 'success')
                {
                    alert('Đăng ký thành công');
                    $('#form-register-product')[0].reset();
                }
            }
        })
    })

});
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
function clearVal() {
    $("input").removeClass('errorClass');
    $('.errorLabel').remove();
}