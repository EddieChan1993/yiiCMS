<?php

namespace backend\controllers;

use common\models\UserConst;
use backend\components\behavior\PermissionBehavior;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;

/**
 * backend Admin controller
 */
class AdminController extends BaseController
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            header('Location:' . Url::to(['auth/login-ui'], true));
            exit;
        }
        if (Yii::$app->user->identity->role == UserConst::NORMAL_USER) {
            Yii::$app->session->setFlash('err', '请用后台管理账号登录');
            header('Location:' . Url::to(['auth/login-ui'], true));
            exit;
        }
        return parent::beforeAction($action);
    }

    /**
     * RBAC自动添加rule行为
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            PermissionBehavior::className()
        ]);
    }
}
