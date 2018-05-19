<?php
namespace console\controllers;
use common\helps\LogE;

/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/5/19
 * Time: 21:20
 */
class TestController extends \yii\console\Controller
{
    function actionIndex()
    {
        $log = LogE::getNewInstance('one');
        $log->error('123');
        $log->info('sdf');
        $log->error('2323');
        $log->waring('1223233');
        $log->error('3124124');

        $log = LogE::getNewInstance('two');
        $log->error('123');
        $log->info('sdf');
        $log->error('43434');
        $log->waring('34');
        $log->error('234444');
    }
}