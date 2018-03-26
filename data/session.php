<?php
session_start();
if(!$_SESSION["Adminname"])//如果管理员SESSION丢失，要求重新登陆。
{
 echo "<script>location.href='index.php' ;</script>";
 exit;
}
if(!$_SESSION["glqx"])//如果管理权限SESSION丢失，要求重新登陆。
{
 echo "<script>location.href='index.php' ;</script>";
 exit;
}
?>
