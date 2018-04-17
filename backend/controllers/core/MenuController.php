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
        $getData = Yii::$app->request->get();
        $res=MenuService::menuList($getData);
        return $this->render('index', $res);
    }
}