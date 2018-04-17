<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 15:36
 */

namespace backend\service\core;


use app\models\AlphaRole;
use app\models\AlphaRoleUser;
use app\models\AlphaUsers;
use backend\assets\AppAsset;
use common\helps\AuthE;
use Yii;

class InitService extends AuthService
{
    public static function InitAdminData()
    {
        self::authMenu();
        self::menuNavList();
        self::adminUserInfo();
    }

    /**
     * 获取权限菜单
     */
    private static function authMenu()
    {
        $auth = new AuthE();
        $menuAuth=$auth->getAuthMenu(self::$uid);
        $menuAuth = my_sort($menuAuth, 'listorder', SORT_DESC);
        Yii::$app->view->params['menuAuth'] = $menuAuth;
    }

    /**
     * 获取当前所在菜单位置
     */
    private static function menuNavList()
    {
        $name=AlphaUsers::find()
            ->asArray()
            ->alias('u')
            ->leftJoin(AlphaRoleUser::tableName().' AS ra', 'ra.user_id=u.id')
            ->leftJoin(AlphaRole::tableName().' AS r', 'r.id=ra.role_id')
            ->select('nav_list')
            ->where(['ra.user_id'=>self::$uid])
            ->one();
        $name = explode('-', $name['nav_list']);
        Yii::$app->view->params['menuNavList'] = $name;
    }

    /**
     * 获取后台管理员相关信息
     */
    private static function adminUserInfo()
    {
        $adminUserInfo = AlphaUsers::find()
            ->where(['id' => self::$uid])
            ->select('user_login,avatar')
            ->one();
        Yii::$app->view->params['user_login'] = $adminUserInfo->user_login;
        $img = $adminUserInfo->avatar;
        if (empty($img)) {
            $img = Yii::getAlias("@web").'/upload/admin/common/upload.svg';
        }
        Yii::$app->view->params['avatar'] = $img;

        $name=AlphaRole::find()
            ->asArray()
            ->alias('r')
            ->leftJoin(AlphaRoleUser::tableName().' AS ra', 'r.id=ra.role_id')
            ->select('name')
            ->where(['ra.user_id'=>self::$uid])
            ->one();
        Yii::$app->view->params['role_name'] = $name['name'];
    }
}