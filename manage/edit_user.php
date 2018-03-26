<?php
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "admin";
$submenu = "edituser";
$act = $_GET["act"];
$userid = $_GET["id"];
$userservice = new UserService();
if (IS_POST) {
    $userservice->id = trim($_POST['id']);
    $userservice->setData($_POST);
    if ($userservice->updateAll()) {
        outPut(success_msg(lang('base_success_content')));
    }
    outPut(error_msg(lang('base_save_failed')));
}
$userservice->id = $userid;
$userinfo = $userservice->get();
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
                K.create('', {
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
                            imageUrl: K('#avatarpic').val(),
                            clickFn: function (url, title, width, height, border, align) {
                                K('#avatarpic').val(url);
                                editor.hideDialog();
                            }
                        });
                    });
                });
            });

            $("#submit").on("click", function () {
                $(this).attr('disabled', true);
                $('#myform').ajaxSubmit(      //ajax方式提交表单
                    {
                        url: '',
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
                                    location.href = 'list_user.php';
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
                        <header class="panel-heading"><h3><?= lang('user_edit') ?></h3></header>
                        <div class="panel-body">
                            <form class="form-horizontal tasi-form" enctype="multipart/form-data" name="form1"
                                  method="post" action="?act=save_sys" id="myform" onsubmit="return false;">

                                <input type="hidden" name="id" value="<?= $userinfo['id'] ?>"><!-- id -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_openid') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control"
                                                                 value="<?= $userinfo['openid'] ?>"
                                                                 style="width:100%;" readonly>
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- openid -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_name') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="nick_name"
                                                                 value="<?= $userinfo['nick_name'] ?>"
                                                                 style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 昵称 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_true_name') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="true_name"
                                                                 value="<?= $userinfo['true_name'] ?>"
                                                                 style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 真实姓名 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_tel') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="tel"
                                                                 value="<?= $userinfo['tel'] ?>" style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 电话 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_city') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="city"
                                                                 value="<?= $userinfo['city'] ?>" style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 城市 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_province') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="province"
                                                                 value="<?= $userinfo['province'] ?>"
                                                                 style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 省份 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_country') ?></label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="country"
                                                                 value="<?= $userinfo['country'] ?>"
                                                                 style="width:100%;">
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 国家 -->

                                <div class="form-group"><label
                                            class="col-sm-2 col-sm-2 control-label"><?= lang('user_avatar') ?></label>
                                    <div class="col-sm-4"><input type="text" id="avatarpic" class=" form-control"
                                                                 name="avatar" value="<?= $userinfo['avatar'] ?>"
                                                                 style="width:100%;"></div>
                                    <div class="col-sm-2"><input type="button" id="uppic" class="btn btn-success"
                                                                 value="<?= lang('base_select_pic') ?>"/></div>
                                    <div class="col-sm-3"><p class="help-block"></p></div>
                                </div><!-- 头像地址 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_gender') ?></label>
                                    <div class="col-sm-2"><select class="form-control" name="gender"
                                                                  style="width:150px;">
                                            <option value="1"><?= lang('base_male') ?></option>
                                            <option value="0" <?php if (!$userinfo['gender']) {
                                                echo 'selected';
                                            } ?>><?= lang('base_female') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "></p>
                                    </div>
                                </div><!-- 性别 -->

                                <div class="form-group"><label
                                            class="col-sm-2 control-label"><?= lang('user_if_show') ?></label>
                                    <div class="col-sm-2"><select class="form-control" name="if_show"
                                                                  style="width:150px;">
                                            <option value="1"><?= lang('base_show') ?></option>
                                            <option value="0" <?php if (!$userinfo['if_show']) {
                                                echo 'selected';
                                            } ?>><?= lang('base_hide') ?></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8"><p
                                                class="help-block red "><?= lang('user_if_show_des') ?></p>
                                    </div>
                                </div><!-- 是否展示隐藏 -->

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
<script src="<?= $cf['manage_themes'] ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= $cf['manage_themes'] ?>/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script class="include" src="<?= $cf['manage_themes'] ?>/js/jquery.dcjqaccordion.2.7.js"
        type="text/javascript"></script>
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

