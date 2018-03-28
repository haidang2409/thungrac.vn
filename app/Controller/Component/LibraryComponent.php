<?php
class LibraryComponent extends Component
{
    public function randomNumber($option = 10)
    {
        $int = rand(0,51);
        $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_letter = $a_z[$int];
        for($i=1; $i < $option; $i++){
            $int1 = rand(0,51);
            $rand_letter.= $a_z[$int1];
        }
        return $rand_letter;
    }
    function convert_date_dd_mm_yyyy_to_yyyy_mm_dd($datetime)
    {
        if($datetime != '' && $datetime != null)
        {
            $arr = explode(' ', $datetime);
            $date = $arr[0];
            $arrDate = explode('/', $date);
            $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
            return $newDate;
        }
        else
        {
            return null;
        }
    }
    public function make_link($str){
        //$str = "Hàm cắt bỏ              khoảng  trắng";
//        echo preg_replace('/\-\-+/', '-', trim($str)); // Hàm cắt bỏ khoảng trắng
        $str = trim($str);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-'=>' ',
        );
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = preg_replace('/[^a-zA-Z0-9\-_]/','',$str);
        $str = preg_replace('/\-\-+/', '-', $str);
        $num = strlen($str);
        if($num > 255)
        {
            $str = substr($str, 0, 255);
        }
        return strtolower($str);
    }
    public function create_folder($year, $month, $path)
    {
        if(!file_exists($path.DS.$year))
        {
            mkdir($path.DS.$year, 0777);
        }
        if(!file_exists($path.DS.$year.DS.$month))
        {
            mkdir($path.DS.$year.DS.$month, 0777);
        }
        return $path.DS.$year.DS.$month;
    }
    function encrypt_data($string, $key){
        $result = "";
        for($i=0; $i<strlen($string); $i++){
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        $salt_string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789";//~!@#$^&*()_+`-={}|:<>?[]\;',./";
        $length = rand(1, 15);
        $salt = "";
        for($i=0; $i<=$length; $i++){
            $salt .= substr($salt_string, rand(0, strlen($salt_string)), 1);
        }
        $salt_length = strlen($salt);
        $end_length = strlen(strval($salt_length));
        return base64_encode($result.$salt.$salt_length.$end_length);
    }
    function decrypt_data($string, $key){
        $result = "";
        $string = base64_decode($string);
        $end_length = intval(substr($string, -1, 1));
        $string = substr($string, 0, -1);
        $salt_length = intval(substr($string, $end_length*-1, $end_length));
        $string = substr($string, 0, $end_length*-1+$salt_length*-1);
        for($i=0; $i<strlen($string); $i++){
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }
    function convertDateTime_Mysql_to_DateTime($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0] . ' ' . $arr[1];
        return $newDate;
    }
    function convertDateTime_Mysql_to_Date($datetime)
    {
        $arr = explode(' ', $datetime);
        $date = $arr[0];
        $arrDate = explode('-', $date);
        $newDate = $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        return $newDate;
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    function watermark_image($file, $destination, $overlay){
        $watermark =    imagecreatefrompng($overlay);
        $source = getimagesize($file);
        $source_mime = $source['mime'];
        //Lấy kích thướt ảnh
        //print_r($source)//để xem tham số
        $source_x = $source[0];
        $source_y = $source[1];
        if($source_mime == "image/png"){
            $image = imagecreatefrompng($file);
        }else if($source_mime == "image/jpeg"){
            $image = imagecreatefromjpeg($file);
        }else if($source_mime == "image/gif"){
            $image = imagecreatefromgif($file);
        }
        //Lấy chiều ngang/2 = tâm x, trừ 147(do anh mark co chieu ngang 295/2) => anh mark nam ngay tam theo chieu ngang
        $X = ($source_x / 2) - 147;
        //Lấy chiều cao - 50 (do anh mark cao 40) tru them 10 để cách bottom 10
        $Y = $source_y - 50;
        imagecopy($image, $watermark, $X, $Y, 0, 0, imagesx($watermark), imagesy($watermark));
        imagepng($image, $destination);
        return $destination;
    }
    function img_resize($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
    {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);
        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }
        #Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);
        #Do some math to figure out which way we'll need to crop the image
        #to get it proportional to the new size, then crop or adjust as needed
        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;

        if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
            $new_w = $src_w;
            $new_h = $src_h;
        } elseif (($x_ratio * $src_h) < $tn_h) {
            $new_h = ceil($x_ratio * $src_h);
            $new_w = $tn_w;
        } else {
            $new_w = ceil($y_ratio * $src_w);
            $new_h = $tn_h;
        }
        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, 229, 229, 229);
        imagefill($final, 0, 0, $backgroundColor);
        //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
        #if we need to add a watermark
        if ($wmsource) {
            #find out what type of image the watermark is
            $info    = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);

            #assuming the mime type is correct
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    break;
                default:
                    die('Invalid watermark type.');
            }
            #if we're adding a watermark, figure out the size of the watermark
            #and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, 185, 405, 0, 0, $wm_w, $wm_h);
        }
        if (imagejpeg($final, $destination, $quality)) {
            return true;
        }
        return false;
    }
}