<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 16:53
 */

namespace backend\controllers\core;


class AdminController extends BaseController
{
    function actionIndex()
    {
        return $this->render('index');
    }
}