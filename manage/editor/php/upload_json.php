<?php
function alert($msg)
{
    header("Content-type: text/html; charset=UTF-8");
    $json = new Services_JSON();
    echo $json->encode(["error" => 1, "message" => $msg]);
    exit();
}

require_once("../../../data/conn.php");////数据库连接
require_once("../../../data/function.php");////数据库连接
$conn = @mysql_connect($db_host, $db_user, $db_pwd);
mysql_query('SET NAMES utf8', $conn);
mysql_query("SET CHARACTER_SET_CLIENT='utf8'", $conn);
mysql_query("SET CHARACTER_SET_RESULTS='utf8'", $conn);
if (!$conn) {
    die('DB connect error !');
}
mysql_select_db($db_name, $conn);
get_site_config();

require_once "JSON.php";
$php_path = dirname(__FILE__) . "/";
$php_url = dirname($_SERVER["PHP_SELF"]) . "/";
$save_path = $php_path . "../../../upload/";
$save_url = $php_url . "../../../upload/";
$ext_arr = [
    "image" => ["gif", "jpg", "jpeg", "png", "bmp"],
    "flash" => ["swf", "flv"],
    "media" => ["swf", "flv", "mp3", "wav", "wma", "wmv", "mid", "avi", "mpg", "asf", "rm", "rmvb"],
    "file"  => ["doc", "docx", "xls", "xlsx", "ppt", "htm", "html", "txt", "zip", "rar", "gz", "bz2"],
];
$max_size = 1000000;
$save_path = realpath($save_path) . "/";

if (!empty($_FILES["imgFile"]["error"])) {
    switch ($_FILES["imgFile"]["error"]) {
        case UPLOAD_ERR_INI_SIZE:
            $error = lang('UPLOAD_ERR_INI_SIZE');
            break;

        case UPLOAD_ERR_FORM_SIZE:
            $error = lang('UPLOAD_ERR_FORM_SIZE');
            break;

        case UPLOAD_ERR_PARTIAL:
            $error = lang('UPLOAD_ERR_PARTIAL');
            break;

        case UPLOAD_ERR_NO_FILE:
            $error = lang('UPLOAD_ERR_NO_FILE');
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            $error = lang('UPLOAD_ERR_NO_TMP_DIR');
            break;

        case UPLOAD_ERR_CANT_WRITE:
            $error = lang('UPLOAD_ERR_CANT_WRITE');
            break;

        case UPLOAD_ERR_EXTENSION:
            $error = lang('UPLOAD_ERR_EXTENSION');
            break;

        default:
            $error = lang('UPLOAD_ERR_UNKNOWN');
    }

    alert($error);
}

if (empty($_FILES) === false) {
    $file_name = $_FILES["imgFile"]["name"];
    $tmp_name = $_FILES["imgFile"]["tmp_name"];
    $file_size = $_FILES["imgFile"]["size"];

    if (!$file_name) {
        alert(lang('import_file_select_error'));
    }

    if (@is_dir($save_path) === false) {
        alert(lang('UPLOAD_ERR_NO_TMP_DIR'));
    }

    if (@is_writable($save_path) === false) {
        alert(lang('import_file_power_error'));
    }

    if (@is_uploaded_file($tmp_name) === false) {
        alert(lang('UPLOAD_ERR_FILE'));
    }

    if ($max_size < $file_size) {
        alert(lang('import_file_size_error'));
    }

    $dir_name = (empty($_GET["dir"]) ? "image" : trim($_GET["dir"]));

    if (empty($ext_arr[$dir_name])) {
        alert(lang('UPLOAD_ERR_DIRECTORY'));
    }

    $temp_arr = explode(".", $file_name);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);

    if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
        alert(lang('import_file_format_error')."\n".lang('UPLOAD_ALLOW_FORMAT') . implode(",", $ext_arr[$dir_name]));
    }

    if ($dir_name !== "") {
        $save_path .= $dir_name . "/";
        $save_url .= $dir_name . "/";

        if (!file_exists($save_path)) {
            mkdir($save_path);
        }
    }

    $ymd = date("Ymd");
    $save_path .= $ymd . "/";
    $save_url .= $ymd . "/";

    if (!file_exists($save_path)) {
        mkdir($save_path);
    }

    $new_file_name = date("YmdHis") . "_" . rand(10000, 99999) . "." . $file_ext;
    $file_path = $save_path . $new_file_name;

    if (move_uploaded_file($tmp_name, $file_path) === false) {
        alert(lang('UPLOAD_ERR_FILE'));
    }

    @chmod($file_path, 420);
    $file_url = $save_url . $new_file_name;
    header("Content-type: text/html; charset=UTF-8");
    $json = new Services_JSON();
    echo $json->encode(["error" => 0, "url" => $file_url]);
    exit();
}

