<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "depot";
$submenu = "depotinfo";
$act = $_GET["act"];
$ruleid = $_GET["id"];
$rule = new Rule();
if ($ruleid) {
    $rule->id = $ruleid;
}
$ruleconfig = $rule->get();
?>
<!DOCTYPE html>
<html lang="zh_cn">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $cf['page_desc'] ?>">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="<?= $cf['page_keywords'] ?>">
    <title><?= $cf['site_name'] ?></title>
    <link href="<?= $cf['manage_themes'] ?>/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/css/bootstrap-reset.css" type="text/css" rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/assets/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/assets/bootstrap-datepicker/css/datepicker.css" type="text/css"
          rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/assets/bootstrap-colorpicker/css/colorpicker.css" type="text/css"
          rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/assets/bootstrap-daterangepicker/daterangepicker.css" type="text/css"
          rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/css/jquery.searchableSelect.css" type="text/css" rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/css/style.css" type="text/css" rel="stylesheet">
    <link href="<?= $cf['manage_themes'] ?>/css/style-responsive.css" type="text/css" rel="stylesheet">
    <script src="<?= $cf['manage_themes'] ?>/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?= $cf['manage_themes'] ?>/js/jquery.searchableSelect.js" type="text/javascript"></script>
    <script src="<?= $cf['manage_themes'] ?>/layer/layer.js" type="text/javascript"></script>
    <script charset="utf-8" src="editor/kindeditor.js"></script>
    <script charset="utf-8" src="editor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="editor/lang/en.js"></script>
    <script type="text/javascript">
        $(function () {
            KindEditor.ready(function (K) {
                var editor = K.create('#view_tmp', {
                    uploadJson: 'editor/php/upload_json.php',
                    fileManagerJson: 'editor/php/file_manager_json.php',
                    filterMode: false,
                    allowFileManager: true,
                    langType: "<?= $GLOBALS['cfg']['kindEditor'] ?>"
                });


                $('#s1').searchableSelect();
                $('.open_config').on('change', function (e) {
                    $($(this).attr('data-href')).slideToggle('slow');
                });

                $("#warning_color").on("change", function () {
                    var new_class = 'form-control option-' + $(this).val();
                    $(this).attr('class', new_class);
                });

                $("#submit").on("click", function () {
                    $(this).attr('disabled', true);
                    editor.sync();
                    $('#myform').ajaxSubmit(      //ajax方式提交表单
                        {
                            url: 'save_fw_tmp.php?act=save',
                            type: 'post',
                            dataType: 'json',
                            beforeSubmit: function () {
                            },
                            success: function (data) {
                                if (data.code === 1) {
                                    layer.msg('<?= lang('base_success_content')?>', {
                                        icon: 1,
                                        time: 1000,
                                        shift: -1
                                    }, function () {
                                        location.href = 'list_depot.php';
                                    });
                                } else {
                                    if (typeof(data.msg) == "string") {
                                        layer.msg(data.msg);
                                    } else if (typeof(data.msg) == "object") {
                                        var errmsg = '';
                                        for (var n in data.msg) {
                                            errmsg += data.msg[n] + '<br>';
                                        }
                                        layer.msg(errmsg);
                                    }
                                    setTimeout(function () {
                                        $("#submit").attr('disabled', false)
                                    }, 2000);
                                }
                            },
                            clearForm: false,//禁止清除表单
                            resetForm: false //禁止重置表单
                        });
                    setTimeout(function () {
                        $("#submit").attr('disabled', false)
                    }, 6000);
                });
            });
        });
    </script>
