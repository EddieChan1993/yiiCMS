<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 11:31
 */

namespace common\helps;


use Yii;
use yii\web\Cookie;

class CookieE
{
    /**
     * 存入cookie信息
     */
    public static function setCookie($cookieName,$cookieValue,$expire)
    {
        $cookie = new Cookie([
            'name'=>$cookieName,
            'value'=>$cookieValue,
            'expire'=>time() + $expire,
            'httpOnly'=>true
        ]);

        Yii::$app->response->getCookies()->add($cookie);
    }

    /**
     * 是否存在cookie
     */
    public static function hasCookie($cookieName)
    {
        $cookie = Yii::$app->request->cookies;
        return $cookie->has($cookieName);
    }

    /**
     * 获取cookie信息
     */
    public static function getCookie($cookieName)
    {
        $cookie = Yii::$app->request->cookies;
        return $cookie->get($cookieName)->value;
    }

    /**
     * 删除cookie信息
     */
    public static function delCookie($cookieName)
    {
        $cookie = Yii::$app->request->cookies->get($cookieName);
        Yii::$app->response->getCookies()->remove($cookie);
    }

    /**
     * 删除所有cookie信息
     */
    public static function delAllCookie()
    {
        Yii::$app->response->getCookies()->removeAll();
    }
}