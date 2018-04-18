<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 15:13
 */

namespace backend\service\core;


use app\models\AlphaRole;
use common\helps\Validate;

class RoleService extends AuthService
{

    public static function add(array $postData):bool
    {
        $flag = false;
        try {
            $model = new AlphaRole();
            $model->status = !empty($postData['status'])?$postData['status']:AlphaRole::STOP;
            $model->create_time = time();
            $model->load($postData);
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function del(int $id): bool
    {
        $flag = false;
        try {
            AlphaRole::deleteAll(['id' => $id]);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }
}