<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 16:28
 */

namespace backend\controllers\core;


use backend\service\core\AuthService;

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
}