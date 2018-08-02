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

    //发布通告
    private static function pushMsg($mess)
    {
        array_push(self::$newsArr, self::getmessArr($mess));
    }

    /**************************************************/
    public static function getNews()
    {
        self::cdkInfo();
        Yii::$app->view->params['newsInfo']=self::$newsArr;
    }

    private static function cdkInfo()
    {
        self::pushMsg("one");
        self::pushMsg("two");
    }
}