<?php
namespace common\helps;

use backend\service\core\CurdService;


class FormW
{
    //input插件
    public static function Input($key,$value=null,$placeholder=null)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $key);
        return sprintf('<input type="text" placeholder="%s" value="%s" name="%s" class="form-control"/>',$placeholder,$value,$formModelName);
    }

    //textarea插件
    public static function TextArea($key,$rows=5,$value=null)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $key);
        return sprintf(' <textarea class="form-control" name="%s" rows="%s">%s</textarea>',$formModelName,$rows,$value);
    }
}