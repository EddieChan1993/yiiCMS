<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 14:39
 */

namespace backend\controllers\core;


use app\models\AlphaRole;
use app\models\AlphaUsers;
use backend\service\core\CurdService;
use backend\service\core\RoleService;

class RoleController extends BaseController
{
    function beforeAction($action)
    {
        self::setTitle("角色管理");
        self::setTab1("角色列表");
        self::setTab2("添加角色");
        CurdService::setCTimeKey("create_time");
        CurdService::setModel(AlphaRole::tableName());
        CurdService::setModelNameForm("AlphaRole");
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    function actionAdd()
    {
        $postData = \Yii::$app->request->post();
        $res = RoleService::add($postData);
        if (!$res) {
            self::warning(RoleService::getErr());
        }
        self::output("角色添加成功");
    }

    function actionDel()
    {
        $getData = \Yii::$app->request->get();
        $res = RoleService::del($getData['id']);
        if (!$res) {
            self::warning(RoleService::getErr());
        }
        self::output("角色删除成功");
    }

    function actionEdit()
    {
        $req = \Yii::$app->request;
        if ($req->isPost) {

        }else{
            $getData = $req->get();
            $res = RoleService::getOne($getData->id);
            return $this->render('edit', $res);
        }
    }
}