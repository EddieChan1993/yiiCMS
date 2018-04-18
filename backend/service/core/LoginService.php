<?php
namespace backend\service\core;
use app\models\AlphaUsers;
use common\helps\CookieE;
use common\helps\Validate;
use common\service\BaseService;
use Yii;
use yii\web\Cookie;

class LoginService extends BaseService
{

    public static function loginAuth(array $postData):bool
    {
        $flag = false;
        try {

            if (empty($postData['username']) || empty($postData['password'])) {
                throw new \Exception("用户名或密码不能为空");
            }
            if (YII_ENV == 'prod') {
                //生产模式
            }
            $userInfo = AlphaUsers::find()
                ->where(['user_login'=>$postData['username']])
                ->select(['id','user_hits','user_status', 'user_pass', 'user_pass_salt'])
                ->one();

            if (empty($userInfo)) {
                throw new \Exception("当前用户不存在");
            }
            if ($userInfo->user_status == AlphaUsers::STOP) {
                throw new \Exception("该用户被封，无法使用");
            }

            $inpPass = encrypt_password($postData['password'], $userInfo->user_pass_salt);
            $isSure = $userInfo->user_pass == $inpPass;
            if (!$isSure) {
                throw new \Exception("密码不正确");
            }

            self::updateUserLogin($userInfo);
            CookieE::setCookie("UID", set_secret($userInfo->id), 604800);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 更新登陆信息
     * @param $userInfoModel
     * @throws \Exception
     */
    public static function updateUserLogin($userInfoModel)
    {
        $userInfoModel->last_login_time = time();
        $userInfoModel->last_login_ip = $_SERVER["REMOTE_ADDR"];
        $userInfoModel->user_hits = $userInfoModel->user_hits + 1;
        if (!$userInfoModel->save()) {
            throw new \Exception(current($userInfoModel->getFirstErrors()));
        }
    }
}