<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 20:16
 */
/**
 * 菜单类型
 * @param $name
 * @param $type
 * @return string
 */
function menu_type($name,$type)
{
    if ($type == 0) {
        return '<span class="label label-default">'.$name.'</span>';
    } elseif ($type == 1) {
        return '<span class="label label-warning">'.$name.'</span>';
    }
}


/**
 * 是否禁用
 * @param $type
 * @return string
 */
function is_stop($type)
{
    if ($type == 0) {
        return '<span class="label label-danger">非正常</span>';
    } elseif ($type == 1) {
        return '<span class="label label-success">正常</span>';
    }
}

/**
 * select框是否选中
 * @param $select_id
 * @param $id
 * @return string
 */
function is_selected($select_id, $id)
{
    return $select_id == $id ? 'selected' : '';
}