<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "cpgl";
$submenu = "addcp";
$act = $_GET["act"];
?>
<!DOCTYPE html>
<html lang="zh_cn">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $cf["page_desc"]; ?>">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="<?php echo $cf["page_keywords"]; ?>">
    <title> <?php echo $cf["site_name"]; ?></title>
    <!-- Bootstrap core CSS -->
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
    <!-- Custom styles for this template -->
    <link href="<?php echo $cf["manage_themes"]; ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo $cf["manage_themes"]; ?>/css/style-responsive.css" rel="stylesheet"/>
    <!--弹窗JS -->
    <script src="<?php echo $cf["manage_themes"]; ?>/layer/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $cf["manage_themes"]; ?>/layer/layer.js"></script>
    <script charset="utf-8" src="editor/kindeditor.js"></script>
    <script charset="utf-8" src="editor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="editor/lang/en.js"></script>
    <script>

        KindEditor.ready(function (K) {
            K.create('#cpms', {
                uploadJson: 'editor/php/upload_json.php',
                fileManagerJson: 'editor/php/file_manager_json.php',
                filterMode: false,
                allowFileManager: true,
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
                        imageUrl: K('#cppic').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#cppic').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            K('#uppic2').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        imageUrl: K('#cppic2').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#cppic2').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            K('#uppic3').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        imageUrl: K('#cppic3').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#cppic3').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
            K('#uppic4').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        imageUrl: K('#cppic4').val(),
                        clickFn: function (url, title, width, height, border, align) {
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
<section id="container">
    <?php
    require "head.php";
    require "left.php";
    ?><!--sidebar end-->
    <section id="main-content">
        <section class="wrapper">

            <?php

            if (3 <= $glqx) {
                echo "<script language='javascript'>layer.msg('" . lang('base_no_permission') . "');</script>";
                exit();
            }

            ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading"><h3> <?= lang('pro_add') ?></h3></header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" enctype="multipart/form-data" name="form1"
                                  method="post" action="?act=save_cp">
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_name') ?></label>
                                    <div class="col-sm-4"><input type="text" class="form-control" name="pro_name"
                                                                 required></div>
                                    <div class="col-sm-6"><p class="help-block"><?= lang('pro_name_des') ?></p></div>
                                </div>
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_num') ?></label>
                                    <div class="col-sm-3"><input type="text" class="form-control" name="cpbh" required>
                                    </div>
                                    <div class="col-sm-7"><p class="help-block"><?= lang('pro_num_des') ?></p></div>
                                </div>
                                <!--                                <div class="form-group"><label-->
                                <!--                                            class="col-sm-2 col-sm-2 control-label">-->
                                <? //= lang('pro_bar_code') ?><!--</label>-->
                                <!--                                    <div class="col-sm-3"><input type="text" class="form-control" name="cptxm" required>-->
                                <!--                                    </div>-->
                                <!--                                    <div class="col-sm-7"><p class="help-block">-->
                                <? //= lang('pro_bar_code_des') ?><!--</p>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_price_a') ?></label>
                                    <div class="col-sm-3"><input type="text" class="form-control" name="price_a"
                                                                 required>
                                    </div>
                                    <div class="col-sm-7"><p class="help-block"><?= lang('pro_price_des') ?></p>
                                    </div>
                                </div>

                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_main_diagram') ?></label>
                                    <div class="col-sm-4"><input type="text" id="cppic" class=" form-control"
                                                                 name="cppic" style="width:100%;"></div>
                                    <div class="col-sm-2"><input type="button" id="uppic" class="btn btn-primary"
                                                                 value="<?= lang('pro_button_main_diagram') ?>"/></div>
                                    <div class="col-sm-3"><p class="help-block"><?= lang('pro_main_diagram_des') ?></p>
                                    </div>
                                </div>
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_pic_1') ?></label>
                                    <div class="col-sm-4"><input type="text" id="cppic2" class=" form-control"
                                                                 name="cppic2" style="width:100%;"></div>
                                    <div class="col-sm-2"><input type="button" id="uppic2" class="btn btn-success"
                                                                 value="<?= lang('base_select_pic') ?>"/></div>
                                    <div class="col-sm-3"><p class="help-block"><?= lang('pro_pic_des') ?></p></div>
                                </div>
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_pic_2') ?></label>
                                    <div class="col-sm-4"><input type="text" id="cppic3" class=" form-control"
                                                                 name="cppic3" style="width:100%;"></div>
                                    <div class="col-sm-2"><input type="button" id="uppic3" class="btn btn-success"
                                                                 value="<?= lang('base_select_pic') ?>"/></div>
                                    <div class="col-sm-3"><p class="help-block"><?= lang('pro_pic_des') ?></p></div>
                                </div>
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_pic_3') ?></label>
                                    <div class="col-sm-4"><input type="text" id="cppic4" class=" form-control"
                                                                 name="cppic4" style="width:100%;"></div>
                                    <div class="col-sm-2"><input type="button" id="uppic4" class="btn btn-success"
                                                                 value="<?= lang('base_select_pic') ?>"/></div>
                                    <div class="col-sm-3"><p class="help-block"><?= lang('pro_pic_des') ?></p></div>
                                </div>
                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('pro_des') ?></label>
                                    <div class="col-sm-8"><textarea name="cpms" id="cpms"
                                                                    style="width:680px;height:600px;"></textarea></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit"><i
                                                    class=" icon-ok"></i> <?= lang('pro_add_submit') ?>
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
?>/js/jquery.js"></script>   <!-- js placed at the end of the document so the pages load faster -->
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
?>/js/form-component.js"></script>
<?php

if ($act == "save_cp") {
    $pro_name = trim($_POST["pro_name"]);
    $cpbh = trim($_POST["cpbh"]);
    $cprice_a = trim($_POST["price_a"]);
    $cprice_b = trim($_POST["price_b"]);
    $cprice_c = trim($_POST["price_c"]);
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

    $sql = "select * from tgs_pro where cpbh='" . $cpbh . "' limit 1";
    $res = mysql_query($sql);
    $arr = mysql_fetch_array($res);

    if (0 < mysql_num_rows($res)) {
        echo "<script language='javascript'>layer.msg('" . lang('pro_num_repeat') . "', function(){});</script>";
        exit();
    }

    $sql = "insert into tgs_pro set  pro_name='" . $pro_name . "',cpbh='" . $cpbh . "',price_a='" . $cprice_a . "',price_b='" . $cprice_b . "',price_c='" . $cprice_c . "',cpms='" . $cpms . "',cppic='" . $cppic . "',cppic2='" . $cppic2 . "',cppic3='" . $cppic3 . "',cppic4='" . $cppic4 . "'";
    mysql_query($sql);
    echo "<script language='javascript'>layer.msg('" . lang('pro_add_success') . "',{icon:1,time: 2000,shift: -1});</script>";
    exit();
}

?>  </body>
</html>

