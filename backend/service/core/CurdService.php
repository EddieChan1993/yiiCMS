<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 16:26
 */

namespace backend\service\core;


class CurdService extends AuthService
{
    //用于表单提交
    private static $modelNameForm;

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getModelNameForm()
    {
        if (empty(self::$modelNameForm)) {
            throw new \Exception("ModelNameForm没有设置");
        }
        return self::$modelNameForm;
    }

    /**
     * @param mixed $modelNameForm
     */
    public static function setModelNameForm($modelNameForm)
    {
        self::$modelNameForm = $modelNameForm;
    }
}