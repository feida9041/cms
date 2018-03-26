<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "sys";
$submenu = "sysset";
$act = $_GET["act"];
echo "<!DOCTYPE html>\r\n<html lang=\"zh_cn\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n\t <meta name=\"renderer\" content=\"webkit|ie-comp|ie-stand\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"";
echo $cf["page_desc"];
echo "\">\r\n    <meta name=\"author\" content=\"Mosaddek\">\r\n    <meta name=\"keyword\" content=\"";
echo $cf["page_keywords"];
echo "\">\r\n   \r\n    <title>";
echo $cf["site_name"];
echo "</title>\r\n\t\r\n\t <!-- Bootstrap core CSS -->\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap.min.css\" rel=\"stylesheet\">\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap-reset.css\" rel=\"stylesheet\">\r\n    <!--external css-->\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/assets/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />\r\n\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-datepicker/css/datepicker.css\" />\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-colorpicker/css/colorpicker.css\" />\r\n    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-daterangepicker/daterangepicker.css\" />\r\n\r\n    <!-- Custom styles for this template -->\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/style.css\" rel=\"stylesheet\">\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/style-responsive.css\" rel=\"stylesheet\" />\r\n\t\r\n\t\r\n\t\r\n\t<!--弹窗JS -->\r\n\t<script src=\"";
echo $cf["manage_themes"];
echo "/layer/jquery-1.9.1.min.js\"></script>\r\n<script src=\"";
echo $cf["manage_themes"];
echo "/layer/layer.js\"></script><script charset=\"utf-8\" src=\"editor/kindeditor.js\"></script>\r\n<script charset=\"utf-8\" src=\"editor/lang/zh_CN.js\"></script>\r\n\r\n</head>\r\n  <body>\r\n  <div class=\"sqbox\">\r\n   ";

echo " \r\n</div>\r\n  <section id=\"container\" >\r\n      <!--header start-->\r\n     ";
require "head.php";
echo "      <!--header end-->\r\n      <!--sidebar start-->\r\n       ";
require "left.php";

echo "      <!--sidebar end-->\r\n\t \r\n  <section id=\"main-content\">\r\n  <section class=\"wrapper\">\r\n \r\n   <!--add start -->\r\n  \r\n     <div class=\"row\">\r\n\t<div class=\"col-lg-12\">";
/*
<div class=\"alert alert-success fade in\"><button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\"><i class=\"icon-remove\"></i></button>
" . lang('sys_set_des') . "<span onclick=\"wxhelp()\" class=\"ew80_ontext\">【" . lang('sys_set_window') . "】</span>\r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t
<script>function wxhelp(){
layer.open({
type: 1,
title: '" . lang('sys_set_course_title') . "',
skin: 'layui-layer-rim', //加上边框
area: ['600px', '200px'], //宽高
content: \"<div style='padding:10px;'>" . lang('sys_set_course') . "</div>\"\r\n}); }</script></div>
*/
echo "<section class=\"panel\">\r\n<header class=\"panel-heading\">
      <h3> " . lang('sys_config_title') . "</h3></header><div class=\"panel-body\"><form class=\"form-horizontal tasi-form\"  enctype=\"multipart/form-data\"  name=\"form1\" method=\"post\" action=\"?act=save_sys\"><div class=\"form-group\">
      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_site_name') . "</label><div class=\"col-sm-3\">
      <input type=\"text\" class=\"form-control\"  name=\"cf[site_name]\"  value=\"";
echo $cf["site_name"];
echo "\"  required  >\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('sys_site_name') . "</p></div></div><div class=\"form-group\">\r\n                                      
<label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_site_url') . "</label><div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\"  class=\" form-control\"   name=\"cf[site_url]\" value=\"";
echo $cf["site_url"];
echo "\"    style=\"width:100%;\" ></div><div class=\"col-sm-6\"> <p class=\"help-block red \">" . lang('sys_site_url_des') . "</p></div></div>";

echo "<div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_company_name') . "</label>
<div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\"  class=\" form-control\"   name=\"cf[com_name]\" value=\"";
echo $cf["com_name"];
echo "\"    style=\"width:100%;\" ></div><div class=\"col-sm-6\"> <p class=\"help-block red \">" . lang('sys_company_des') . "</p> </div></div>";
echo"<div class=\"form-group\">
<label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_keyword') . "</label>
<div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\"  class=\" form-control\"   name=\"cf[page_keywords]\"   value=\"";
echo $cf["page_keywords"];
echo "\"    style=\"width:100%;\" ></div><div class=\"col-sm-6\"> <p class=\"help-block  \">" . lang('sys_keyword_des') . "</p> </div></div>";

