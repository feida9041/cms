<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "admin";
$submenu = "listadmin";
$act = $_GET["act"];
echo " <meta charset=\"utf-8\">\r\n\t <meta name=\"renderer\" content=\"webkit|ie-comp|ie-stand\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"";
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
echo "/layer/layer.js\"></script>\r\n\r\n<script charset=\"utf-8\" src=\"editor/kindeditor.js\"></script>\r\n<script charset=\"utf-8\" src=\"editor/lang/zh_CN.js\"></script>\r\n<script>\r\n//  \r\nKindEditor.ready(function(K) {\r\n        K.create('#cpms', {\r\n                uploadJson : 'editor/php/upload_json.php',\r\n                fileManagerJson : 'editor/php/file_manager_json.php',\r\n\t\t\t\tfilterMode: false\r\n        });\r\n});\r\n\t\t</script>\r\n<script>\r\n\t\t\tKindEditor.ready(function(K) {\r\n\t\t\t\tvar editor = K.editor({\r\n\t\t\t\tuploadJson : 'editor/php/upload_json.php',\r\n                fileManagerJson : 'editor/php/file_manager_json.php',\r\n                allowFileManager : true\r\n\t\t\t\t});\r\n\t\t\t\tK('#uppic').click(function() {\r\n\t\t\t\t\teditor.loadPlugin('image', function() {\r\n\t\t\t\t\t\teditor.plugin.imageDialog({\r\n\t\t\t\t\t\t\timageUrl : K('#cppic').val(),\r\n\t\t\t\t\t\t\tclickFn : function(url, title, width, height, border, align) {\r\n\t\t\t\t\t\t\t\tK('#cppic').val(url);\r\n\t\t\t\t\t\t\t\teditor.hideDialog();\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t});\r\n\t\t\t\t\t});\r\n\t\t\t\t});\r\n\t\t\t\t\t\t\t\r\n\t\t\t});\r\n\t\t</script>\r\n\r\n</head>\r\n\r\n  <body>\r\n  <section id=\"container\" >\r\n      <!--header start-->\r\n     ";
require "head.php";
echo "      <!--header end-->\r\n      <!--sidebar start-->\r\n       ";
require "left.php";
echo "      <!--sidebar end-->\r\n\t";
$admin_list = [];
$key = trim($_POST["key"]);
$qupz = trim($_REQUEST["qupz"]);
$sql = "select * from tgs_admin where 1";

if ($key != "") {
    $sql .= " and  username like '%$key%'  ||  glyxm  like '%$key%' ";
}

$sql .= " order by id desc";
$result = mysql_query($sql);

if ($qupz == "") {
    $pagesize = $cf["list_num"];
    $qupz = $cf["list_num"];
} else {
    $pagesize = $qupz;
}

$total = mysql_num_rows($result);
$filename = "?keyword=" . $key . "&qupz=" . $qupz . "";
$currpage = intval($_REQUEST["page"]);

if (!is_int($currpage)) {
    $currpage = 1;
}

if (intval($currpage) < 1) {
    $currpage = 1;
}

if ($total < (intval($currpage - 1) * $pagesize)) {
    $currpage = 1;
}

if (($total % $pagesize) == 0) {
    $totalpage = intval($total / $pagesize);
} else {
    $totalpage = intval($total / $pagesize) + 1;
}

if (($total != 0) && (1 < $currpage)) {
    mysql_data_seek($result, ($currpage - 1) * $pagesize);
}

$i = 0;

while ($arr = mysql_fetch_array($result)) {
    $i++;

    if ($pagesize < $i) {
        break;
    }

    $admin_list[] = $arr;
}

