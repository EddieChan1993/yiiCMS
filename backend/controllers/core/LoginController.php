<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/16
 * Time: 22:29
 */

namespace backend\controllers\core;

use backend\service\core\AuthService;
use backend\service\core\LoginService;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
//http://127.0.0.13/index.php?r=core/login/index
//http://127.0.0.22/index.php?r=gii
class LoginController extends BaseController
{
    public $layout = false;
    public $enableCsrfValidation = false;

    function beforeAction($action)
    {
        if (AuthService::isLogin()) {
            $this->redirect(Url::to(['/core/site/index']));
        }
        return true;
    }

    function actionIndex()
    {
        return $this->render('index');
    }

    function actionLoginThink()
    {
        $postData = Yii::$app->request->post();
        $bool=LoginService::loginAuth($postData);
        if (!$bool) {
            self::warning(LoginService::getErr());
        }
        self::output("登陆成功,即将进入^_^");
    }
}