</head>
<body>
<div class="sqbox">
</div>
<section id="container">
    <?php
    require "head.php";
    require "left.php";
    ?>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading"><h3><?= lang('left_tmp_add') ?></h3></header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" enctype="multipart/form-data" name="form1"
                                  method="post" action="?act=save_sys" id="myform" onsubmit="return false;">

                                <input type="hidden" name="id" value="<?= $ruleconfig['id'] ?>"><!-- id -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('security_name') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="name"
                                                                 value="<?= $ruleconfig['name'] ?>" style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "><?= lang('security_name_des') ?></p>
                                    </div>
                                </div><!-- 名称 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('security_hits') ?></label>
                                    <div class="col-sm-2"><select class="form-control open_config" name="if_hits"
                                                                  data-href="#collapseOne"
                                                                  style="width:150px;">
                                            <option value="1"><?= lang('base_open') ?></option>
                                            <option value="0" <?php if (!$ruleconfig['if_hits']) {
                                                echo 'selected';
                                            } ?>><?= lang('base_close') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2"><p
                                                class="help-block red "><?= lang('security_hits_des') ?></p>
                                    </div>
                                </div><!-- 是否开启次数 -->

                                <div class="form-group panel-collapse collapse <?php if ($ruleconfig['if_hits']) {
                                    echo 'in';
                                } ?>" id="collapseOne">
                                    <label class="col-sm-2"></label>
                                    <label
                                            class="col-sm-2 control-label"><?= lang('security_hits_condition') ?></label>
                                    <div class="col-sm-1">
                                        <select class="form-control" name="hits_config[condition]"
                                                style="width:100%;">
                                            <?php
                                            foreach (Rule::hitsCondition() as $k => $v) {
                                                $select = '';
                                                if ($k == $ruleconfig['hits_config']['condition']) {
                                                    $select = 'selected';
                                                }
                                                echo sprintf('<option value="%s" %s >%s</option>', $k, $select, $v);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" name="hits_config[value]"
                                               value="<?= $ruleconfig['hits_config']['value'] ?>"
                                               style="width:100%;"
                                               onkeyup="value=value.replace(/[^12.34567890]+/g,'')">
                                    </div>
                                    <label class="col-sm-1 control-label"><?= lang('base_times') ?></label>
                                </div><!-- 点击次数配置 -->

                                <div class="form-group"
                                     style="border-bottom: 1px solid #eff2f7;padding-bottom: 15px;margin-bottom: 15px;">
                                    <label
                                            class="col-sm-2 control-label"><?= lang('security_res') ?></label>
                                    <div class="col-sm-2"><select class="form-control open_config" name="if_view"
                                                                  data-href="#collapseFour"
                                                                  style="width:150px;">
                                            <option value="1"><?= lang('base_show') ?></option>
                                            <option value="0" <?php if (!$ruleconfig['if_view']) {
                                                echo 'selected';
                                            } ?>><?= lang('base_hide') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "><?= lang('security_res_des') ?></p>
                                    </div>
                                </div><!-- 是否显示防伪结果 -->

                                <div class="form-group panel-collapse collapse <?php if ($ruleconfig['if_view']) {
                                    echo 'in';
                                } ?>" id="collapseFour">
                                    <label
                                            class="col-sm-2 control-label"><?= lang('security_search') ?></label>
                                    <div class="col-sm-8">
                          <textarea name="view_config" id="view_tmp" rows="6"
                                    style="width:680px;height:280px;">
                                <?= $ruleconfig['view_config'] ?>
                                </textarea>
                                    </div>
                                </div><!-- 防伪结果内容 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('security_enable') ?></label>
                                    <div class="col-sm-2"><select class="form-control" name="if_enable"
                                                                  style="width:150px;">
                                            <option value="1"><?= lang('base_enable') ?></option>
                                            <option value="0" <?php if (!$ruleconfig['if_enable']) {
                                                echo 'selected';
                                            } ?>><?= lang('base_close') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "><?= lang('security_enable_des') ?></p>
                                    </div>
                                </div><!-- 是否启用 -->

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="submit" id="submit"><i
                                                    class=" icon-ok"></i><?= lang('base_button_save') ?></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</section>
<script src="<?= $cf['manage_themes'] ?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.dcjqaccordion.2.7.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.tagsinput.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/ga.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.form.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"
        type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"
        type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"
        type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/respond.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/common-scripts.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/form-component.js" type="text/javascript"></script>
</body>
</html>

