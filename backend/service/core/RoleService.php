<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 15:13
 */

namespace backend\service\core;


use app\models\AlphaMenu;
use app\models\AlphaRole;
use common\helps\Validate;
use yii\helpers\ArrayHelper;

class RoleService extends AuthService
{

    public static function add(array $postData):bool
    {
        $flag = false;
        try {
            $model = new AlphaRole();
            $model->status = !empty($postData['status'])?$postData['status']:AlphaRole::STOP;
            $model->create_time = time();
            $model->load($postData);
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function del(int $id): bool
    {
        $flag = false;
        try {
            AlphaRole::deleteAll(['id' => $id]);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function getOne(int $id):array
    {
        //所有菜单
        $res = AlphaMenu::find()
            ->asArray()
            ->orderBy('id desc')
            ->select('parentid,id,name,listorder')
            ->all();
        $menuList = get_tree_array($res, 'parentid');
        $menuList = my_sort($menuList, 'listorder', SORT_DESC);

        $role = AlphaRole::find()
                ->asArray()
                ->where(['id'=>$id])
                ->one();
        $role['rules'] = explode(",", $role['rules']);
        $role['menuList'] = $menuList;
        //首页显示菜单
        $onlyMenu = AlphaMenu::find()
            ->asArray()
            ->where(['type' => AlphaMenu::ONLY_MENU])
            ->select('id,name,parentid,nav_list')
            ->all();

        $onlyMenu = menu_left($onlyMenu, 'id', 'parentid');
        $role['menus'] = $onlyMenu;
        return $role;
    }

    public static function Edit(array $postData):bool
    {
        $flag = false;
        try {
            $OneRoleModel = AlphaRole::findOne($postData['id']);
            $OneRoleModel->nav_list = $postData['nav_list'];
            $OneRoleModel->rules = implode(",",$postData['rules']);
            $OneRoleModel->status= !empty($postData['status']) ? $postData['status'] : AlphaRole::STOP;

            $OneRoleModel->load($postData);
            if (!$OneRoleModel->save()) {
                throw new \Exception(current($OneRoleModel->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }
}