echo " \r\n <SCRIPT language=\"javascript\">\r\n\r\nfunction CheckAll(form)\r\n\r\n  {\r\n\r\n  for (var i=0;i<form.elements.length;i++)\r\n\r\n    {\r\n\r\n    var e = form.elements[i];\r\n\r\n    if (e.Name != \"chkAll\"&&e.disabled==false)\r\n\r\n       e.checked = form.chkAll.checked;\r\n\r\n    }\r\n\r\n  }\r\n\r\nfunction CheckAll2(form)\r\n\r\n  {\r\n\r\n  for (var i=0;i<form.elements.length;i++)\r\n\r\n    {\r\n\r\n    var e = form.elements[i];\r\n\r\n    if (e.Name != \"chkAll2\"&&e.disabled==false)\r\n\r\n       e.checked = form.chkAll2.checked;\r\n\r\n    }\r\n\r\n  }  \r\n\r\n  \r\n\r\nfunction ConfirmDel()\r\n{\r\n\tif(document.myform.Action.value==\"del_all_admin\")\r\n\t{\r\n\t\tdocument.myform.action=\"?act=del_all_admin\";\r\n\t\tif(confirm(\"" . lang('admin_delete_confirm') . "\"))\r\n\t\t    return true;\r\n\t\telse\r\n\t\t\treturn false;\r\n\t}\t\r\n}\r\n\r\n\r\n\r\n</SCRIPT>\r\n  <section id=\"main-content\">\r\n  <section class=\"wrapper\">\r\n   <!--page start -->\r\n   \r\n    <!-- -->\r\n\t<div class=\"row\">\r\n      <div class=\"col-md-12\">\r\n       <section class=\"panel\">\r\n        <div class=\"panel-body\">\r\n        <form action=\"?\" method=\"post\" name=\"form1\" class=\"form-inline\">\r\n          <div class=\"form-group\">\r\n           <label class=\"sr-only\" >" . lang('base_button_search') . "</label>\r\n           <input name=\"key\" type=\"text\" id=\"key\"  class=\"form-control\"  style=\"width:350px\" placeholder=\"" . lang('admin_user') . "\"  >\r\n            </div>\r\n         <button type=\"submit\" class=\"btn btn-success\"><i class=\"icon-zoom-in\"></i> " . lang('base_search') . "</button>\r\n\t\t<a href=\"?\"> <button class=\"btn btn-default\"   type=\"button\" ><i class=\"icon-refresh\"></i> " . lang('base_refresh') . "</button></a> \r\n       </form>\r\n        </div>\r\n       </section>\r\n     </div>\r\n  </div>\r\n  <!-- -->\r\n   <form method=\"post\" name=\"myform\" id=\"myform\" action=\"?\" onSubmit=\"return ConfirmDel();\">\r\n     <div class=\"row\">\r\n\t<div class=\"col-md-12\">\r\n         <section class=\"panel\">\r\n            <header class=\"panel-heading\">\r\n          <h4>" . lang('left_admin_list') . "</h4>\r\n\t\t    </header>\r\n            
<table class=\"table table-striped table-advance table-hover\"><thead><tr>
<th><INPUT TYPE=\"checkbox\" NAME=\"chkAll\" id=\"chkAll\" title=\"" . lang('base_select_all') . "\"  onclick=\"CheckAll(this.form)\"></th><th >#</th>
<th>" . lang('head_admin_avatar') . "</th>\r\n                  <th>" . lang('admin_name') . "</th>\r\n\t\t\t\t  <th>" . lang('admin_power') . "</th>\r\n                  <th>" . lang('admin_name') . "</th>\r\n\t\t\t\t  <th>" . lang('admin_login_times') . "</th><th>" . lang('base_operate') . "</th></tr></thead><tbody>";

for ($i = 0; $i < count($admin_list); $i++) {
    echo "                <tr>\r\n\t\t\t  <td>";

    if ($admin_list[$i]["id"] == 1) {
        echo "<i class='icon-lock  red'></i>";
        echo " ";
    } else {
        echo "<input name=\"chk[]\" type=\"checkbox\" id=\"chk[]\" value=\"";
        echo $admin_list[$i]["id"];
        echo "\"  >";
    }

    echo "</td>\r\n                  <td>";
    echo $admin_list[$i]["id"];
    echo "</td>\r\n                  <td >\r\n\t\t\t\t  <div class=\"user-heading alt\">\r\n\t\t\t  <a><img src=\"";

    if ($admin_list[$i]["admin_pic"] == "") {
        echo "/upload/image/noface.jpg";
    } else {
        echo $admin_list[$i]["admin_pic"];
    }

    echo "\" alt=\"" . lang('head_admin_avatar') . "\"  style=\"width:50px; height:50px;\" ></a> \r\n</div>                  </td>\r\n                  <td ><a href=\"edit_admin.php?act=edit_admin&id=";
    echo $admin_list[$i]["id"];
    echo "\" title=\"" . lang('base_edit') . "\">";
    echo $admin_list[$i]["username"];
    echo "</a></td>\r\n\t\t\t\t    <td >\r\n\t\t\t\t\t";
    $t_glqx = $admin_list[$i]["glqx"];

    switch ($t_glqx) {
        case 1:
            echo ' ' . lang('head_admin') . ' ';
            break;

        case 2:
            echo ' ' . lang('head_operator') . ' ';
            break;

        case 3:
            echo ' ' . lang('head_messenger') . ' ';
            break;

        default:
            echo "<script>location.href='index.php' ;</script>";
    }

    echo "\t\t\t\t\t</td>\r\n                  <td>";
    echo $admin_list[$i]["glyxm"];
    echo "</td>\r\n\t\t\t\t  <td>";
    echo $admin_list[$i]["logins"];
    echo "</td>\r\n                  <td><a href=\"edit_admin.php?act=edit_admin&id=";
    echo $admin_list[$i]["id"];
    echo "\" class=\"label label-success label-mini\" ><i class=\"icon-ok\"></i>  " . lang('base_edit') . "</a>\r\n                     <a href=\"?act=delete_admin&id=";
    echo $admin_list[$i]["id"];
    echo "\" class=\"label label-danger label-mini\" > <i class=\" icon-remove-sign\"></i> " . lang('base_delete') . "</a>                    </td>\r\n                </tr>\r\n\t\t\t\t  ";
}

