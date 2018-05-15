<?php
namespace common\helps;
use \Yii;

/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/5/5
 * Time: 9:42
 */
class LogE
{
    const ERROR_LEVEL = 1;
    const WARING_LEVEL = 2;
    const INFO_LEVEL =4;

    private $logApi;
    private static $instance;

    /**
     * LogE constructor.
     */
    private function __construct()
    {
        $this->logApi=new \yii\log\FileTarget();
    }


    public static function getInstance()
    {
        if (empty(self::$instance)) {
           self::$instance= new LogE();
        }

        return self::$instance;
    }

    public  function infoLog($message,$fileName)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . $fileName . '.log';
        $this->logApi->messages[] = ["$message", self::INFO_LEVEL, '', time()];
    }

    public  function errorLog($message,$fileName)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . $fileName . '.log';
        $this->logApi->messages[] = ["$message", self::ERROR_LEVEL, '', time()];
    }

    public  function waringLog($message,$fileName)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . $fileName . '.log';
        $this->logApi->messages[] = ["$message", self::WARING_LEVEL, '', time()];
    }

    /**
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\log\LogRuntimeException
     */
    public function export()
    {
        $this->logApi->export();
    }
}