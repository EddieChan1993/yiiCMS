<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 11:27
 */

namespace backend\service\core;


use app\models\AlphaUsers;
use common\helps\CookieE;
use common\service\BaseService;
use Yii;

class AuthService extends BaseService
{
    protected static $uid;
    //登录验证
    public static function isLogin()
    {
        $flag = false;
        try {
            if (CookieE::hasCookie("UID")) {
                $uid = open_secret(CookieE::getCookie("UID"));
                $res=AlphaUsers::findOne($uid);
                if ($res && $res->user_status != AlphaUsers::STOP) {
                    CookieE::setCookie("UID", set_secret($uid), 604800);
                    self::$uid = $uid;
                    $flag = true;
                }
            }
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 获取uid
     * @return mixed
     */
    public static function getUid()
    {
        return self::$uid;
    }
    //权限验证

}