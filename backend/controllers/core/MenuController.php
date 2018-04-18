<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 19:43
 */

namespace backend\controllers\core;


use backend\service\core\MenuService;
use Yii;

class MenuController extends BaseController
{
    function actionIndex()
    {
        self::setTitle("后台菜单");
        self::setTab1("菜单列表");
        self::setTab2("添加菜单");

        $getData = Yii::$app->request->get();
        $res=MenuService::lists($getData);
        return $this->render('index', $res);
    }

    function actionAdd()
    {
        $postData = Yii::$app->request->post();
        $res = MenuService::add($postData);
        if (!$res) {
            self::warning(MenuService::getErr());
        }
        self::output("菜单添加成功");
    }

    function actionEdit()
    {
        $req = Yii::$app->request;
        if ($req->isPost) {
            $postData = $req->post();
            $res = MenuService::edit($postData);
            if (!$res) {
                self::warning(MenuService::getErr());
            }
            self::output("菜单编辑成功");
        }else{
            $getData = $req->get();
            $res = MenuService::getOne($getData);
            return $this->render('edit', $res);
        }
    }

    function actionDel()
    {
        $req = Yii::$app->request;
        $getData = $req->get();
        $res = MenuService::del($getData);
        if (!$res) {
            self::warning(MenuService::getErr());
        }
        self::output("菜单删除成功");
    }

    function actionUpdateOrder()
    {
        $req = Yii::$app->request;
        $postData = $req->post();

        $res = MenuService::updateOrder($postData);
        if (!$res) {
            self::warning(MenuService::getErr());
        }
        self::output("菜单排序编辑成功");
    }

}