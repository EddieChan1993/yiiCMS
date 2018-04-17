<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/16
 * Time: 22:46
 */

namespace backend\controllers\core;


use backend\service\core\AuthService;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (!AuthService::isLogin()) {
            $this->redirect(Url::to(['/core/login/index']));
        }
        return true;
    }

    protected static function warning($str)
    {
        $res = [
            'code'=>200,
            'error'=>1,
            'msg'=>$str,
        ];
        self::sendAjax($res);
        die;
    }

    protected static function output($str)
    {
        $res = [
            'code'=>200,
            'error'=>0,
            'msg'=>$str,
        ];
        self::sendAjax($res);
        die;
    }

    private static function sendAjax($res)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $res;
        $response->send();
    }
}