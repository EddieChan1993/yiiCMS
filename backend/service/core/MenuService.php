<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 19:44
 */

namespace backend\service\core;


use app\models\AlphaMenu;

class MenuService extends AuthService
{
    public static function menuList($getData): array
    {
        $menuList = AlphaMenu::find()
            ->asArray()
            ->all();
        $menuList = menu_left($menuList, 'id', 'parentid');
        $menuNum = AlphaMenu::find()->count();
        $menuMap = [
            'menu_nums' => $menuNum,
            'menu_list' => $menuList
        ];
        if (!empty($getData['id'])) {
            $menuMap['menuChild'] = $getData['id'];
        }
        $flag = $menuMap;
        return $flag;
    }
}