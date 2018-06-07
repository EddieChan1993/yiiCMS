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
     * @param $name input的name
     * @param $value input的value
     * @param string $key 标识区分其他同类
     * @param string $pathName 保存地址前缀
     * @return string
     * @throws \Exception
     */
    public static function SingleUpload($name,$value=null,$pathName='avatar',$key='inp')
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        $str = '<div class="gallery">';
        $str .= '<a class="gallery-item"  href="javascript:void(\'\')" title="点击上传" data-gallery>';
        $str .= '<div style="width: 120px" class="image">';
        $str .= sprintf('<input value="%s" hidden name="%s" type="text" id="%s">', $value,$formModelName,$key);
        $str .= sprintf('<img src="%s" alt="Space picture 2"/>', is_img($value));
        $str .= '<ul class="gallery-item-controls">';
        $str .= sprintf('<li onclick="upload_single(\'%s\',\'%s\')"><i class="fa fa-cloud-upload"></i></li>',$key,$pathName);
//        $str .= '<li onclick="del_pic(\'inp\')"><i class="fa fa-times"></i></li>';
        $str .= ' </ul>';
        $str .= "</div>";
        $str .= '</a>';
        $str .= '</div>';
        return $str;
    }
}