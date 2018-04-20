<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 16:53
 */

namespace backend\controllers\core;


use app\models\AlphaRole;
use app\models\AlphaRoleUser;
use app\models\AlphaUsers;
use backend\service\core\AdminService;
use backend\service\core\AuthService;
use backend\service\core\CurdService;
use common\extend\TencentCos;
use yii\helpers\ArrayHelper;

class AdminController extends BaseController
{
    function beforeAction($action)
    {
        self::setTitle("管理员");
        self::setTab1("管理员列表");
        self::setTab2("添加管理员");

        CurdService::setModelNameForm('AlphaUsers');
        CurdService::setModel(AlphaUsers::tableName());
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * @throws \Exception
     */
    function actionIndex()
    {
        $res=CurdService::getDataList($_GET,'*','create_time');
        $res['uid'] = AuthService::getUid();

        $res['roleArr'] = AdminService::getRoleList();
        return $this->render('index',$res);
    }

    function actionAdd()
    {
        $req = \Yii::$app->request;
        $res = AdminService::add($req->post());
        if (!$res) {
            self::warning(AdminService::getErr());
        }
        self::output("管理员账号添加成功");
    }

    function actionEdit()
    {
        $req = \Yii::$app->request;
        if ($req->isPost) {
            $res = AdminService::editSelf($req->post());
            if (!$res) {
                self::warning(AdminService::getErr());
            }
            self::output("管理员账号编辑成功");
        }else{
            $getData = $req->get();
            $res = AdminService::getOne($getData['id']);
            return $this->render('edit',$res);
        }
    }


    //编辑个人资料
    function actionEditSelf()
    {
        $req = \Yii::$app->request;
        if ($req->isPost) {
            $res = AdminService::editSelf($req->post());
            if (!$res) {
                self::warning(AdminService::getErr());
            }
            self::output("管理员账号编辑成功");
        }else{
            $res = AdminService::getOne();
            return $this->render('edit-self',$res);
        }
    }

    function actionDel()
    {
        $req = \Yii::$app->request;
        $getData = $req->get();
        $res = AdminService::del($getData['id']);
        if (!$res) {
            self::warning(AdminService::getErr());
        }
        self::output("管理员账号删除成功");
    }
}