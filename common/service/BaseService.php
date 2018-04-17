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
        self::$err = $err->getMessage();
    }
}