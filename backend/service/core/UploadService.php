<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/21
 * Time: 10:11
 */

namespace backend\service\core;


use common\extend\TencentCos;
use Qcloud\Cos\Client;

class UploadService extends AuthService
{
    /**
     * @param $fileData
     * @param $postData
     * @return string
     */
    public static function tencentCos($fileData, $postData):string
    {
        $flag = "";
        try {
            $keyHead = $postData['path'];
            $fileType=get_extension($fileData['files']['name']);
            $key = sprintf("%s%d.%s", $keyHead, time(), $fileType);
            $temp_name = $fileData['files']['tmp_name'];

            $instance = TencentCos::getInstance();
            $res = $instance::upload($key, $temp_name);
            $flag = $res;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }
}