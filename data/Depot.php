<?php
defined('APP_PATH') or exit();

/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/26
 * Time: 17:19
 */
class Rule
{
    public $id = null;
    public $errorMsg = [];
    
    public function config()
    {
        return [
        ];
    }

    public function get()
    {
        return [];
    }

    public function check()
    {
        $check = true;
        return $check;
    }

    public function clearError()
    {
        $this->errorMsg = [];
    }

    public function setError($msg)
    {
        array_push($this->errorMsg, $msg);
    }

    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    public function save()
    {
    }

    public function update()
    {
    }

    public function create()
    {
    }

    public function delete($arr)
    {
    }
}