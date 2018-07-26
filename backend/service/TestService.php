<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/7/26
 * Time: 10:18
 */

namespace backend\service;


use backend\service\core\AuthService;

class TestService extends AuthService
{
    public static function add($postData):bool
    {
        $flag = false;
        try {
            $model = new Test();
            $model->load($postData);
            $model->created_time = date("Y-m-d H:i:s");
            $model->created_by = self::$uid;
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function getOne($id)
    {
        $categoryOne= Test::find()
            ->where(['tid'=>$id])
            ->asArray()
            ->one();
        return $categoryOne;
    }

    public static function edit(array $postData): bool
    {
        $flag = false;
        try {
            $model = Test::findOne(['tid'=>$postData['id']]);
            $model->load($postData);
            $model->updated_time = date("Y-m-d H:i:s");
            $model->updated_by = self::$uid;
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    public static function del($id)
    {
        $flag = false;
        try {
            Test::deleteAll(['tid' => $id]);
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }
}