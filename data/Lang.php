<?php
defined('APP_PATH') or exit();
class Lang
{
    public static $default = 'cn';
    public static $language = null;
    public static $lang = null;
    public static $lang_file = [
        'cn' => [
            'label'      => '中文',
            'file'       => __DIR__ . '/lang/zh-cn.php',
            'kindEditor' => 'zh_CN',
        ],
        'en' => [
            'label'      => 'English',
            'file'       => __DIR__ . '/lang/en-us.php',
            'kindEditor' => 'en',
        ],
    ];

    public static function setLang($lang)
    {
        if (!isset(static::$lang_file[$lang])) {
            $lang = static::$default;
        }
        static::$lang = null;
        static::$language = $lang;
    }

    public static function getKindEditor()
    {
        if (static::$language === null) {
            static::$language = static::$default;
        }
        return static::$lang_file[static::$language]['kindEditor'];
    }

    public static function get($key)
    {
        if (static::$language === null) {
            static::$language = static::$default;
        }
        if (static::$lang === null) {
            static::$lang = include static::$lang_file[static::$language]['file'];
        }
        if (isset(static::$lang[$key])) {
            return static::$lang[$key];
        }
        return $key;
    }

}