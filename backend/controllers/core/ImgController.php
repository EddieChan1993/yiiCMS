<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/22
 * Time: 13:43
 */

namespace backend\controllers\core;


use app\models\AlphaImgs;
use backend\service\core\CurdService;
use Yii;

class ImgController extends BaseController
{
    public function beforeAction($action)
    {
        self::setPannelTitle("上传文件");
        CurdService::setModel(new AlphaImgs());
        CurdService::setCTimeKey('upload_date');
        CurdService::setPageLimit(20);
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}