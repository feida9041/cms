<?php
defined('APP_PATH') or exit();

class UserService
{
    public $openid = '';
    public $id = '';
    public $password = '';
    public $nick_name = '';
    public $gender = '';
    public $city = '';
    public $true_name = '';
    public $province = '';
    public $country = '';
    public $avatar = '';
    public $tel = '';
    public $if_show = '';

    public function setData($request)
    {
        $this->nick_name = trim($request['nick_name']);
        $this->gender = trim($request['gender']);
        $this->city = trim($request['city']);
        $this->province = trim($request['province']);
        $this->country = trim($request['country']);
        $this->avatar = trim($request['avatar']);
        $this->tel = trim($request['tel']);
        $this->if_show = trim($request['if_show']);
        $this->true_name = trim($request['true_name']);
    }

    public function check()
    {
        $sql = "SELECT password,tel,nick_name FROM `tgs_user` WHERE openid='$this->openid' AND password='$this->password' LIMIT 1";
        $res = mysql_query($sql);
        return mysql_fetch_array($res, MYSQL_ASSOC);
    }

    public function login()
    {
        $sql = 'SELECT password,tel,nick_name FROM `tgs_user` WHERE openid=\'' . $this->openid . '\' LIMIT 1';
        $res = mysql_query($sql);
        $info = mysql_fetch_array($res, MYSQL_ASSOC);
        if ($info) {
            return $info;
        } else {
            $pass = create_guid();
            $time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `tgs_user` (openid,password,nick_name,gender,city,country,province,avatar,add_date) VALUES ('$this->openid','$pass','$this->nick_name','$this->gender','$this->city','$this->country','$this->province','$this->avatar','$time')";
            mysql_query($sql);
            if (mysql_affected_rows()) {
                return [
                    'password'  => $pass,
                    'tel'       => null,
                    'user_name' => $this->nick_name,
                ];
            }
        }
    }

    public function update()
    {
        $sql = "UPDATE tgs_user set tel='$this->tel',nick_name='$this->nick_name' WHERE openid='$this->openid'";
        mysql_query($sql);
        return mysql_affected_rows() >= 0 ? true : false;
    }

    public function updateAll()
    {
        $sql = "UPDATE tgs_user set true_name='$this->true_name',if_show='$this->if_show',avatar='$this->avatar',country='$this->country',province='$this->province',city='$this->city',gender='$this->gender',tel='$this->tel',nick_name='$this->nick_name' WHERE id='$this->id'";
        mysql_query($sql);
        return mysql_affected_rows() >= 0 ? true : false;
    }

    public function get()
    {
        $sql = 'SELECT * FROM `tgs_user` WHERE id=' . $this->id . ' LIMIT 1';
        $res = mysql_query($sql);
        return mysql_fetch_array($res, MYSQL_ASSOC);
    }

}