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
use yii\db\Exception;

class UploadService extends AuthService
{
    /**
     * 腾讯云
     * @param $fileData
     * @param $postData
     * @return string
     * @throws Exception
     */
    public static function tencentCos($fileData, $postData): string
    {
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        $flag = "";
        try {
            if (empty($fileData)) {
                throw new Exception("请先选择文件");
            }
            $forder = \Yii::$app->params['tencent_cos']['folder'];
//            $hostNew = \Yii::$app->params['oss_host'];

            $keyHead = $postData['path'];
            $fileType = get_extension($fileData['files']['name']);
            $fileSize = $fileData['files']['size'];
            $key = sprintf("%s/%s/%d%d.%s", $forder, $keyHead, time(), rand(1000, 9999), $fileType);
            $temp_name = $fileData['files']['tmp_name'];

            $instance = TencentCos::getInstance();
            $res = $instance::upload($key, $temp_name);
//            $res = self::changeHost($res, $hostNew);
            self::addImgLog(AlphaImgs::TencentCosType, $res, $fileSize);

            $flag = $res;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 华为云
     * @param $fileData
     * @param $postData
     * @return string
     * @throws Exception
     */
    public static function obsUpload($fileData, $postData): string
    {
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        $flag = "";
        try {
            if (empty($fileData)) {
                throw new Exception("请先选择文件");
            }
            $hostOBS = \Yii::$app->params['obs-host'];

            $forder = \Yii::$app->params['tencent_cos']['folder'];
            $keyHead = $postData['path'];
            $fileSize = $fileData['files']['size'];
            $folders = sprintf("%s/%s", $forder, $keyHead);
            $temp_name = $fileData['files']['tmp_name'];
            $data = ['file' => new \CURLFile($temp_name,"",$fileData['files']['name']), 'folder' => $folders];
            $resData = http_curl($hostOBS, $data);
            if ($resData['error'] == 1) {
                throw new \Exception($resData['data']);
            }
            $urlPath = $resData['data'];
            self::addImgLog(AlphaImgs::HUWeiOBSType, $urlPath, $fileSize);
            $flag = $urlPath;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 添加到数据库
     * @param $type
     * @param $url
     * @param $size
     * @throws \Exception
     */
    private static function addImgLog($type, $url, $size)
    {
        $model = new AlphaImgs();
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

    /**
     * 改变host地址
     * @param $url
     * @param $newUrl
     * @return string
     */
    private static function changeHost($url, $newUrl)
    {
        $path = get_url_param($url, 'path');
        return sprintf("%s%s", $newUrl, $path);
    }
}