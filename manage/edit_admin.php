<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "admin";
$submenu = "editadmin";
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
echo "/css/style-responsive.css\" rel=\"stylesheet\" />\r\n\t\r\n\t <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->\r\n    <!--[if lt IE 9]>\r\n      <script src=\"";
echo $cf["manage_themes"];
echo "/js/html5shiv.js\"></script>\r\n      <script src=\"";
echo $cf["manage_themes"];
echo "/js/respond.min.js\"></script>\r\n    <![endif]-->\r\n\t\r\n\t<!-- -->\r\n\t<script src=\"";
echo $cf["manage_themes"];
echo "/layer/jquery-1.9.1.min.js\"></script>\r\n<script src=\"";
echo $cf["manage_themes"];
echo "/layer/layer.js\"></script>\r\n\r\n<script charset=\"utf-8\" src=\"editor/kindeditor.js\"></script>
<script charset=\"utf-8\" src=\"editor/lang/zh_CN.js\"></script>
<script charset=\"utf-8\" src=\"editor/lang/en.js\"></script>
<script>KindEditor.ready(function(K) {
    K.create('#suyuan', {
        uploadJson : 'editor/php/upload_json.php',
        fileManagerJson : 'editor/php/file_manager_json.php',
        filterMode: false,
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
    K('#uppic').click(function() {\r\n\t\t\t\t\teditor.loadPlugin('image', function() {\r\n\t\t\t\t\t\teditor.plugin.imageDialog({\r\n\t\t\t\t\t\t\timageUrl : K('#admin_pic').val(),\r\n\t\t\t\t\t\t\tclickFn : function(url, title, width, height, border, align) {\r\n\t\t\t\t\t\t\t\tK('#admin_pic').val(url);\r\n\t\t\t\t\t\t\t\teditor.hideDialog();\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t});\r\n\t\t\t\t\t});\r\n\t\t\t\t});\r\n\t\t\t\t\t\t\t\r\n\t\t\t});\r\n\t\t</script>\r\n</head>\r\n\r\n  <body>\r\n  <section id=\"container\" >\r\n      <!--header start-->\r\n     ";
require "head.php";
echo "      <!--header end-->\r\n      <!--sidebar start-->\r\n       ";
require "left.php";
echo "      <!--sidebar end-->\r\n\t \r\n  <section id=\"main-content\">\r\n  <section class=\"wrapper\">\r\n   \r\n \r\n  ";

if ($act == "edit_admin") {
    $id = $_GET["id"];
    $sql = "select * from tgs_admin where id=" . $id . " limit 1";
    $res = mysql_query($sql);
    $arr = mysql_fetch_array($res);
    $username = $arr["username"];
    $oldpw = $arr["password"];
    $glyxm = $arr["glyxm"];
    $t_glqx = $arr["glqx"];
    $admin_pic = $arr["admin_pic"];
    echo "\r\n   <!--page start -->\r\n     <div class=\"row\">\r\n\t<div class=\"col-lg-12\">\r\n         <section class=\"panel\">\r\n            <header class=\"panel-heading\">\r\n            <h3> " . lang('admin_edit') . "</h3>\r\n            </header>\r\n           <div class=\"panel-body\">\r\n                             \r\n\t\t\t\t\t\t\t   <form class=\"form-horizontal tasi-form\" enctype=\"multipart/form-data\"  name=\"form1\" method=\"post\" action=\"?act=save_edit_admin\">\r\n                             \r\n\t\t\t\t\t\t\t\t <input type=\"hidden\" name=\"id\" id=\"id\" value=\"";
    echo $id;
    echo "\" />\r\n\t\t\t\t\t\t         <input type=\"hidden\" name=\"oldpw\"  value=\"";
    echo $oldpw;
    echo "\" />\r\n\t\t\t\t\t\t\t\t   <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('admin_user') . "</label>\r\n                                      <div class=\"col-sm-3\">\r\n\t\t\t\t\t\t\t\t\t  \r\n                                          <input type=\"text\" class=\"form-control\"  name=\"username\"   style=\"width:200px;\"  value=\"";
    echo $username;
    echo "\"    readonly >\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('admin_user_des') . "                                        </p></div>\r\n                                  </div>\r\n\t\t\t\t\t\t\t\t  \t\t\r\n\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('admin_password') . "</label>\r\n                                      <div class=\"col-sm-3\">\r\n\t\t\t\t\t\t\t\t\t  \r\n                                          <input type=\"text\" class=\"form-control\" name=\"password\"   style=\"width:200px;\"     >\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-7\"> <p class=\"help-block\">" . lang('admin_password_des_2') . "                                         </p></div>\r\n                                  </div>\r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('admin_name') . "</label>\r\n                                      <div class=\"col-sm-2\">\r\n\t\t\t\t\t\t\t\t\t  \r\n                                          <input type=\"text\" class=\"form-control\" name=\"glyxm\"   style=\"width:160px;\"   value=\"";
    echo $glyxm;
    echo "\"    placeholder=\"" . lang('admin_name_des') . "\"  required >\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-8\"> <p class=\"help-block\">" . lang('admin_name_des') . "                                        </p></div>\r\n                                  </div>\r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t    <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('head_admin_avatar') . "</label>\r\n                                      <div class=\"col-sm-5\">\r\n\t\t\t\t\t\t\t\t\t  \r\n                                          <input type=\"text\" class=\"form-control\" name=\"admin_pic\"   id=\"admin_pic\"  style=\"width:420px;\"  value=\"";
    echo $admin_pic;
    echo "\"    placeholder=\"" . lang('admin_click_alt') . "\"   >\r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-5\">  <input type=\"button\" id=\"uppic\" class=\"btn btn-success\" value=\"" . lang('admin_upload_button') . "\" /> </div>\r\n                                  </div>\r\n\t\t\t\t\t\t\t\t  ";

    if (2 <= $glqx) {
        echo "\t\t\t\t\t\t\t\t\t  <input type=\"hidden\" class=\"form-control\"  name=\"glqx\"   style=\"width:200px;\"  value=\"";
        echo $t_glqx;
        echo "\"    readonly >\r\n\t\t\t\t\t\t\t\t\t    ";
    } else {
        echo "\t\t\t\t\t\t\t\t   <div class=\"form-group\">\r\n                                      <label class=\"col-sm-2 col-sm-2 control-label\">" . lang('admin_power') . "</label>\r\n                                      <div class=\"col-sm-2\">\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t\t \r\n\t\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t\t\r\n                                        <select name=\"glqx\" class=\"form-control\"  style=\"width:160px;\" >\r\n  \r\n\t<option value=\"1\" ";

        if ($t_glqx == 1) {
            echo "selected";
        }

        echo "  >" . lang('head_admin') . "</option>\r\n\t<option value=\"2\"  ";

        if ($t_glqx == 2) {
            echo "selected";
        }

        echo ">" . lang('head_operator') . "</option>\r\n\t<option value=\"3\" ";

        if ($t_glqx == 3) {
            echo "selected";
        }

        echo " >" . lang('head_messenger') . "</option>\r\n    </select>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t   \r\n                                      </div>\r\n\t\t\t\t\t\t\t\t\t   <div class=\"col-sm-8\"> <p class=\"help-block\">" . lang('admin_power_des') . "                                        </p></div>\r\n                                  </div>\r\n\t\t\t\t\t\t\t\t  \t\t\t\r\n\t\t\t\t\t\t\t\t   ";
    }

    echo "\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t  <div class=\"form-group\">\r\n                                          <div class=\"col-lg-offset-2 col-lg-10\">\r\n                                              <button class=\"btn btn-danger\" type=\"submit\"><i class=\" icon-ok\"></i> " . lang('base_button_update') . "</button>\r\n                                             \r\n                                          </div>\r\n                                 </div>\r\n\t\t\t\t\t\t\t\t\t  \r\n\t\t\t  </form>      \r\n            </div>\r\n\t\t\t\t\t\t\t\r\n                             \r\n     </section>\r\n\t</div>\r\n\t</div>\r\n\t<!--page end -->\r\n\t";
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
echo "/js/form-component.js\"></script>\r\n  \r\n\r\n ";

if ($act == "save_edit_admin") {
    if (3 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "',{icon:0,time: 3000,shift: -1},function(){location.href='list_admin.php';});</script>";
        exit();
    }

    $id = $_POST["id"];
    $username = trim($_POST["username"]);

    if ($_POST["password"] == "") {
        $password = $_POST["oldpw"];
    } else {
        $password = md5($_POST["password"]);
    }

    $admin_pic = $_POST["admin_pic"];
    $glyxm = $_POST["glyxm"];
    $t_glqx = $_POST["glqx"];
    if ((2 <= $glqx) && ($username != $_SESSION[Adminname])) {
        echo "<script language='javascript'>layer.msg('" . lang('admin_cannot_update') . "',{icon:0,time: 3000,shift: -1},function(){location.href='list_admin.php';});</script>";
        exit();
    }

    if (!$id) {
        echo "<script language='javascript'>layer.msg('" . lang('base_edit_failed') . "');</script>";
        exit();
    }

    if ($username == "") {
        echo "<script language='javascript'>layer.msg('" . lang('admin_lack_user') . "');</script>";
        exit();
    }

    $sql = "update tgs_admin set  username='$username',admin_pic='$admin_pic',password='$password',glyxm='$glyxm',glqx='$t_glqx'  where id=$id  limit 1";
    mysql_query($sql);
    echo "<script language='javascript'>layer.msg('" . lang('sys_update_success') . "',{icon:1,time: 3000,shift: -1}, function ()
    {
        location . href = 'list_admin.php';
    });</script > ";
}

echo " \r\n </body > \r\n</html > \r\n";

