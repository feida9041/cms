<!DOCTYPE html>
<html lang="zh">
<body>
<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div data-original-title="<?= lang('head_click_hidden') ?>" data-placement="right"
             class="icon-reorder tooltips"></div>
    </div>
    <!--logo start-->
    <div class="nav notify-row">
        <a href="main.php" class="logo"><span><?= $cf["site_name"] ?></span></a>
    </div>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
            <!-- 切换前后台开始 -->
            <li class="dropdown">
                <a href="../" target="_blank"> <i class="  icon-home"></i> <span
                            style="font-size:15px"><?= lang('head_browse_dashboard') ?></span>
                    <span class="badge bg-success"></span></a>
            </li>
            <!-- 切换前后台结束-->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!--  <li>
            <input type="text" class="form-control search" placeholder="Search">
            </li>-->
            <!-- user login dropdown start-->
            <?php
            $sql = mysql_query("SELECT * FROM  tgs_admin  where username='" . $_SESSION[Adminname] . "' limit 1 ");
            $arr = mysql_fetch_array($sql);
            $glyxm = $arr["glyxm"];
            $admin_pic = $arr["admin_pic"];
            $myids = $arr["id"];
            ?>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img src="<?php

                    if ($admin_pic == "") {
                        echo "/upload/image/noface.jpg";
                    } else {
                        echo $admin_pic;
                    }

                    ?>" alt="<?= lang('head_admin_avatar') ?>" style="width:25px; height:25px;">
                    <span class="username">

<?php
echo $glyxm;
echo "";
$glqx = $_SESSION[glqx];

switch ($glqx) {
    case 1:
        echo "[ " . lang('head_admin') . " ]";
        break;

    case 2:
        echo "[ " . lang('head_operator') . " ]";
        break;

    case 3:
        echo "[ " . lang('head_messenger') . " ]";
        break;

    default:
        echo "<script>location.href='index.php' ;</script>";
}

?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="edit_admin.php?act=edit_admin&id=<?php
                        echo $myids;
                        ?>">
                            <i class=" icon-suitcase"></i><?= lang('head_modify_data') ?></a>
                    </li>
                    <li><a href="set_sys.php"><i class="icon-cog"></i> <?= lang('head_settings') ?></a></li>
                    <li><a href="./index.php" target="_blank"><i
                                    class=" icon-home"></i><?= lang('head_sys_reception') ?></a></li>
                    <li><a href="index.php?act=logout"><i class="icon-key"></i><?= lang('head_exit') ?></a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
</body>
</html>
