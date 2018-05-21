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
    const INFO_LEVEL = 4;

    private $logApi;
    private static $instance;
    private static $fileName;

    /**
     * LogE constructor.
     */
    private function __construct()
    {
        $this->logApi = new \yii\log\FileTarget();
    }


    public static function getNewInstance($fileName)
    {
        self::$instance = new LogE();
        self::$fileName = $fileName;

        return self::$instance;
    }

    public function info($message)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . self::$fileName . '.log';
        $this->logApi->messages[] = ["$message", self::INFO_LEVEL, '', time()];
    }

    public function error($message)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . self::$fileName . '.log';
        $this->logApi->messages[] = ["$message", self::ERROR_LEVEL, '', time()];
    }

    public function waring($message)
    {
        $this->logApi->logFile = Yii::$app->getRuntimePath() . '/logs/' . self::$fileName . '.log';
        $this->logApi->messages[] = ["$message", self::WARING_LEVEL, '', time()];
    }

    public function __destruct()
    {
        //当前实例被销毁调用
        // TODO: Implement __destruct() method.
        $this->logApi->export();
    }
}