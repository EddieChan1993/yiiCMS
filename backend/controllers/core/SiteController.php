<?php
namespace backend\controllers\core;

use backend\service\core\InitService;
use common\helps\AuthE;
use common\helps\CookieE;
use Yii;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public $layout = false;
    public function actionIndex()
    {
        $res=InitService::InitAdminData();
        return $this->render('index',$res);
    }

    //退出登录
    public function actionLoginOut()
    {
        CookieE::delCookie("UID");
        $this->redirect(Url::to(['core/login/index']));
    }
}
