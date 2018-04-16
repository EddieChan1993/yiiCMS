<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/16
 * Time: 22:29
 */

namespace backend\controllers\core;

use backend\service\LoginService;
use Yii;
use yii\web\Controller;
//http://127.0.0.13/index.php?r=core/login/index
class LoginController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    function actionIndex()
    {
        return $this->render('index');
    }

    function actionLoginThink()
    {
        $postData = Yii::$app->request->post();
        LoginService::loginAuth($postData);
    }
}