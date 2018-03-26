<?php
error_reporting(0);
session_start();
require "../data/head.php";
require "../data/session.php";
$sidmenu = "depot";
$submenu = "listdepot";
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

        function CheckAll(form) {
            for (var i = 0; i < form.elements.length; i++) {
                var e = form.elements[i];
                if (e.Name != "chkAll" && e.disabled == false)
                    e.checked = form.chkAll.checked;
            }
        }

        function CheckAll2(form) {
            for (var i = 0; i < form.elements.length; i++) {
                var e = form.elements[i];
                if (e.Name != "chkAll2" && e.disabled == false)
                    e.checked = form.chkAll2.checked;
            }

        }

        function ConfirmDel() {
            if (document.myform.Action.value == "del_tmp") {
                document.myform.action = "?act=del_tmp";
                var obj = $('#myform').find('[name="chk[]"]');
                var check_val = [];
                for (k in obj) {
                    if (obj[k].checked)
                        check_val.push(obj[k].value);
                }
                deleteTmp(check_val);
                return false;
            }
        }

        function deleteTmp(id) {
            if (confirm("<?= lang('base_delete_confirm')?>")) {
                $.ajax({
                    url: 'save_fw_tmp.php?act=delete',
                    data: {id: id},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data.code === 1) {
                            layer.msg('<?= lang('base_success_content')?>', {
                                icon: 1,
                                time: 1000,
                                shift: -1
                            }, function () {
                                location.href = '';
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
                        }
                    },
                })
            } else {
                return false;
            }
        }
    </script>
</head>
<body>
<section id="container">
    <?php
    require "head.php";
    require "left.php";
    $lists = [];
    $rule_name = trim($_REQUEST["pro_name"]);
    $sql = "select id,name,if_warning,if_enable,if_update,sort from tgs_tmp_rule where 1";

    if ($rule_name != "") {
        $sql .= " and  `name` like '%$rule_name%'";
    }

    $sql .= " order by sort ";
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
    while ($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $i++;
        if ($pagesize < $i) {
            break;
        }
        $lists[] = $arr;
    }
    ?>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form action="?" method="post" name="form1" class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only"><?= lang('security_name') ?></label>
                                    <input type="text" name="pro_name" class="form-control" style="width:220px;"
                                           placeholder="<?= lang('security_name') ?> "/>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="icon-zoom-in"></i><?= lang('base_search') ?></button>
                                <a href="?">
                                    <button class="btn btn-default" type="button">
                                        <i class="icon-refresh"></i> <?= lang('base_refresh') ?></button>
                                </a>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!--顶部快速搜索结束 -->
            <form method="post" name="myform" id="myform" action="?" onSubmit="return ConfirmDel();">
                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading"><h4><?= lang('security_list') ?></h4></header>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                <tr>
                                    <th><INPUT TYPE="checkbox" NAME="chkAll" id="chkAll"
                                               title="<?= lang('base_select_all') ?>" onclick="CheckAll(this.form)">
                                    </th>
                                    <th>ID</th>
                                    <th><?= lang('security_name') ?></th>
                                    <th><?= lang('security_sort') ?></th>
                                    <th><?= lang('code_if_qiyong') ?></th>
                                    <th><?= lang('base_preview') ?></th>
                                    <th><?= lang('base_operate') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $lan_arr = [
                                    0 => lang('base_close'),
                                    1 => lang('base_open'),
                                ];
                                $enable_arr = [
                                    0 => lang('base_close'),
                                    1 => lang('base_enable'),
                                ];

                                foreach ($lists as $list) {
                                    if ($list['if_update']) {
                                        echo '<tr><td><input name="chk[]" type="checkbox" id="chk[]" value="';
                                        echo $list['id'];
                                        echo '"></td><td>';
                                    } else {
                                        echo '<tr><td><i class="icon-lock  red"></i></td><td>';
                                    }
                                    echo $list['id'];
                                    echo '</td><td>';
                                    echo $list['name'];
                                    echo '</td><td>';
                                    echo $list['sort'];
                                    echo '</td><td>';
                                    echo $enable_arr[$list['if_enable']];
                                    echo '</td><td>';
                                    echo '<span onclick="ew80_cplist';
                                    echo $list['id'];
                                    echo '()" class="ew80_ontext "><i class="icon-eye-open" ></i>' . lang('base_preview') . '</span></td>
                                    <script>function ew80_cplist';
                                    echo $list['id'];
                                    echo '(){
                                    layer.open({
                                    type: 2,
                                    title: \'' . lang('base_preview') . '\',
                                    skin: "layui-layer-rim", //加上边框
                                    area: ["600px", "640px"], //宽高
                                    content: "../ts/view_qrcode.php?act=view&id=';
                                    echo $list['id'];
                                    echo '"});}</script>';
                                    echo '<td><a href="set_fw.php?id=';
                                    echo $list['id'];
                                    echo '" class="label label-success label-mini" ><i class="icon-ok"></i>' . lang('base_edit') . '</a> ';
                                    if ($list['if_update']) {
//                                        echo '<a href="?act=delete_tmp&id=';
                                        echo '<a href="#" onclick="deleteTmp([' . $list['id'] . '])" data-id="';
                                        echo $list['id'];
                                        echo '" class="label label-danger label-mini" ><i class=" icon-remove-sign"></i> ' . lang('base_delete') . '</a>';
                                    }
                                    echo '</td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <div style="margin-top:10px;"></div>
                            <section class="panel">
                                <header class="panel-heading">
                                    <button type="submit" name="check" id="del" class="btn btn-danger"
                                            onClick="document.myform.Action.value='del_tmp'">
                                        <i class=" icon-remove-sign"></i> <?= lang('base_delete_submit') ?> </button>
                                    <input name="Action" type="hidden" id="Action" value="">
                                </header>
                                <div class='text-center'>
                                    <ul class='pagination'>
                                        <?php
                                        echo '<li><a>';
                                        echo sprintf(lang('base_page_total'), $totalpage, $currpage, $total);
                                        echo '&nbsp;</a></li><li>';

                                        if ($currpage == 1) {
                                            echo '<a>' . lang('base_home') . '</a>&nbsp; </li></li><li><a>' . lang('base_page_fenye_title3') . '</a></li>';
                                        } else {
                                            echo '<li><a href="';
                                            echo $filename;
                                            echo '&page=1">' . lang('base_home') . '</a></li><li><a href="';
                                            echo $filename;
                                            echo '&page=';
                                            echo $currpage - 1;
                                            echo '">' . lang('base_page_fenye_title3') . '</a></li>';
                                        }

                                        if ($currpage == $totalpage) {
                                            echo '<li><a>' . lang('base_page_fenye_title4') . '</a></li></li><li><a>' . lang('base_shadowe') . '</a></li>';
                                        } else {
                                            echo '<li><a href="';
                                            echo $filename;
                                            echo '&page=';
                                            echo $currpage + 1;
                                            echo '">' . lang('base_page_fenye_title4') . '</a></li><li><a href="';
                                            echo $filename;
                                            echo '&page=';
                                            echo $totalpage;
                                            echo '">' . lang('base_shadowe') . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
            </form>
        </section>
    </section>
</section>
<script src="<?= $cf["manage_themes"] ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script class="include" src="<?= $cf["manage_themes"] ?>/js/jquery.dcjqaccordion.2.7.js"
        type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/jquery.tagsinput.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/ga.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"
        type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"
        type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"
        type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/respond.min.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/common-scripts.js" type="text/javascript"></script>
<script src="<?= $cf["manage_themes"] ?>/js/form-component.js" type="text/javascript"></script>
</body>
</html>

