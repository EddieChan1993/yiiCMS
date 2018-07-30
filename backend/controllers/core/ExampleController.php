<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/22
 * Time: 16:33
 */

namespace backend\controllers\core;


class ExampleController extends BaseController
{
    function actionIndex()
    {
        return $this->render('widget');
    }
}