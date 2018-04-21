<?php
namespace common\helps;

use backend\service\core\CurdService;


class FormW
{
    //input插件
    public static function Input($name, $value=null, $type='text')
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        return sprintf('<input type="%s" value="%s" name="%s" class="form-control"/>',$type,$value,$formModelName);
    }

    //textarea插件
    public static function TextArea($name, $rows=5, $value=null)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        return sprintf(' <textarea class="form-control" name="%s" rows="%s">%s</textarea>',$formModelName,$rows,$value);
    }

    //select插件
    public static function Select($key,$keyMapValue=[],$selected=null)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $key);
        $str = sprintf('<select name="%s" class="form-control select">',$formModelName);
        foreach ($keyMapValue as $k=>$v){
            $is_selected = is_selected($selected, $k);
            $str .= '<option '.$is_selected.' value="' . $k . '">'.$v.'</option>';
        }
         $str.='</select>';
        return $str;
    }

    /**
     * 图片上传
     * @param $value input的value
     * @param $name input的name
     * @param $key 关键字，用于区分
     * @return string
     */
    public static function SingleUpload($name,$value,$key)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        $str = '<div class="gallery">';
        $str .= '<a class="gallery-item"  href="javascript:void(\'\')" title="Space picture 2" data-gallery>';
        $str .= '<div style="width: 150px" class="image">';
        $str .= sprintf('<input value="%s" hidden name="%s" type="text" id="inp">', $value,$formModelName);
        $str .= sprintf('<img src="%s" alt="Space picture 2"/>', is_img($value));
        $str .= '<ul class="gallery-item-controls">';
        $str .= '<li onclick="upload_single(\'inp\',\'avatar\')"><i class="fa fa-cloud-upload"></i></li>';
        $str .= '<li onclick="del_pic(\'inp\')"><i class="fa fa-times"></i></li>';
        $str .= ' </ul>';
        $str .= "</div>";
        $str .= '</a>';
        $str .= '</div>';
        return $str;
    }
}