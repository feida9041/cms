<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "cpgl";
$submenu = "listcp";
$act = $_GET["act"];
echo " <meta charset=\"utf-8\">\r\n\t <meta name=\"renderer\" content=\"webkit|ie-comp|ie-stand\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"";
echo $cf["page_desc"];
echo "\">\r\n    <meta name=\"author\" content=\"Mosaddek\">\r\n    <meta name=\"keyword\" content=\"";
echo $cf["page_keywords"];
echo "\">\r\n   \r\n    <title>";
echo $cf["site_name"];
echo "</title><link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap.min.css\" rel=\"stylesheet\">\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap-reset.css\" rel=\"stylesheet\"><link href=\"";
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
echo "/layer/layer.js\"></script>\r\n\r\n<script charset=\"utf-8\" src=\"editor/kindeditor.js\"></script>\r\n<script charset=\"utf-8\" src=\"editor/lang/zh_CN.js\"></script>\r\n<script>\r\n//  \r\n
KindEditor.ready(function(K) {
    \r\n        K.create('#cpms', {\r\n                
    uploadJson : 'editor/php/upload_json.php',\r\n                
    fileManagerJson : 'editor/php/file_manager_json.php',\r\n\t\t\t\t
    filterMode: false\r\n        });\r\n});\r\n\t\t
    </script>\r\n<script>\r\n\t\t\t
    KindEditor.ready(function(K) {\r\n\t\t\t\tvar editor = 
    K.editor({\r\n\t\t\t\t
    uploadJson : 'editor/php/upload_json.php',\r\n                
    fileManagerJson : 'editor/php/file_manager_json.php',\r\n                
    allowFileManager : true\r\n\t\t\t\t});\r\n\t\t\t\t
    K('#uppic').click(function() {\r\n\t\t\t\t\teditor.loadPlugin('image', function() {\r\n\t\t\t\t\t\teditor.plugin.imageDialog({\r\n\t\t\t\t\t\t\timageUrl : K('#cppic').val(),\r\n\t\t\t\t\t\t\tclickFn : function(url, title, width, height, border, align) {\r\n\t\t\t\t\t\t\t\tK('#cppic').val(url);\r\n\t\t\t\t\t\t\t\teditor.hideDialog();\r\n\t\t\t\t\t\t\t}\r\n\t\t\t\t\t\t});\r\n\t\t\t\t\t});\r\n\t\t\t\t});\r\n\t\t\t\t\t\t\t\r\n\t\t\t});\r\n\t\t</script>\r\n\r\n</head>\r\n\r\n  <body>\r\n  <section id=\"container\" >\r\n      <!--header start-->\r\n     ";
require "head.php";
echo "      <!--header end-->\r\n      <!--sidebar start-->\r\n       ";
require "left.php";
echo "      <!--sidebar end-->\r\n\t";
$pro_list = [];
$pro_name = trim($_REQUEST["pro_name"]);
$cptxm = trim($_REQUEST["cptxm"]);
$cpbh = trim($_REQUEST["cpbh"]);
$qupz = trim($_REQUEST["qupz"]);
$sql = "select * from tgs_pro where 1";

if ($pro_name != "") {
    $sql .= " and  pro_name like '%$pro_name%'";
}

if ($cptxm != "") {
    $sql .= " and  cptxm like '%$cptxm%'";
}

if ($cpbh != "") {
    $sql .= " and  cpbh like '%$cpbh%'";
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

    $pro_list[] = $arr;
}