echo "\t\r\n\t\t\r\n              </tbody>\r\n            </table>\r\n\t\t\t\r\n\t\t\t\r\n\t\t<!-- -->\r\n\t\t<div style=\"margin-top:10px;\"></div>\r\n\t\t <section class=\"panel\">\r\n\t\t  <header class=\"panel-heading\">\r\n\t\t <button type=\"submit\" name=\"check\" id=\"del\" class=\"btn btn-danger\"  onClick=\"document.myform.Action.value='del_all_admin'\"> <i class=\" icon-remove-sign\"></i> " . lang('base_delete_submit') . " </button>\r\n\t\t\t  <input name=\"Action\" type=\"hidden\" id=\"Action\" value=\"\">\r\n\t\t  </header>\r\n\t\t  \r\n\r\n\t\t   <!-- -->\r\n\t\t  <div class='text-center'>\r\n\t\t  <ul class='pagination'>\r\n\t\t  <li><a>";
echo sprintf(lang('base_page_total'), $totalpage, $currpage, $total);
echo "&nbsp;</a></li>\r\n\t\t  <li>";

if ($currpage == 1) {
    echo "\t\t  <a >" . lang('base_home') . "</a>&nbsp; </li></li><li><a >" . lang('base_page_fenye_title3') . "</a></li>\r\n\t\t  \r\n\t\t  ";
} else {
    echo "\t\t  <li><a href=\"";
    echo $filename;
    echo "&page=1\">" . lang('base_home') . "</a></li><li><a href=\"";
    echo $filename;
    echo "&page=";
    echo $currpage - 1;
    echo "\">" . lang('base_page_fenye_title3') . "</a></li>\r\n\t\t   ";
}

if ($currpage == $totalpage) {
    echo "\t\t   <li><a >" . lang('base_page_fenye_title4') . "</a></li></li><li><a >" . lang('base_shadowe') . "</a></li>\r\n\t\t    ";
} else {
    echo "\t\t\t <li> <a href=\"";
    echo $filename;
    echo "&page=";
    echo $currpage + 1;
    echo "\">" . lang('base_page_fenye_title4') . "</a></li><li><a href=\"";
    echo $filename;
    echo "&page=";
    echo $totalpage;
    echo "\">" . lang('base_shadowe') . "</a></li>\r\n\t\t\t    ";
}

echo "\t\r\n           </ul>\t\t\r\n\t\t</div>\r\n </section>\r\n\t\t \r\n\t\t<!-- -->\r\n\t<!-- -->\t\r\n</form>\t\t\r\n\t\t\t\r\n         </section>\r\n\t</div>\r\n\t</div>\r\n\t\r\n\t\r\n\t<!--page end -->\r\n\t\r\n\t\r\n   </section>\r\n   </section>  \r\n   </section>          \r\n \r\n \r\n   <!-- js placed at the end of the document so the pages load faster -->\r\n    <script src=\"";
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
echo "/js/form-component.js\"></script>\r\n \r\n \r\n";

if ($act == "del_all_admin") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "',{icon:2,time: 3000,shift: -1},function(){location.href='?';});</script>";
        exit();
    }

    $chk = $_REQUEST["chk"];

    if (0 < count($chk)) {
        $countchk = count($chk);

        for ($i = 0; $i <= $countchk; $i++) {
            mysql_query("delete from tgs_admin where id='$chk[$i]' limit 1");
        }

        echo "<script language='javascript'>layer.msg('" . lang('base_delete_admin_success') . "',{icon:1,time: 3000,shift: -1},function(){location.href='?';});</script>";
    }
}

echo "  ";

if ($act == "delete_admin") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "',{icon:2,time: 3000,shift: -1},function(){location.href='?';});</script>";
        exit();
    }

    $id = $_GET["id"];

    if (!$id) {
        echo "<script language='javascript'>layer.msg('" . lang('base_delete_failed') . "');</script>";
        exit();
    }

    if ($id == 1) {
        echo "<script language='javascript'>layer.msg('" . lang('admin_cannot_delete') . "');</script>";
        exit();
    }

    $sql = "delete from tgs_admin where id=" . $id . " limit 1";
    mysql_query($sql) || exit("err:" . $sql);
    echo "<script language='javascript'>layer.msg('" . lang('base_delete_admin_success') . "',{icon:1,time: 3000,shift: -1}, function(){location.href='list_admin.php';});</script>";
    exit();
}

echo "  </body>\r\n</html>\r\n";

