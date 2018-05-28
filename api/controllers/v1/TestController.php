<?php

namespace api\controllers\v1;

use api\controllers\BaseController;
use yii\web\Controller;

class TestController extends BaseController
{

    function actionIndex()
    {
        echo 123;
    }
}