echo " \r\n <SCRIPT language=\"javascript\">\r\n\r\nfunction CheckAll(form)\r\n\r\n  {\r\n\r\n  for (var i=0;i<form.elements.length;i++)\r\n\r\n    {\r\n\r\n    var e = form.elements[i];\r\n\r\n    if (e.Name != \"chkAll\"&&e.disabled==false)\r\n\r\n       e.checked = form.chkAll.checked;\r\n\r\n    }\r\n\r\n  }\r\n\r\nfunction CheckAll2(form)\r\n\r\n  {\r\n\r\n  for (var i=0;i<form.elements.length;i++)\r\n\r\n    {\r\n\r\n    var e = form.elements[i];\r\n\r\n    if (e.Name != \"chkAll2\"&&e.disabled==false)\r\n\r\n       e.checked = form.chkAll2.checked;\r\n\r\n    }\r\n\r\n  }  \r\n\r\n  \r\n\r\nfunction ConfirmDel()\r\n{\r\n\tif(document.myform.Action.value==\"del_all_cp\")\r\n\t{\r\n\t\tdocument.myform.action=\"?act=del_all_cp\";
 if(confirm(\"" . lang('base_delete_confirm') . "\"))\r\n\t\t    return true;\r\n\t\telse\r\n\t\t\treturn false;\r\n\t}\t\r\n}\r\n\r\n\r\n\r\n</SCRIPT>\r\n  <section id=\"main-content\">\r\n  <section class=\"wrapper\">\r\n   <!--page start -->\r\n   \r\n    <!--顶部快速搜索 -->\r\n\t<div class=\"row\">\r\n      <div class=\"col-md-12\">\r\n       <section class=\"panel\">\r\n        <div class=\"panel-body\">\r\n        <form action=\"?\" method=\"post\" name=\"form1\" class=\"form-inline\">\r\n\t\t\r\n          <div class=\"form-group\">
 <label class=\"sr-only\" >" . lang('pro_name') . "</label>
 <input type=\"text\" name=\"pro_name\"  class=\"form-control\"   style=\"width:220px;\"  placeholder=\"" . lang('pro_name') . "\"/>\t\t   \r\n            </div>\r\n\t\t\t<div class=\"form-group\">\r\n           
 <label class=\"sr-only\" >" . lang('pro_num') . "</label>
 <input type=\"text\" name=\"cpbh\"  class=\"form-control\"    style=\"width:220px;\"  placeholder=\"" . lang('pro_num') . "\"/>\t\t   \r\n            </div>  
 <button type=\"submit\" class=\"btn btn-success\"><i class=\"icon-zoom-in\"></i> " . lang('base_search') . "</button>\r\n\t\t<a href=\"?\">
 <button class=\"btn btn-default\"   type=\"button\" ><i class=\"icon-refresh\"></i> " . lang('base_refresh') . "</button></a> \r\n       </form>\r\n        </div>\r\n       </section>\r\n     </div>\r\n  </div>\r\n  <!--顶部快速搜索结束 -->\r\n   <form method=\"post\" name=\"myform\" id=\"myform\" action=\"?\" onSubmit=\"return ConfirmDel();\">\r\n     <div class=\"row\">\r\n\t<div class=\"col-md-12\">\r\n         <section class=\"panel\">\r\n            <header class=\"panel-heading\">\r\n          
 <h4>" . lang('pro_list') . "</h4></header>\r\n            <table class=\"table table-striped table-advance table-hover\">\r\n              <thead>\r\n                <tr>\r\n                  
 <th><INPUT TYPE=\"checkbox\" NAME=\"chkAll\" id=\"chkAll\" title=\"" . lang('base_select_all') . "\"  onclick=\"CheckAll(this.form)\"></th>\r\n                  <th >ID</th>\r\n                  
 <th>" . lang('pro_main_diagram') . "</th><th>" . lang('pro_name') . "</th><th>" . lang('pro_num') . "</th><th>" . lang('pro_des') . "</th><th>" . lang('base_operate') . "</th>\r\n                </tr>\r\n              </thead>\r\n             \r\n              <tbody>\r\n\t\t\t  ";

for ($i = 0; $i < count($pro_list); $i++) {
    echo "                <tr>\r\n                  <td><input name=\"chk[]\" type=\"checkbox\" id=\"chk[]\" value=\"";
    echo $pro_list[$i]["id"];
    echo "\"></td>\r\n                  <td>";
    echo $pro_list[$i]["id"];
    echo "</td>\r\n                  <td >\r\n\t\t\t\t  <div class=\"cppic-heading alt \">\r\n\t\t\t  <a ><img src=\"";

    if ($pro_list[$i]["cppic"] == "") {
        echo "/upload/image/nopic.jpg";
    } else {
        echo $pro_list[$i]["cppic"];
    }

    echo "\" alt=\"" . lang('pro_main_diagram') . "\" > </a>\r\n</div>                  </td>\r\n\r\n                  <td ><a href=\"edit_cp.php?act=edit_pro&id=";
    echo $pro_list[$i]["id"];
    echo "\" title=\" " . lang('base_edit') . "\">";
    echo $pro_list[$i]["pro_name"];
    echo "</a></td>\r\n                  <td>";
    echo $pro_list[$i]["cpbh"];
    echo "</td><td><span onclick=\"ew80_cplist";
    echo $pro_list[$i]["id"];
    echo "()\" class=\"ew80_ontext \"><i class=\"icon-eye-open\" ></i>" . lang('base_preview') . "</span></td>\r\n\t\t\t\t   <script>\r\n\t\t\t\t  \r\n\t\t\t\t  function ew80_cplist";
    echo $pro_list[$i]["id"];
    echo "(){\r\nlayer.open({\r\n  type: 2,\r\n  title: '" . lang('base_preview') . "',\r\n  skin: 'layui-layer-rim', //加上边框\r\n  area: ['600px', '640px'], //宽高\r\n  content: \"view_cp.php?act=view_pro&id=";
    echo $pro_list[$i]["id"];
    echo "\"\r\n});  \r\n\t\t\t\t  }\r\n</script>\r\n\t\t\t\t  \r\n\t\t\t\t  \r\n                  <td><a href=\"edit_cp.php?act=edit_pro&id=";
    echo $pro_list[$i]["id"];
    echo "\" class=\"label label-success label-mini\" ><i class=\"icon-ok\"></i>  " . lang('base_edit') . "</a>\r\n                     <a href=\"?act=delete_pro&id=";
    echo $pro_list[$i]["id"];
    echo "\" class=\"label label-danger label-mini\" > <i class=\" icon-remove-sign\"></i> " . lang('base_delete') . "</a>                    </td>\r\n                </tr>\r\n\t\t\t\t  ";
}

echo "\t\r\n\t\t\r\n              </tbody>\r\n            </table>\r\n\t\t\t\r\n\t\t\t\r\n\t\t<!--底部 -->\r\n\t\t<div style=\"margin-top:10px;\"></div>\r\n\t\t <section class=\"panel\">\r\n\t\t  <header class=\"panel-heading\">\r\n\t\t <button type=\"submit\" name=\"check\" id=\"del\" class=\"btn btn-danger\"  onClick=\"document.myform.Action.value='del_all_cp'\"> <i class=\" icon-remove-sign\"></i> " . lang('base_delete_submit') . " </button>\r\n\t\t\t  <input name=\"Action\" type=\"hidden\" id=\"Action\" value=\"\">\r\n\t\t  </header>\r\n\t\t  \r\n\r\n\t\t   <!--分页开始 -->\r\n\t\t  <div class='text-center'>\r\n\t\t  <ul class='pagination'>\r\n\t\t  <li><a>";
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

echo "\t\r\n           </ul>\t\t\r\n\t\t</div>\r\n </section>\r\n\t\t \r\n\t\t<!--分页END -->\r\n\t<!--底部结束 -->\t\r\n</form>\t\t\r\n\t\t\t\r\n         </section>\r\n\t</div>\r\n\t</div>\r\n\t\r\n\t\r\n\t<!--page end -->\r\n\t\r\n\t\r\n   </section>\r\n   </section>  \r\n   </section>          \r\n \r\n \r\n   <!-- js placed at the end of the document so the pages load faster -->\r\n    <script src=\"";
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

if ($act == "del_all_cp") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission2') . "');</script>";
        exit();
    }

    $chk = $_REQUEST["chk"];

    if (0 < count($chk)) {
        $countchk = count($chk);

        for ($i = 0; $i <= $countchk; $i++) {
            mysql_query("delete from tgs_pro where id='$chk[$i]' limit 1");
        }

        echo "<script>alert('" . lang('base_delete_success') . "');location.href=''</script>";
    }
}

echo "  ";

if ($act == "delete_pro") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission2') . "');</script>";
        exit();
    }

    $id = $_GET["id"];

    if (!$id) {
        echo "<script language='javascript'>layer.msg('" . lang('base_delete_failed') . "');</script>";
        exit();
    }

    $sql = "delete from tgs_pro where id=" . $id . " limit 1";
    mysql_query($sql) || exit("err:" . $sql);
    echo "<script language='javascript'>layer.msg('" . lang('base_delete_success') . "',{icon:1,time: 1000,shift: -1}, function(){location.href='list_cp.php';});</script>";
    exit();
}

echo "  </body>\r\n</html>\r\n";

