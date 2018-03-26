<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "admin";
$submenu = "addadmin";
$act = $_GET["act"];
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $cf["page_desc"]; ?>">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="<?php echo $cf["page_keywords"]; ?>">
    <title>
        <?php echo $cf["site_name"]; ?>
    </title> <!-- Bootstrap core CSS -->
    <link href="<?php echo $cf["manage_themes"]; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cf["manage_themes"]; ?>/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo $cf["manage_themes"]; ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $cf["manage_themes"]; ?>/assets/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $cf["manage_themes"]; ?>/assets/bootstrap-colorpicker/css/colorpicker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $cf["manage_themes"]; ?>/assets/bootstrap-daterangepicker/daterangepicker.css"/>
    <link href="<?php echo $cf["manage_themes"]; ?>/css/jquery.searchableSelect.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo $cf["manage_themes"]; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo $cf["manage_themes"]; ?>/css/style-responsive.css" rel="stylesheet"/>
    <script src="<?php echo $cf["manage_themes"]; ?>/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $cf["manage_themes"]; ?>/js/jquery.searchableSelect.js"></script>
    <!--弹窗JS -->
    <script src="<?php echo $cf["manage_themes"]; ?>/layer/layer.js"></script>

    <script charset="utf-8" src="editor/kindeditor.js"></script>
    <script charset="utf-8" src="editor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="editor/lang/en.js"></script>
    <script>
        KindEditor.ready(function (K) {
            K.create('#suyuan', {
                uploadJson: 'editor/php/upload_json.php',
                fileManagerJson: 'editor/php/file_manager_json.php',
                filterMode: false,
                langType: '<?php echo $GLOBALS['cfg']['kindEditor']; ?>'
            });
        });
        KindEditor.ready(function (K) {
            var editor = K.editor({
                uploadJson: 'editor/php/upload_json.php',
                fileManagerJson: 'editor/php/file_manager_json.php',
                allowFileManager: true,
                langType: '<?php echo $GLOBALS['cfg']['kindEditor']; ?>'
            });
            K('#uppic').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        imageUrl: K('#admin_pic').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#admin_pic').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
        });</script>
</head>
<body>
<div class="sqbox">

</div>
<section id="container">
    <!--header start-->
    <?php
    require "head.php";

    require "left.php";
    ?> <!--sidebar end-->
    <section id="main-content">
        <section class="wrapper">
            <!--add start -->
            <?php

            if (3 <= $glqx) {
                echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "');</script>";
                exit();
            }

            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h3><?= lang('left_admin_add') ?></h3>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" enctype="multipart/form-data" name="form1"
                                  method="post" action="?act=save_admin">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?= lang('admin_user') ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="username" style="width:200px;"
                                               placeholder="<?= lang('admin_user_des') ?>" required>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="help-block"><?= lang('admin_user_des') ?> </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?= lang('admin_password') ?></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="password" style="width:200px;"
                                               placeholder="<?= lang('admin_password_des') ?>" required>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="help-block"><?= lang('admin_password_des') ?> </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?= lang('admin_name') ?></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="glyxm" style="width:160px;"
                                               placeholder="<?= lang('admin_name_des') ?>" required>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="help-block"><?= lang('admin_name_des') ?> </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?= lang('head_admin_avatar') ?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="admin_pic" id="admin_pic"
                                               style="width:420px;" placeholder="<?= lang('admin_click_alt') ?>">
                                    </div>
                                    <div class="col-sm-5"><input type="button" id="uppic" class="btn btn-success"
                                                                 value="<?= lang('admin_upload_button') ?>"/></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"><?= lang('admin_power') ?></label>
                                    <div class="col-sm-2">
                                        <select name="glqx" class="form-control" style="width:160px;">
                                            <option value="1"><?= lang('head_admin') ?></option>
                                            <option value="2"><?= lang('head_operator') ?></option>
                                            <option value="3"><?= lang('head_messenger') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="help-block"><?= lang('admin_power_des') ?> </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit"><i
                                                    class=" icon-ok"></i> <?= lang('base_button_add') ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div><!--add end -->   </section>
    </section>
</section>         <!-- js placed at the end of the document so the pages load faster -->
<script src="<?php
echo $cf["manage_themes"];
?>/js/bootstrap.min.js"></script>
<script src="<?php
echo $cf["manage_themes"];
?>/js/jquery.scrollTo.min.js"></script>
<script src="<?php
echo $cf["manage_themes"];
?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php
echo $cf["manage_themes"];
?>/js/jquery-ui-1.9.2.custom.min.js"></script>
<script class="include" type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/js/jquery.dcjqaccordion.2.7.js"></script>  <!--custom switch-->
<script src="<?php
echo $cf["manage_themes"];
?>/js/bootstrap-switch.js"></script>  <!--custom tagsinput-->
<script src="<?php
echo $cf["manage_themes"];
?>/js/jquery.tagsinput.js"></script>  <!--custom checkbox & radio-->
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/js/ga.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php
echo $cf["manage_themes"];
?>/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="<?php
echo $cf["manage_themes"];
?>/js/respond.min.js"></script>  <!--common script for all pages-->
<script src="<?php
echo $cf["manage_themes"];
?>/js/common-scripts.js"></script>  <!--script for this page-->
<script src="<?php
echo $cf["manage_themes"];
?>/js/form-component.js"></script> <?php

if ($act == "save_admin") {
    if (2 <= $glqx) {
        echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "',{icon:0,time: -1,shift: -1});</script>";
        exit();
    }

    $username = trim($_POST["username"]);
    $password = md5($_POST["password"]);
    $admin_pic = $_POST["admin_pic"];
    $glyxm = $_POST["glyxm"];
    $glqx = $_POST["glqx"];

    if ($username == "") {
        echo "<script language='javascript'>layer.msg('" . lang('admin_lack_user') . "');</script>";
        exit();
    }

    if ($password == "") {
        echo "<script language='javascript'>layer.msg('" . lang('admin_lack_password') . "');</script>";
        exit();
    }

    if (strlen($password) < 4) {
        echo "<script language='javascript'>layer.msg('" . lang('admin_length_password') . "');</script>";
        exit();
    }

    $sql = "select * from tgs_admin where username='" . $username . "' limit 1";
    $res = mysql_query($sql);
    $arr = mysql_fetch_array($res);

    if (0 < mysql_num_rows($res)) {
        echo "<script language='javascript'>layer.msg('" . lang('admin_repeat_user') . "', function(){});</script>";
        exit();
    }

    mysql_query("insert into tgs_admin  set  username='" . $username . "' ,password='" . $password . "' ,glyxm='" . $glyxm . "' ,glqx='" . $glqx . "' ,admin_pic='" . $admin_pic . "' ");
    echo "<script language='javascript'>layer.msg('" . lang('sys_add_success') . "',{icon:1,time: 2000,shift: -1});</script>";
    exit();
}

?>  </body>
</html>

