<?php
echo "﻿";
error_reporting(0);
session_start();
require "../data/head.php";
$act = $_REQUEST["act"];

if ($_SESSION["Adminname"] != "") {
    echo "<script>location.href='main.php';</script>";
}

echo "<!DOCTYPE html>\r\n<html lang=\"zh_cn\">\r\n<head>\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta name=\"description\" content=\"";
echo $cf["page_desc"];
echo "\">\r\n    <meta name=\"author\" content=\"Mosaddek\">\r\n    <meta name=\"keyword\" content=\"";
echo $cf["page_keywords"];
echo "\">\r\n    <link rel=\"shortcut icon\" href=\"../favicon.png\">\r\n\r\n    <title>";
echo $cf["site_name"];
echo "</title><link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap.min.css\" rel=\"stylesheet\">\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/bootstrap-reset.css\" rel=\"stylesheet\">\r\n    <!--external css-->\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/assets/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />\r\n    <!-- Custom styles for this template -->\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/style.css\" rel=\"stylesheet\">\r\n    <link href=\"";
echo $cf["manage_themes"];
echo "/css/style-responsive.css\" rel=\"stylesheet\" /><script src=\"";
echo $cf["manage_themes"];
echo "/js/html5shiv.js\"></script>\r\n    <script src=\"";
echo $cf["manage_themes"];
echo "/js/respond.min.js\"></script><script src=\"";
echo $cf["manage_themes"];
echo "/layer/jquery-1.9.1.min.js\"></script>\r\n<script src=\"";
echo $cf["manage_themes"];
echo "/layer/layer.js\"></script></head><body class=\"body-login\">\r\n";

if ($act == "adminlogin") {
    $username = trim($_POST["Username"]);
    $password = trim($_POST["Password"]);
    $yzm = trim($_POST["yzm"]);
    $sql = "select * from tgs_admin where username='" . $username . "' and password='" . md5($password) . "'";
    $res = mysql_query($sql);
    $ewsaas = mysql_fetch_array($res);
    $glqx = $ewsaas[glqx];

    if (!$ewsaas[0]) {
        echo "<script language='javascript'>layer.msg('" . lang('index_login_error') . "',{icon:2,time: 2000,shift: -1}, function(){location.href='index.php';});</script>";
        exit();
    }

    if ($yzm != $_SESSION["authnum_session"]) {
        echo "<script language='javascript'>layer.msg('" . lang('ts_verify_error') . "',{icon:2,time: 2000,shift: -1}, function(){location.href='index.php';});</script>";
        exit();
    }

    $_SESSION["Adminname"] = $username;
    $_SESSION["glqx"] = $glqx;
    mysql_query("update tgs_admin set logins=logins+1 where username='$username' limit 1");
    echo "<script>location.href='main.php';</script>";
}

if ($act == "logout") {
    $_SESSION["Adminname"] = [];
    $_SESSION["glqx"] = [];
    session_destroy();
    echo "<script>location.href='index.php';</script>";
}

echo "<div class=\"container\"><section class=\"logins\"><i class=\"icon-logo\"></i>
<form  name=\"Login\" class=\"form-horizontal \" action=\"?act=adminlogin\" method=\"post\">
<div class=\"login-wrap\"><div class=\"form-group\"><div class=\"col-lg-4\"></div><div class=\"col-lg-4\">
<div class=\"input-group input-group-lg m-bot15\"><span class=\"input-group-addon\">" . lang('index_user') . "：</span >
<input type = \"text\" class=\"form-control input-lg\" name=\"Username\" >
</div><div class=\"input-group input-group-lg m-bot15\"><span class=\"input-group-addon\">" . lang('index_password') . "：
</span><input type=\"password\" class=\"form-control input-lg\" name=\"Password\"  ></div>
<div class=\"input-group input-group-lg m-bot15\" ><span class=\"input-group-addon\">" . lang('index_verify') . "：</span>
<input type=\"text\" name=\"yzm\" class=\"form-control input-lg\" ><span class=\"input-group-addon\">
<img src=\"../data/code.php\" alt=\"" . lang('index_verify') . "\" title=\"" . lang('base_click_refresh') . "\"  style=\"width:80px; height:30px; cursor:pointer;\" onclick=\"this.src='/data/code.php?d='+Math.random();\"></span></div>
<div class=\"\"><input type=\"submit\" name=\"Submit\" value=\"" . lang('index_login') . "\"  class=\"btn btn-success  btn-lg btn-block\"></div></div></div>
<div class=\"col-lg-4\"></div></div></form><h2>";
echo $cf["site_name"];
echo "  &nbsp;&nbsp;  <br>" . lang('index_copyright') . "：";
echo $cf["com_name"];
echo "</h2></section></div></body></html>";

