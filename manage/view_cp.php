
<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "cpgl";
$submenu = "editcp";
$act = $_GET["act"];
echo "<!DOCTYPE html>\r\n<html lang=\"zh\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n\t <meta name=\"renderer\" content=\"webkit|ie-comp|ie-stand\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"";
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
echo "/js/respond.min.js\"></script>\r\n    <![endif]-->\r\n<style type=\"text/css\">\r\n<!--\r\nimg{\r\n\twidth: 100%;\r\n}\r\n-->\r\n</style>\t\r\n\r\n</head>\r\n\r\n  <body style=\"background: #ffffff\">\r\n \r\n   \r\n \r\n  ";

if ($act == "view_pro") {
	$id = $_GET["id"];
	$sql = "select * from tgs_pro where id=" . $id . " limit 1";
	$res = mysql_query($sql);
	$arr = mysql_fetch_array($res);
	$pro_name = $arr["pro_name"];
	$cpms = $arr["cpms"];
	$cppic = $arr["cppic"];
	echo " \r\n   <!--page start -->\r\n   \r\n\t<div  >\r\n         <section >\r\n           \r\n           <div style=\"padding:5px;\">\r\n\t\t   ";
	echo $cpms;
	echo "   \r\n        </div>\r\n                             \r\n     </section>\r\n\t\r\n\t</div>\r\n\t<!--page end -->\r\n\t";
}

echo "\t\r\n   </section>\r\n   </section>\r\n   </section>          \r\n  \r\n\r\n  \r\n \r\n  </body>\r\n</html>\r\n";