echo "<div class=\"form-group\">
<label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_describe') . "</label>\r\n                                      <div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\"  class=\" form-control\"   name=\"cf[page_desc]\"   value=\"";
echo $cf["page_desc"] . "\"    style=\"width:100%;\" ></div><div class=\"col-sm-6\"> <p class=\"help-block  \">" . lang('sys_describe_des') . "</p> </div></div>";
echo "<div class=\"form-group\">
<label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_page_num') . "</label><div class=\"col-sm-2\">
<input type=\"text\"  class=\" form-control\"   name=\"cf[list_num]\" id=\"list_num\" value=\"";
echo $cf["list_num"];
echo "\" style=\"width:100px;;\" ></div><div class=\"col-sm-8\"> <p class=\"help-block  \">" . lang('sys_page_num_des') . "</p></div></div>";

/*
echo "<div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_warning') . "</label><div class=\"col-sm-2\">
<input type=\"text\"  class=\" form-control \"   name=\"cf[fwm_max_so]\" id=\"list_num\" value=\"";
echo $cf["fwm_max_so"];
echo "\" style=\"width:100px;;\" ></div>";
echo "<div class=\"col-sm-8\"><p class=\"help-block  red \">" . lang('sys_warning_des') . "</p></div></div>";
*/
/*
echo "<div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\"> " . lang('sys_verifiy') . "</label>
<div class=\"col-sm-2\"><input type=\"radio\" name=\"cf[yzm_status]\" value=\"1\"  ";
if ($cf["yzm_status"] == 1) {
    echo "checked='checked'";
}
echo "/>" . lang('base_enable') . "<input type=\"radio\" name=\"cf[yzm_status]\" value=\"0\" ";
if ($cf["yzm_status"] == 0) {
    echo "checked='checked'";
}
echo " />" . lang('base_disable') . "</div><div class=\"col-sm-8\"> <p class=\"help-block  \"> ";
$arr1_gd_info = gd_info();

if (!$arr1_gd_info["PNG Support"]) {
    echo "(<span class='red'>" . lang('sys_PNG_support') . "</span>)";
}
echo lang('sys_verifiy_des') . "</p> </div></div>";

echo "<div class=\"form-group\">
    <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('security_tmp') . "</label>
    <div class=\"col-sm-2\">
        <select class=\" form-control\" name=\"cf[site_themes]\" id=\"s1\" >";
$ew80 = mysql_query("SELECT * FROM  tgs_moban  where  mb_lx='fw'  order by id desc ");
while ($row = mysql_fetch_array($ew80)) {
    $mb_en = $row['mb_en'];
    $mb_cn = $row['mb_cn'];
    echo "\t<option value=\"";
    echo $mb_en;
    echo "\" ";

    if ($cf["site_themes"] == $mb_en) {
        echo "selected";
    }

    echo " >";
    echo $mb_cn;
    echo "</option>";
}
echo "</select>
    </div>
    <div class=\"col-sm-8\"><p class=\"help-block  \">" . lang('security_tmp_des') . "</p></div>
</div>";

echo"<div class=\"form-group\">
<label class=\"col-sm-2 col-sm-2 control-label\">" . lang('security_search') . "</label>
<div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\"  class=\" form-control\"   name=\"cf[notices]\"   value=\"";
echo $cf["notices"];
echo "\"    style=\"width:100%;\" ></div><div class=\"col-sm-6\"> <p class=\"help-block  \"></p> </div></div>";
*/
echo "<div class=\"form-group\">
    <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('sys_language') . "</label>
    <div class=\"col-sm-2\">
        <select class=\" form-control\" name=\"cf[lang]\" id=\"lang\" style=\"width:100px;\">
        ";
foreach (Lang::$lang_file as $k => $v) {
    echo '<option value="' . $k . '" ';
    if ($cf['lang'] == $k) {
        echo 'selected="selected"';
    }
    echo ' >' . $v['label'] . '</option>';
}
echo "</select>
    </div>
    <div class=\"col-sm-8\"><p class=\"help-block  \">" . lang('sys_default') . "</p></div>
