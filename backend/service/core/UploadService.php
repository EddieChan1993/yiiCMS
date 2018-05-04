<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/21
 * Time: 10:11
 */

namespace backend\service\core;


use app\models\AlphaImgs;
use common\extend\TencentCos;

class UploadService extends AuthService
{
    /**
     * @param $fileData
     * @param $postData
     * @return string
     */
    public static function tencentCos($fileData, $postData):string
    {
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        $flag = "";
        try {
            $forder = \Yii::$app->params['tencent_cos']['folder'];

            $keyHead = $postData['path'];
            $fileType=get_extension($fileData['files']['name']);
            $fileSize = $fileData['files']['size'];
            $key = sprintf("%s/%s%d%d.%s", $forder,$keyHead,time(),rand(1000,9999), $fileType);
            $temp_name = $fileData['files']['tmp_name'];

            $instance = TencentCos::getInstance();
            $res = $instance::upload($key, $temp_name);
            self::addImgLog(AlphaImgs::TencentCosType, $res,$fileSize);

            $flag = $res;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }

    //添加到数据库
    private static function addImgLog($type, $url,$size)
    {
        $model=new AlphaImgs();
        $model->img_size = getFileSize($size);
        $model->upload_date = time();
        $model->user_id = self::$uid;
        $model->ip = $_SERVER["REMOTE_ADDR"];
        $model->img_path = $url;
        $model->type = $type;
        if (!$model->save()) {
            throw new \Exception(current($model->getFirstErrors()));
        }
    }
}