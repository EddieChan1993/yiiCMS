<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 10:21
 */
namespace common\service;

class BaseService
{
    private static $err;

    public static function getErr()
    {
        return self::$err;
    }

    protected static function setErr($err)
    {
        $str = sprintf("%s[%s:%s]",$err->getMessage(),$err->getFile(),$err->getLine());
        \Yii::warning($str);
        self::$err = $err->getMessage();
    }
}