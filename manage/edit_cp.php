<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "cpgl";
$submenu = "editcp";
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
echo "/css/style-responsive.css\" rel=\"stylesheet\" /><script src=\"";
echo $cf["manage_themes"];
echo "/js/html5shiv.js\"></script>\r\n      <script src=\"";
echo $cf["manage_themes"];
echo "/js/respond.min.js\"></script><script src=\"";
echo $cf["manage_themes"];
echo "/layer/jquery-1.9.1.min.js\"></script>\r\n<script src=\"";
echo $cf["manage_themes"];
echo "/layer/layer.js\"></script>\r\n\r\n<script charset=\"utf-8\" src=\"editor/kindeditor.js\"></script>";
echo "<script charset=\"utf-8\" src=\"editor/lang/zh_CN.js\">
<script charset=\"utf-8\" src=\"editor/lang/en.js\"></script>
<script>
KindEditor.ready(function(K) {
    K.create('#cpms', {
        uploadJson : 'editor/php/upload_json.php',
        fileManagerJson : 'editor/php/file_manager_json.php',
        filterMode: false,
        allowFileManager : true,
        langType: '" . $GLOBALS['cfg']['kindEditor'] . "'
        });
    });
    KindEditor.ready(function(K) {
        var editor = K.editor({
            uploadJson : 'editor/php/upload_json.php',
            fileManagerJson : 'editor/php/file_manager_json.php',
            allowFileManager : true,
            langType: '" . $GLOBALS['cfg']['kindEditor'] . "'
        });
        K('#uppic').click(function() {
        editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
        imageUrl : K('#cppic').val(),
        clickFn : function(url, title, width, height, border, align) {
        K('#cppic').val(url);
        editor.hideDialog();
        }
        });
        });
        });
        K('#uppic2').click(function() {
        editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
        imageUrl : K('#cppic2').val(),
        clickFn : function(url, title, width, height, border, align) {
        K('#cppic2').val(url);
        editor.hideDialog();
        }
        });
        });
        });
        K('#uppic3').click(function() {
        editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
        imageUrl : K('#cppic3').val(),
        clickFn : function(url, title, width, height, border, align) {
        K('#cppic3').val(url);
        editor.hideDialog();
        }
        });
        });
        });
        K('#uppic4').click(function() {
        editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
        imageUrl : K('#cppic4').val(),
        clickFn : function(url, title, width, height, border, align) {
        K('#cppic4').val(url);
        editor.hideDialog();
        }
        });
        });
        });
        });
        </script>
        </head>
        <body>
        <section id=\"container\" >
        ";
require "head.php";
require "left.php";
echo "<section id=\"main-content\"><section class=\"wrapper\">";

