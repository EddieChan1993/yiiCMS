<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/5/7
 * Time: 12:02
 */

namespace frontend\controllers;


use yii\web\Controller;
http://127.0.0.28/test/one
class TestController extends Controller
{
    function actionIndex()
    {
        return $this->renderAjax('index');
    }

    function actionOne()
    {
        echo 'OK';
    }
}