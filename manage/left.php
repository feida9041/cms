<?php
echo "﻿<aside>\r\n          <div id=\"sidebar\"  class=\"nav-collapse \"><ul class=\"sidebar-menu\" id=\"nav-accordion\">\r\n\t\t\t  \r\n\t\t\t  \r\n\t\t\t   <li class=\"sub-menu\">\r\n                      <a href=\"javascript:;\" ";

if ($sidmenu == "depot") {
    echo "class=\"active\"";
}

echo " ><i class=\" icon-leaf\"></i><span>" . lang('left_pro_title') . "</span></a><ul class=\"sub\"><li ";

if ($submenu == "depotinfo") {
    echo "class=\"active\"";
}

echo " ><a  href=\"depot.php\">" . lang('left_pro_add') . "</a></li>\r\n                          <li ";

if ($submenu == "listdepot") {
    echo "class=\"active\"";
}

echo " ><a  href=\"list_depot.php\">" . lang('left_pro_list') . "</a></li>\r\n                      </ul>\r\n                  </li>\r\n\t\t\t\t\r\n\t\t\t\t  \r\n                  <li class=\"sub-menu\" >\r\n                      <a href=\"javascript:;\" ";

if ($sidmenu == "admin") {
    echo "class=\"active\"";
}

echo ">\r\n                          <i class=\"icon-lock\"></i>\r\n                          <span>" . lang('left_admin_title') . "</span>\r\n                      </a>\r\n                      <ul class=\"sub\">\r\n                          <li ";

if ($submenu == "listadmin") {
    echo "class=\"active\"";
}

echo "><a  href=\"list_admin.php\">" . lang('left_admin_list') . "</a></li>\r\n                         <li ";

if ($submenu == "addadmin") {
    echo "class=\"active\"";
}

echo " ><a  href=\"add_admin.php\">" . lang('left_admin_add') . "</a></li><li ";
if ($submenu == "listuser") {
    echo "class=\"active\"";
}
echo "><a  href=\"list_user.php\">" . lang('left_user_list') . "</a></li>";

echo "</ul></li></ul><div style=\"height:20px;\"></div></div></aside>";

