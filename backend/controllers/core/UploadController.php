<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 16:28
 */

namespace backend\controllers\core;

use backend\service\core\UploadService;
use Yii;

class UploadController extends BaseController
{
    function actionShowUploadSingle()
    {
        $req = \Yii::$app->request->get();
        $map = [
            'dom' => $req['dom'],
            'path' => $req['path'],
            'type'=>$req['type']
        ];
        return $this->render('upload-sigle',$map);
    }

    function actionUploadSingle()
    {
        $file = $_FILES;
        $req = \Yii::$app->request;
        $postData=$req->post();
        $res=UploadService::tencentCos($file,$postData);
        if (empty($res)) {
            self::warning(UploadService::getErr());
        }
        self::output($res);
    }

    /*===================================Excel上传========================================*/
    function actionShowUploadExcel()
    {
        $req = \Yii::$app->request->get();
        $map = [
            'path' => $req['path'],
        ];
        return $this->render('upload-excel',$map);
    }
    /**
     * 前端调用方式
     * "cdk/import-excel"指定控制器方法
     * upload_excel("cdk/import-excel")
     */
    function actionUploadExcel()
    {
        $file = $_FILES;
        if (empty($file)) {
            self::warning("请先添加文件");
        }
        $post = \Yii::$app->request->post();
        //请求指定控制器处理excel
        Yii::$app->runAction($post['path'],['tmp_name'=>$file['files']['tmp_name']]);
    }
}