</div>";
echo "<div class=\"form-group\"><div class=\"col-lg-offset-2 col-lg-10\">
<button class=\"btn btn-danger\" type=\"submit\"><i class=\" icon-ok\"></i> " . lang('base_button_update') . "</button>
</div></div></form></div></section>\r\n\t</div>\r\n\t</div>\r\n\t<!--add end -->\r\n\t\r\n   </section>\r\n   </section>\r\n   </section><script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.js\"></script>\r\n   <!-- js placed at the end of the document so the pages load faster --> \r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/bootstrap.min.js\"></script>\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.scrollTo.min.js\"></script>\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.nicescroll.js\" type=\"text/javascript\"></script>\r\n\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery-ui-1.9.2.custom.min.js\"></script>\r\n    <script class=\"include\" type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.dcjqaccordion.2.7.js\"></script>\r\n\r\n  <!--custom switch-->\r\n  <script src=\"";
echo $cf["manage_themes"];
echo "/js/bootstrap-switch.js\"></script>\r\n  <!--custom tagsinput-->\r\n  <script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.tagsinput.js\"></script>\r\n  <!--custom checkbox & radio-->\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/js/ga.js\"></script>\r\n\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-datepicker/js/bootstrap-datepicker.js\"></script>\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-daterangepicker/date.js\"></script>\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-daterangepicker/daterangepicker.js\"></script>\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js\"></script>\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/ckeditor/ckeditor.js\"></script>\r\n\r\n  <script type=\"text/javascript\" src=\"";
echo $cf["manage_themes"];
echo "/assets/bootstrap-inputmask/bootstrap-inputmask.min.js\"></script>\r\n  <script src=\"";
echo $cf["manage_themes"];
echo "/js/respond.min.js\" ></script>\r\n\r\n\r\n  <!--common script for all pages-->\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/common-scripts.js\"></script>\r\n\r\n  <!--script for this page-->\r\n  <script src=\"";
echo $cf["manage_themes"];
echo "/js/form-component.js\"></script>\r\n\r\n";

if ($act == "save_sys") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "');</script>";
        exit();
    }
    $arr = [];
    $sql = "SELECT id, value FROM tgs_config";
    $res = mysql_query($sql);

    while ($row = mysql_fetch_array($res)) {
        $arr[$row["id"]] = $row["value"];
    }

    foreach ($_POST["cf"] as $key => $val) {
        if ($arr[$key] != $val) {
            if (($key == "notices") || ($key == "notice_1") || ($key == "notice_2") || ($key == "notice_3") || ($key == "agents") || ($key == "agent_1") || ($key == "agent_2") || ($key == "agent_3")) {
                $val = strreplace($val);
            }

            if ($key == "site_close_reason") {
                $val = strreplace($val);
            }
            if ($key == 'lang') {
                $sql = "SELECT id FROM tgs_config where code='lang'";
                $res = mysql_query($sql);
                if (!mysql_fetch_array($res)) {
                    $sql = "insert into tgs_config (parentid,code,code_name) VALUES (1,'lang','language')";
                    mysql_query($sql);
                }
            }

            $sql = "update tgs_config set code_value='" . trim($val) . "' where code='" . $key . "' limit 1";
            mysql_query($sql) || exit("err:" . $sql);
        }
    }

    $file_var_list = [];
    $sql = "SELECT * FROM tgs_config WHERE parentid > 0 AND type = 'file'";
    $res = mysql_query($sql);

    while ($row = mysql_fetch_array($res)) {
        $file_var_list[$row["code"]] = $row;
    }

    foreach ($_FILES as $code => $file) {
        if ((isset($file["error"]) && ($file["error"] == 0)) || (!isset($file["error"]) && ($file["tmp_name"] != "none"))) {
            $file_size_max = 307200;
            $accept_overwrite = true;
            $ext_arr = ["gif", "jpg", "png"];
            $add = true;
            $ext = extend($file["name"]);

            if (in_array($ext, $ext_arr) === false) {
                $msg .= $_LANG["page"]["_you_upload_pic_type_"] . "<br />";
            } else if ($file_size_max < $file["size"]) {
                $msg .= $_LANG["page"]["_you_upload_pic_larger_than_300k_"] . "<br />";
            } else if ($code == "site_logo") {
                $date1 = "logo" . date("His");
                $store_dir = "../upload/logo/";
                $newname = $date1 . "." . $ext;

                if (!move_uploaded_file($file["tmp_name"], $store_dir . $newname)) {
                    $msg .= $_LANG["page"]["_Copy_file_failed_"] . "<br />";
                } else {
                    if (file_exists($store_dir . $file_var_list[$code]["value"])) {
                        @unlink($store_dir . $file_var_list[$code]["value"]);
                    }

                    $sql = "UPDATE tgs_config SET code_value = '$newname' WHERE code = '$code' limit 1";
                    mysql_query($sql);
                }
            }
        }
    }

    echo "<script language='javascript'>layer.msg('" . lang('sys_update_success') . "',{icon:1,time: 3000,shift: -1}, function(){location.href='?';});</script>";
    exit();
}

echo "\r\n  </body>\r\n</html>\r\n";

