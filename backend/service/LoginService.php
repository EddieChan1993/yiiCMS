<?php
namespace backend\service;
use common\helps\Validate;

class LoginService
{
    public static function loginAuth(array $postData)
    {
        try {
            $validate = new Validate([
                ['username', 'require', '用户名必须填写'],
                ['password', 'require', '密码必须填写'],
            ]);
            if (!$validate->check($postData)) {
                throw new \Exception($validate->getError());
            }
            if (YII_ENV == 'prod') {
                //生产模式
            }

        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }
}