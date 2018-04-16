<?php
namespace backend\controllers\core;

use Yii;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public function actionIndex()
    {
        Yii::$app->view->params['data'] = '这是要传递的数据';
        return $this->render('index');
    }
}
