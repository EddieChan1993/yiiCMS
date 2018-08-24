<?php
namespace common\helps;

use backend\service\core\CurdService;


class FormE
{
    /**
     * input插件
     * @param $name
     * @param null $value
     * @param string $type
     * @return string
     */
    public static function input($name, $value=null, $type='text')
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        return sprintf('<input type="%s" value="%s" name="%s" class="form-control"/>',$type,$value,$formModelName);
    }

    /**
     * textarea标签
     * @param $name
     * @param null $value
     * @param int $rows
     * @return string
     */
    public static function textArea($name, $value=null, $rows=5)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        return sprintf(' <textarea class="form-control" name="%s" rows="%s">%s</textarea>',$formModelName,$rows,$value);
    }

    /**
     * tag标签
     * @param $name
     * @param null $value
     * @return string
     */
    public static function tag($name, $value = null)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        return sprintf('<input type="text" name="%s" class="tagsinput" value="%s"/>',$formModelName,$value);
    }

    /**
     * select插件
     * @param $key
     * @param array $keyMapValue
     * @param null $selected
     * @param string $dataStyle
     * @param bool $isSearch
     * @return string
     */
    public static function select($key, $keyMapValue=[], $selected=null, $dataStyle="btn-success", $isSearch=false)
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $key);
        $str = sprintf('<select name="%s" class="form-control select" data-style="%s" data-live-search="%b">',$formModelName,$dataStyle,$isSearch);
        foreach ($keyMapValue as $k=>$v){
            $is_selected = is_selected($selected, $k);
            $str .= '<option '.$is_selected.' value="' . $k . '">'.$v.'</option>';
        }
         $str.='</select>';
        return $str;
    }

    /**
     * 单图片上传
     * @param $name input的name
     * @param $value input的value
     * @param string $key 标识区分其他同类
     * @param string $pathName 保存地址前缀
     * @return string
     */
    public static function singleUpload($name, $value=null, $pathName='avatar', $key='inp')
    {
        $formModelName=CurdService::getModelNameForm();
        $formModelName = sprintf("%s[%s]", $formModelName, $name);
        $str = '<div class="gallery">';
        $str .= '<a class="gallery-item"  href="javascript:void(\'\')" title="点击上传" data-gallery>';
        $str .= '<div style="width: 120px" class="image">';
        $str .= sprintf('<input value="%s" hidden name="%s" type="text" id="%s">', $value,$formModelName,$key);
        $str .= sprintf('<img src="%s" alt="图片"/>', is_img($value));
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