if ($act == "edit_pro") {
    $id = $_GET["id"];
    $sql = "select * from tgs_pro where id=" . $id . " limit 1";
    $res = mysql_query($sql);
    $arr = mysql_fetch_array($res);
    $pro_name = $arr["pro_name"];
    $cpbh = $arr["cpbh"];
    $cprice_a = $arr["price_a"];
    $cprice_b = $arr["price_b"];
    $cprice_c = $arr["price_c"];
    $cpms = $arr["cpms"];
    $cppic = $arr["cppic"];
    $cppic2 = $arr["cppic2"];
    $cppic3 = $arr["cppic3"];
    $cppic4 = $arr["cppic4"];
    echo " ";

    if (3 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "');</script>";
        exit();
    }

    echo "<!--易排版引导 -->\r\n  <div class=\"epp\"></div>\r\n   <!--page start -->\r\n     <div class=\"row\">\r\n\t<div class=\"col-lg-12\">\r\n         <section class=\"panel\">\r\n            <header class=\"panel-heading\">\r\n            <h3> " . lang('pro_edit') . "</h3></header><div class=\"panel-body\"><form class=\"form-horizontal tasi-form\" enctype=\"multipart/form-data\"  name=\"form1\" method=\"post\" action=\"?act=save_edit_pro\"><input type=\"hidden\" name=\"id\" id=\"id\" value=\"";
    echo $id;
    echo "\" /><div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_name') . "</label><div class=\"col-sm-3\"><input type=\"text\" class=\"form-control\" name=\"pro_name\"  value=\"";
    echo $pro_name;
    echo "\"   ></div><div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('pro_name_des') . "</p></div></div><div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_num') . "</label><div class=\"col-sm-3\"><input type=\"text\" class=\"form-control\" name=\"cpbh\"   value=\"";
    echo $cpbh;
    echo "\" ></div><div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('pro_num_des') . "</p></div></div><div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_price_a') . "</label><div class=\"col-sm-3\"><input type=\"text\" class=\"form-control\" name=\"price_a\"   value=\"";
    echo $cprice_a;
    echo "\" ></div><div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('pro_price_des') . "</p></div></div><div class=\"form-group\"><label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_main_diagram') . "</label><div class=\"col-sm-4\"><input type=\"text\" id=\"cppic\" class=\" form-control\"  name=\"cppic\"  value=\"";
    echo $cppic;
    echo "\" style=\"width:100%;\" >\r\n                                   \r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-2\">  <input type=\"button\" id=\"uppic\" class=\"btn btn-primary\" value=\"" . lang('pro_button_main_diagram') . "\" /> </div>\r\n\t\t\t\t\t\t\t\t\t <div class=\"col-sm-3\"> <p class=\"help-block\">" . lang('pro_main_diagram_des') . "</p> </div>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_pic_1') . "</label>\r\n                                      <div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\" id=\"cppic2\" class=\" form-control\"  name=\"cppic2\"  value=\"";
    echo $cppic2;
    echo "\" style=\"width:100%;\" >\r\n                                   \r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-2\">  <input type=\"button\" id=\"uppic2\" class=\"btn btn-success\" value=\"" . lang('base_select_pic') . "\" /> </div>\r\n\t\t\t\t\t\t\t\t\t <div class=\"col-sm-3\"> <p class=\"help-block\">" . lang('pro_pic_des') . "</p> </div>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_pic_2') . "</label>\r\n                                      <div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\" id=\"cppic3\" class=\" form-control\"  name=\"cppic3\"  value=\"";
    echo $cppic3;
    echo "\" style=\"width:100%;\" >\r\n                                   \r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-2\">  <input type=\"button\" id=\"uppic3\" class=\"btn btn-success\" value=\"" . lang('base_select_pic') . "\" /> </div>\r\n\t\t\t\t\t\t\t\t\t <div class=\"col-sm-3\"> <p class=\"help-block\">" . lang('pro_pic_des') . "</p> </div>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_pic_3') . "</label>\r\n                                      <div class=\"col-sm-4\">\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\" id=\"cppic4\" class=\" form-control\"  name=\"cppic4\"  value=\"";
    echo $cppic4;
    echo "\" style=\"width:100%;\" >\r\n                                   \r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-2\">  <input type=\"button\" id=\"uppic4\" class=\"btn btn-success\" value=\"" . lang('base_select_pic') . "\" /> </div>\r\n\t\t\t\t\t\t\t\t\t <div class=\"col-sm-3\"> <p class=\"help-block\">" . lang('pro_pic_des') . "</p> </div>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t     <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('pro_des') . "</label>\r\n                                      <div class=\"col-sm-10\">\r\n                                     \r\n\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\t<textarea  name=\"cpms\" id=\"cpms\"  style=\"width:680px;height:600px;\">";
    echo $cpms;
    echo "</textarea>\r\n\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t     </div>\r\n\t\t\t\t\t\t\t\t  \t  \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t\t   \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t  <div class=\"form-group\">\r\n                                          <div class=\"col-lg-offset-2 col-lg-10\">\r\n                                              <button class=\"btn btn-danger\" type=\"submit\"><i class=\" icon-ok\"></i> " . lang('pro_edit_submit') . "</button>\r\n                                             \r\n                                          </div>\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t  </form>      \r\n                                 </div>\r\n                             \r\n     </section>\r\n\t</div>\r\n\t</div>\r\n\t<!--page end -->\r\n\t";
}

echo "\t\r\n   </section>\r\n   </section>\r\n   </section>          \r\n  \r\n\r\n   <!-- js placed at the end of the document so the pages load faster -->\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/jquery.js\"></script>\r\n    <script src=\"";
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
echo "/js/form-component.js\"></script>";

if ($act == "save_edit_pro") {
    if (3 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "',{icon:2,time: -1,shift: -1});</script>";
        exit();
    }

    $id = $_POST["id"];
    $pro_name = trim($_POST["pro_name"]);
    $cpbh = $_POST["cpbh"];
    $cprice_a = trim($_POST["price_a"]);
    $cprice_b = trim($_POST["price_b"]);
    $cprice_c = trim($_POST["price_c"]);
    $cpms = $_POST["cpms"];
    $cppic = trim($_POST["cppic"]);
    $cppic2 = trim($_POST["cppic2"]);
    $cppic3 = trim($_POST["cppic3"]);
    $cppic4 = trim($_POST["cppic4"]);

    if (!$id) {
        echo "<script language='javascript'>layer.msg('" . lang('base_edit_failed') . "');</script>";
        exit();
    }

    if ($pro_name == "") {
        echo "<script language='javascript'>layer.msg('" . lang('pro_lack_name') . "');</script>";
        exit();
    }

    if ($cpms == "") {
        echo "<script language='javascript'>layer.msg('" . lang('pro_lack_des') . "');</script>";
        exit();
    }

    $sql = "select * from tgs_pro where cpbh='" . $cpbh . "' limit 1";
    $res = mysql_query($sql);
    $arr = mysql_fetch_array($res);

    if (1 < mysql_num_rows($res)) {
        echo "<script language='javascript'>layer.msg('" . lang('pro_num_repeat') . "', function(){});</script>";
        exit();
    }

    $sql = "update tgs_pro set  pro_name='$pro_name',cpbh='$cpbh',price_a='$cprice_a',price_b='$cprice_b',price_c='$cprice_c',cppic='$cppic',cpms='$cpms',cppic2='$cppic2',cppic3='$cppic3',cppic4='$cppic4'  where id=$id  limit 1";
    mysql_query($sql);
    echo "<script language='javascript'>layer.msg('" . lang('pro_edit_success') . "',{icon:1,time: 1000,shift: -1}, function(){location.href='list_cp.php';});</script>";
}

echo "</body></html>";

