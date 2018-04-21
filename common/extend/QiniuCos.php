<?php

namespace app\common\extend;

class QiniuCos
{
    private static $instance;
    private $qiniuApi;
    private static $bucket;


    private function __construct($ak, $sk)
    {
        vendor('qiniu.autoload');
        $this->qiniuApi = new Auth($ak, $sk);
    }

    public static function getInstance()
    {
        if (empty(static::$instance)) {

            $app_key = plugins_value("qiniu", "ak");;
            $app_secret = plugins_value("qiniu", "sk");;

            self::$bucket = plugins_value("qiniu", "bucket");;
            self::$instance = new QiniuCos($app_key, $app_secret);
        }
        return self::$instance;
    }

    //获取token
    public function getToken()
    {
        if (!extension_loaded('memcache')) {
            //没装缓存
            $token=$this->qiniuApi->uploadToken(self::$bucket);
        }else{
            $expires = 3600;//一个小时
            $memcache = new Memcache();
            $key = 'qiniu_token';
            if ($memcache->get($key)) {
                $token = $memcache->get($key);
            }else{
                $token=$this->qiniuApi->uploadToken(self::$bucket);
                $memcache->set($key, $token,$expires);
            }
        }
        return $token;
    }

    /**
     * 上传单个图片
     * @param $filePath 本地地址
     * @param $fileName 文件名称
     * @param $token
     * @return mixed
     * @throws Exception
     */
    public function uploadSimple($filePath, $fileName, $token)
    {
        $uploadMgr = new UploadManager();
        $key = md5(uniqid()) . "." . substr(strrchr($fileName, '.'), 1);
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err != null) {
            throw new Exception("七牛上传单个图片失败:".$err->message());
        }

        return $ret;
    }

    /**
     * 获取文件信息
     * @param $key
     * @return mixed
     * @throws Exception
     * @internal param $key七牛文件地址 ,不带CDN
     */
    public function getFileInfo($key)
    {
        $config = new Config();
        $bucketManager = new BucketManager($this->qiniuApi, $config);
        list($fileInfo, $err) = $bucketManager->stat(self::$bucket, $key);
        if ($err) {
            throw new Exception("七牛获取文件信息失败".$err->message());
        }
        return $fileInfo;
    }

    /**
     * 删除文件
     * @param $key
     * @return bool
     * @throws Exception
     */
    public function delFile($key)
    {
        $config = new Config();
        $bucketManager = new BucketManager($this->qiniuApi, $config);
        $err = $bucketManager->delete(self::$bucket, $key);
        if ($err) {
            throw new Exception("七牛文件删除失败:".$err->message());
        }
        return true;
    }
}