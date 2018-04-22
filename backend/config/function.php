<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 20:16
 */

use app\models\AlphaMenu;
use app\models\AlphaRole;
use app\models\AlphaRoleUser;
use backend\controllers\core\BaseController;
use yii\widgets\LinkPager;

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


/**
 * 获取菜单导航
 * @param $menu_id
 * @param $parend_id
 * @return string
 */
function get_menu_nav($menu_id,$parend_id)
{
    $parend_nav = AlphaMenu::find()
        ->where(['id' => $parend_id])
        ->select('nav_list')
        ->one();
    if (empty($parend_nav)) {
        $nav =$menu_id."";
    }else{
        $parent_nav = $parend_nav->nav_list;
        $nav = '';
        if (!empty($parent_nav)) {
            $nav .=$parent_nav.'-';
        }
        $nav .=$menu_id;
    }
    return $nav;
}

/**
 * checked是否选中
 * @param $is_ok
 * @return string
 */
function is_checked($is_ok)
{
    return $is_ok ? 'checked' : '';
}

function getPageWidge($page)
{
    return LinkPager::widget([
        'pagination' => $page,
        'nextPageLabel' => '下一页',
        'prevPageLabel' => '上一页',
        'firstPageLabel' => '首页',
        'lastPageLabel' => '尾页',
        'options' => ['class' => 'pagination pagination-sm pull-right'],
    ]);
}

/**
 * 默认图片
 * @param $img
 * @return string
 */
function is_img($img)
{
    $imgExa = Yii::getAlias("@web").'/upload/admin/common/upload.svg';
    return !empty($img) ? $img : $imgExa;
}

/**
 * 获取管理员角色
 * @param $uid
 * @return mixed
 */
function get_role($uid)
{
    $name=AlphaRole::find()
        ->asArray()
        ->alias('r')
        ->leftJoin(AlphaRoleUser::tableName().' AS ra', 'r.id=ra.role_id')
        ->select('name')
        ->where(['ra.user_id'=>$uid])
        ->one();
    if (empty($name)) {
        return "";
    }
    return $name['name'];
}

/**
 * 获取用户信息
 * @param $user_id
 * @return array|false|PDOStatement|string|\think\Model
 */
function get_users($user_id)
{
    $adminInfo = \app\models\AlphaUsers::find()
        ->select('user_login')
        ->where(['id'=>$user_id])
        ->one();
    if (empty($adminInfo)) {
        return "";
    }
    return $adminInfo->user_login;
}