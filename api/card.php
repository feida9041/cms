<?php
require_once('../data/conn.php');
$conn = @mysql_connect($db_host, $db_user, $db_pwd);
mysql_query('SET NAMES utf8', $conn);
mysql_query("SET CHARACTER_SET_CLIENT='utf8'", $conn);
mysql_query("SET CHARACTER_SET_RESULTS='utf8'", $conn);
date_default_timezone_set('Asia/Shanghai');//用户当前时区的当前时间为中国上海
if (!$conn) {
    die('DB connect error !');
}
mysql_select_db($db_name, $conn);
require_once('../data/function.php');
try {
    if (IS_POST) {     //修改
        $userService = new UserService();
        $openid = trim($_GET['openid']);
        $pass = trim($_GET['token']);
        $userService->openid = $openid;
        $userService->password = $pass;
        $userinfo = $userService->check();
        if (!$userinfo) {
            throw new \Exception(lang('LOGIN_FAILED'));
        }
        $service = new CardService();
        $data = $_POST;
        $service->openid = $openid;
        $service->setData($data);
        if (!$service->validate()) {
            outPut(apiErrorMsg(['msg' => implode(';', $service->errorList)]));
        }
        if ($service->create()) {
            output(apiSuccessMsg('card.create', 'ok!'));
        }
        throw new \Exception(lang('CREATE_FAILED'));
    }
    throw new \Exception(lang('API_NOT_FOUND'));
} catch (Exception $e) {
    output(apiErrorMsg(['msg' => $e->getMessage()]));
}
