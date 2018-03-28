<?php
class TestsController extends AppController
{
    function testsms()
    {
        $_api_key = 'B0D5992F657C6269EABB212B679BB7';
        $_secrect_key = 'B85E0F19CD14C88E0AF44410F839A7';
        $url = "http://rest.esms.vn/MainService.svc/json/GetBalance/$_api_key/$_secrect_key";
//        $this->redirect($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        print_r($result);

        //
//        $json = file_get_contents($url);
//        $obj = json_decode($json);
//        debug($obj);

        $phone = '01215941976';
        $message = 'Ma kich hoat tai khoan cua ban la: ZXCVB. Vui long kich hoat tai khoan de su dung!';

        $url_send_sms = "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phone&Content=$message&ApiKey=$_api_key&SecretKey=$_secrect_key&SmsType=7";
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url_send_sms);
        $result = curl_exec($ch2);
        debug($result);
        //

    }
    function test_image_mask()
    {
        $img = new Imagick('http://thungrac.vn/img/bocongthuong.png');
    }

}