<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/5/10
 * Time: 10:23
 */

namespace backend\service\core;

use backend\service\core\AuthService;
use common\models\CdkInfo;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * 公告栏
 * Class NewsService
 * @package backend\service
 */
class NewsService extends AuthService
{
    private static $newsArr = [];

    private static function getmessArr($message,$time=null)
    {
        return [
            'message'=>$message,
            'time' => !empty($time) ? $time:date("Y-m-d H:i:s")  ,
        ];
    }
    public static function getNews()
    {
        self::cdkInfo();
        Yii::$app->view->params['newsInfo']=self::$newsArr;
    }
    //获取cdk信息
    private static function cdkInfo()
    {
        array_push(self::$newsArr, self::getmessArr("hi"));
        array_push(self::$newsArr, self::getmessArr("two"));
        array_push(self::$newsArr, self::getmessArr("three"));
    }
}