<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "fwm";
$submenu = "index";
$act = $_GET["act"];
$sql = "select * from tgs_code";
$query = mysql_query($sql);
$codezs = mysql_num_rows($query);
$sql = "select * from tgs_pro";
$query = mysql_query($sql);
$productzs = mysql_num_rows($query);
$sql = "select * from tgs_suyuan";
$query = mysql_query($sql);
$syzs = mysql_num_rows($query);
$sql = "select * from tgs_lc";
$query = mysql_query($sql);
$lczs = mysql_num_rows($query);
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
echo "/css/style-responsive.css\" rel=\"stylesheet\" />\r\n\t\r\n\t\r\n\t\r\n\t<!--弹窗JS -->\r\n\t<script src=\"";
echo $cf["manage_themes"];
echo "/layer/jquery-1.9.1.min.js\"></script>\r\n<script src=\"";
echo $cf["manage_themes"];
echo "/layer/layer.js\"></script>\r\n\r\n</head>\r\n  <body>\r\n  \r\n  \r\n  <section id=\"container\" >\r\n      <!--header start-->\r\n     ";
require "head.php";
echo "      <!--header end-->\r\n      <!--sidebar start-->\r\n       ";
require "left.php";
echo "      <!--sidebar end-->\r\n\t \r\n  <section id=\"main-content\">\r\n          <section class=\"wrapper\">\r\n\t\t  \r\n         <!--state overview start-->\r\n              <div class=\"row state-overview\">\r\n                  <div class=\"col-lg-3 col-sm-6\">\r\n                      <section class=\"panel\">\r\n                          <div class=\"symbol terques\">\r\n                              <i class=\" icon-cloud\"></i>\r\n                          </div>\r\n                          <div class=\"value\">\r\n                              <h1 class=\"count\">\r\n                                 ";
echo $codezs;
echo "                              </h1>\r\n                              <p>" . lang('main_code_num') . "</p>\r\n                          </div>\r\n                      </section>\r\n                  </div>\r\n                  <div class=\"col-lg-3 col-sm-6\">\r\n                      <section class=\"panel\">\r\n                          <div class=\"symbol red\">\r\n                              <i class=\"icon-tags\"></i>\r\n                          </div>\r\n                          <div class=\"value\">\r\n                              <h1 class=\" count2\">\r\n                                 ";
echo $productzs;
echo "                              </h1>\r\n                              <p>" . lang('main_pro_num') . "</p>\r\n                          </div>\r\n                      </section>\r\n                  </div>\r\n\t\t\t\t  <div class=\"col-lg-3 col-sm-6\">\r\n                      <section class=\"panel\">\r\n                          <div class=\"symbol blue\">\r\n                              <i class=\"icon-user\"></i>\r\n                          </div>\r\n                          <div class=\"value\">\r\n                              <h1 class=\" count4\">\r\n                                  ";
echo $lczs;
echo "                              </h1>\r\n                              <p>" . lang('main_process_records_num') . "</p>\r\n                          </div>\r\n                      </section>\r\n                  </div>\r\n                  <div class=\"col-lg-3 col-sm-6\">\r\n                      <section class=\"panel\">\r\n                          <div class=\"symbol yellow\">\r\n                              <i class=\"icon-retweet\"></i>\r\n                          </div>\r\n                          <div class=\"value\">\r\n                              <h1 class=\" count3\">\r\n                                 ";
echo $syzs;
echo "                              </h1>\r\n                              <p>" . lang('main_example_num') . "</p>\r\n                          </div>\r\n                      </section>\r\n                  </div>\r\n                  \r\n              </div>\r\n              <!--state overview end-->  \r\n\t\t  \r\n\t\t \t<!--常见问题解答 -->\t\t \r\n\t\t   <div class=\"row\">\t\t\r\n<!--使用问题 -->\r\n\t<div class=\"col-lg-6\">\r\n                      <section class=\"panel\">\r\n                          
<header class=\"panel-heading\">\r\n                          <h3>" . lang('main_code_help') . "</h3>\r\n                          </header>
<div class=\"panel-body profile-activity\"><div class=\"activity terques\"><span><i class=\"icon-bullhorn\"></i></span>
<div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_code_question_1') . "</h4>\r\n                                              
<p>" . lang('main_code_answer_1') . "</p>
\r\n                                          </div>\r\n                                      </div>\r\n                                  
</div>\r\n                              </div>\r\n                              <div class=\"activity alt purple\">\r\n                     
<span><i class=\"icon-book\"></i></span><div class=\"activity-desk\">\r\n                                      <div class=\"panel\">
<div class=\"panel-body\">\r\n                                              <div class=\"arrow\"></div><i class=\" icon-time\"></i>                                          
<h4>" . lang('main_code_question_2') . "</h4>\r\n                                              
<p>" . lang('main_code_answer_2') . "</p>
</div></div>\r\n                                  </div>\r\n                              </div>\r\n                              
<div class=\"activity blue\">\r\n                                  <span>\r\n                                      <i class=\"icon-bullhorn\"></i>\r\n                                  </span>\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_code_question_3') . "</h4>\r\n                                              
<p>" . lang('main_code_answer_3') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n\r\n                              <div class=\"activity alt green\">\r\n                                  <span>\r\n                                      <i class=\"icon-book\"></i>\r\n                                  </span>\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow-alt\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_code_question_4') . "</h4>\r\n                                              
<p>" . lang('main_code_answer_4') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n\r\n                          </div>\r\n\t\t\t\t\t\t  \r\n                      </section>\r\n                  </div>\r\n\t\t\t\t  <!--使用问题 -->\t\r\n\t\t\t\t  \r\n\t\t\t\t  \r\n\t\t\t\t  <!--使用问题 -->\r\n\t<div class=\"col-lg-6\">\r\n                      <section class=\"panel\">\r\n                          
<header class=\"panel-heading\"><h3>" . lang('main_sys_help') . "</h3>\r\n                          </header>\r\n                          <div class=\"panel-body profile-activity\">\r\n                         \r\n\t\t\t\t\t\t \r\n\t\t\t\t\t\t   <div class=\"activity alt green\">\r\n                                  <span>\r\n                                      <i class=\"icon-beer\"></i>\r\n                                  </span>\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow-alt\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_sys_question_1') . "</h4>\r\n                                              
<p>" . lang('main_sys_answer_1') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n\r\n\t\t\t\t\t\t \r\n\t\t\t\t\t\t \r\n                              <div class=\"activity terques\">\r\n                                  <span>\r\n                                      <i class=\"icon-shopping-cart\"></i>\r\n                                  </span>\r\n\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_sys_question_2') . "</h4>\r\n                                              
<p>" . lang('main_sys_answer_2') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <div class=\"activity alt purple\">\r\n                                  <span>\r\n                                      <i class=\"icon-rocket\"></i>\r\n                                  </span>\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow-alt\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_sys_question_3') . "</h4>\r\n                                              
<p>" . lang('main_sys_answer_3') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n                              <div class=\"activity blue\">\r\n                                  <span>\r\n                                      <i class=\"icon-bullhorn\"></i>\r\n                                  </span>\r\n                                  <div class=\"activity-desk\">\r\n                                      <div class=\"panel\">\r\n                                          <div class=\"panel-body\">\r\n                                              <div class=\"arrow\"></div>\r\n                                              <i class=\" icon-time\"></i>\r\n                                              
<h4>" . lang('main_sys_question_4') . "</h4>\r\n                                              
<p>" . lang('main_sys_answer_4') . "</p>\r\n                                          </div>\r\n                                      </div>\r\n                                  </div>\r\n                              </div>\r\n\r\n                            \r\n                          </div>\r\n                      </section>\r\n                  </div>\r\n\t\t\t\t  <!--使用问题 -->\t\r\n\t\t\t\t  \t\t  \r\n\t\t\t\t</div>  \r\n    <!--常见问题结束 -->\r\n        </section>\r\n      </section>\r\n  </section>\r\n      \r\n <!-- js placed at the end of the document so the pages load faster -->\r\n    <script src=\"";
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
echo "/js/form-component.js\"></script>\r\n  \r\n\r\n";

if ($act == "save_cp") {
    $pro_name = trim($_POST["pro_name"]);
    $cpms = $_POST["cpms"];
    $cppic = trim($_POST["cppic"]);
    $cppic2 = trim($_POST["cppic2"]);
    $cppic3 = trim($_POST["cppic3"]);
    $cppic4 = trim($_POST["cppic4"]);

    if ($pro_name == "") {
        echo "<script language='javascript'>layer.msg('" . lang('pro_lack_name') . "');</script>";
        exit();
    }

    if ($cpms == "") {
        echo "<script language='javascript'>layer.msg('" . lang('pro_lack_des') . "');</script>";
        exit();
    }

    $sql = "insert into tgs_pro set  pro_name='" . $pro_name . "',cpms='" . $cpms . "',cppic='" . $cppic . "',cppic2='" . $cppic2 . "',cppic3='" . $cppic3 . "',cppic4='" . $cppic4 . "'";
    mysql_query($sql);
    echo "<script language='javascript'>layer.msg('" . lang('pro_add_success') . "',{icon:1,time: 1000,shift: -1}, function(){location.href='add_cp.php';});</script>";
    exit();
}

echo " \r\n  </body>\r\n</html>\r\n";

