<?php
namespace backend\controllers\core;

use backend\service\core\InitService;
use Codeception\Util\HttpCode;
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

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception->statusCode == HttpCode::NOT_FOUND) {
            //调试模式和生产模式，显示
            return $this->render("404");
        }else{
            if ($exception != null) {
                //生产模式显示
                return $this->render("500");
            }
        }
    }
}
