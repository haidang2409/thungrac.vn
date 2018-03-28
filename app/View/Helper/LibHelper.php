<?php
/**
 * Created by PhpStorm.
 * User: nhdang
 * Date: 6/16/2017
 * Time: 3:34 PM
 */
class LibHelper extends AppHelper
{
    function substr_blank($str, $numCharacter)
    {
        $result = $result = substr($str, $numCharacter);;
        $num = 0;
        $char = substr($str, $numCharacter, 1);
        while($char != ' ')
        {
            $char = substr($str, $numCharacter + 1, 1);
            $num = $num + 1;

        }

    }
    function convertDateTime_Mysql_to_Date($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        return $newDate;
    }
    function convertDateTime_Mysql_to_Time($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        return $newDate;
    }
    function convertDateTime_Mysql_to_DateTime($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0] . ' ' . $arr[1];
        return $newDate;
    }
    function hide_phonenumber($phonenumber)
    {
        $len = strlen($phonenumber);
        if($len == 10)
        {
            return substr($phonenumber, 0, 7) . 'xxx';
        }
        else
        {
            return substr($phonenumber, 0, 8) . 'xxx';
        }
    }
    function removeScript($str)
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $str);
    }
    function replace_frame_280_160($url)
    {
        $result = preg_replace('#(WIDTH|width)(.*?)=(.*?)"(.*?)"#is', 'width="280"', $url);
        $result = preg_replace('#(HEIGHT|height)(.*?)=(.*?)"(.*?)"#is', 'height="160"', $result);
        return $result;
    }
    function replace_frame_80_160($url)
    {
        $result = preg_replace('#(WIDTH|width)(.*?)=(.*?)"(.*?)"#is', 'width="100%"', $url);
        $result = preg_replace('#(HEIGHT|height)(.*?)=(.*?)"(.*?)"#is', 'height="250px"', $result);
        return $result;
    }
    function encrypt_data($data, $key) {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
        return $encrypted;
    }
    function decrypt_data($data, $key) {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
        return $decrypted;
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' trước' : 'vừa mới';
    }
    function hidden_text($text, $number)
    {
        $summary = $text;
        $num_str = strlen($summary);
        if($num_str > $number)
        {
            $summary = substr($summary, 0, $number);
            $start = strripos($summary, ' ');
            if($start > 0)
            {
                $summary = substr($summary, 0, $start + 1) . '...';
            }
        }
        return $summary;
    }

    //$time = strtotime('2010-04-28 17:25:43');
    //echo 'event happened '.humanTiming($time).' ago';

}