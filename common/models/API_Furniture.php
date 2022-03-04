<?php 
namespace common\models;
?>
<?php 
class API_Furniture {
    public static function createCode($str)
    {
        $str = trim($str);
        $coDau = array("á","à","ả","ã","ạ","ă","ắ","ằ","ẳ","ẵ","ặ","ấ","ầ","ẩ","ẫ","ậ","â",
        "é","è","ẻ","ẽ","ẹ","ế","ề","ể","ễ","ệ","ê","ó","ò","ỏ","õ","ọ","ố","ồ","ổ","ỗ","ộ","ơ","ô",
        "ờ","ớ","ở","ỡ","ợ","ú","ù","ủ","ũ","ụ","ư","ứ","ừ","ử","ữ","ự","ý","ỳ","ỷ","ỹ","ỵ", "đ",
        "í","ì","ỉ","ĩ","ị","Á","À","Ả","Ã","Ạ","Ă","Ắ","Ằ","Ẳ","Ẵ","Ặ","Â","Ấ","Ầ",
        "Ẩ","Ẫ","Ậ","É","È","Ẻ","Ẽ","Ẹ","Ê","Ế","Ề","Ể","Ễ","Ệ","Ó","Ò","Ỏ","Õ",
        "Ọ","Ô","Ố","Ồ","Ổ","Ỗ","Ộ","Ơ","Ờ","Ớ","Ở","Ỡ","Ợ","Ú","Ù","Ủ","Ũ","Ụ","Ư",
        "Ứ","Ừ","Ử","Ữ","Ự","Ý","Ỳ","Ỷ","Ỹ","Ỵ","Í","Ì","Ỉ","Ĩ","Ị","Đ");
        $khongDau = array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e","o","o","o","o","o","o","o","o","o","o","o","o",
        "o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","d",
        "i","i","i","i","i","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
        "a","a","a","e","e","e","e","e","e","e","e","e","e","e","o","o","o","o",
        "o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u",
        "u","u","u","u","u","y","y","y","y","y","i","i","i","i","i","d");
        $str = str_replace($coDau,$khongDau, $str);
        $str = trim(preg_replace("/\\s+/"," ", $str));
        $str = preg_replace("/[^a-zA-Z0-9 \-\.]/", "", $str);
        $str = strtolower($str);
        return str_replace(" ", '-', $str);
    }

    public static function get_extension($imagetype)
    {
        if(empty($imagetype)) return false;
        switch ($imagetype) {
            case 'image/bmp': return '.bmp';
            case 'image/apng': return '.apng';
            case 'image/avif': return '.avif';
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            case 'image/svg+xml': return '.svg';
            case 'image/webp': return '.webp';
            case 'image/x-icon': return '.ico';
            case 'image/tiff': return '.tif';
            case 'image/pipeg': return '.jfif';
            case 'image/ief': return '.ief';
            case 'image/cis-cod': return '.cod';
            case 'image/x-cmu-raster': return '.ras';
            case 'image/x-cmx': return '.cmx';
            default:
                break;
        }
    }

    // định dạng ngày tháng năm -> năm tháng ngáy
    public static function convertDMYtoYMD($date)
    {
        if ($date == '') {
            return null;
        } else {
            $arr = explode('/', $date);

            if(count($arr) == 1) return date("Y-m").'-'.$arr[0];
            else if(count($arr) == 2) return date("Y")."-{$arr[1]}-{$arr[0]}";
            else {
                $arr = array_reverse($arr);
                return implode('-', $arr);
            }
        }
    }
}

?>