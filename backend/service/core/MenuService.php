<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 19:44
 */

namespace backend\service\core;


use app\models\AlphaMenu;
use common\helps\Validate;

class MenuService extends AuthService
{
    public static function lists($getData): array
    {
        $menuList = AlphaMenu::find()
            ->asArray()
            ->all();
        $menuList = menu_left($menuList, 'id', 'parentid');

        $menuNum = AlphaMenu::find()->count();
        $menuMap = [
            'menu_nums' => $menuNum,
            'menu_list' => $menuList,
        ];
        if (!empty($getData['id'])) {
            $menuMap['menuChild'] = $getData['id'];
        }
        $flag = $menuMap;
        return $flag;
    }

    public static function add(array $postData):bool
    {
        $flag = false;
        try {
            $menuModel = new AlphaMenu();
            $menuModel->controller = $postData['controller'];
            $menuModel->method = $postData['method'];
            $menuModel->remark = $postData['remark'];
            $menuModel->name = $postData['name'];
            $menuModel->parentid = $postData['parentid'];
            $menuModel->icon = $postData['icon'];
            $menuModel->type = $postData['type'];
            $menuModel->status = !empty($postData['status']) ? $postData['status'] : AlphaMenu::STOP;

            if (!$menuModel->save()) {
                throw new \Exception(current($menuModel->getFirstErrors()));
            }

            $menuModel->nav_list = get_menu_nav($menuModel->id, $postData['parentid']);
            if (!$menuModel->save()) {
                throw new \Exception(current($menuModel->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function getOne(array $getData):array
    {
        $menuList = AlphaMenu::find()
            ->asArray()
            ->all();
        $menuList = menu_left($menuList, 'id', 'parentid');
        $menus = AlphaMenu::find()
            ->where(['id'=>$getData['id']])
            ->asArray()
            ->one();
        $menuMap = $menus;
        $menuMap['menu_list'] = $menuList;

        return $menuMap;
    }

    public static function edit(array $postData):bool
    {
        $flag = false;
        try {
            $menuModel = AlphaMenu::findOne($postData['id']);
            $menuModel->controller = $postData['controller'];
            $menuModel->method = $postData['method'];
            $menuModel->remark = $postData['remark'];
            $menuModel->name = $postData['name'];
            $menuModel->parentid = $postData['parentid'];
            $menuModel->icon = $postData['icon'];
            $menuModel->type = $postData['type'];
            $menuModel->status = !empty($postData['status']) ? $postData['status'] : AlphaMenu::STOP;

            if (!$menuModel->save()) {
                throw new \Exception(current($menuModel->getFirstErrors()));
            }

            $menuModel->nav_list = get_menu_nav($menuModel->id, $postData['parentid']);
            if (!$menuModel->save()) {
                throw new \Exception(current($menuModel->getFirstErrors()));
            }
            $flag = true;

        } catch (\Exception $e) {
            self::setErr($e);
        }

        return $flag;
    }

    public static function del(array $getData):bool
    {
        $flag = false;
        try {
            $childMenu = AlphaMenu::find()
                ->where(['parentid' => $getData['id']])
                ->exists();
            if (!empty($childMenu)) {
                throw new \Exception("当前菜单下存在子菜单,请谨慎操作");
            }

            AlphaMenu::deleteAll(['id'=>$getData['id']]);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function updateOrder(array $postData):bool
    {
        $flag = false;
        try {
            AlphaMenu::updateAll(['listorder' => $postData['listorder']], ['id' => $postData['id']]);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

}