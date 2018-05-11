<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 16:57
 */

namespace common\extend;


use Qcloud\Cos\Client;

class TencentCos
{
    private static $instance;
    private static $TenceCosClient;
    private static $bucket;
    /**
     * TencentCos constructor.
     */
    private function __construct($conf)
    {
        self::$TenceCosClient = new Client($conf);

    }
    /**
     * TencentCos constructor.
     */
    public static function getInstance()
    {
        if (empty(static::$instance)) {
            $params = \Yii::$app->params;
            $region = $params['tencent_cos']['region'];
            $secretId = $params['tencent_cos']['secretId'];
            $secretKey = $params['tencent_cos']['secretKey'];
            self::$bucket = $params['tencent_cos']['Bucket'];
            $cosConf = [
                'region'=>$region,
                'credentials'=>[
                    'secretId'=>$secretId,
                    'secretKey'=>$secretKey
                ]
            ];
            self::$instance = new TencentCos($cosConf);
        }
        return self::$instance;
    }

    /**
     * 分片上传文件
     * @param $key
     * @param $temp_name
     * @return mixed
     */
    public static function upload($key,$temp_name)
    {
        $res=self::$TenceCosClient->upload(self::$bucket, $key, fopen($temp_name, 'r+'));
        return urldecode($res['Location']);
    }
}