<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/4/16
 * Time: 22:46
 */

namespace backend\controllers\core;


use app\models\AlphaMenu;
use backend\service\core\AuthService;
use backend\service\core\CurdService;
use common\helps\AuthE;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    //总标题
    private $title="标题内容";
    //单页面
    private $pannel_title = "pannel标题内容";
    //tab分页
    private $tab_1 = "tab_1";
    private $tab_2 = "tab_2";

    public function beforeAction($action)
    {
        if (!AuthService::isLogin()) {
            $this->redirect(Url::to(['/core/login/index']));
        }
        $res = AuthService::authUser();
        if (!$res) {
            self::warning(AuthService::getErr());
        }
        return true;
    }
    /*页面标题设置
     * =============================================================*/
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        Yii::$app->view->params['title'] = $this->title;
    }

    /**
     * @param string $pannel_title
     */
    public function setPannelTitle($pannel_title)
    {
        $this->pannel_title = $pannel_title;
        Yii::$app->view->params['pannel_title'] = $this->pannel_title;

    }

    /**
     * @param string $tab_1
     */
    public function setTab1($tab_1)
    {
        $this->tab_1 = $tab_1;
        Yii::$app->view->params['tab_1'] = $this->tab_1;

    }

    /**
     * @param string $tab_2
     */
    public function setTab2($tab_2)
    {
        $this->tab_2 = $tab_2;
        Yii::$app->view->params['tab_2'] = $this->tab_2;

    }

    /*返回格式
     * =============================================================*/
    protected static function warning($str)
    {
        $res = [
            'code'=>200,
            'error'=>1,
            'msg'=>$str,
        ];
        self::sendAjax($res);
        die;
    }

    protected static function output($str)
    {
        $res = [
            'code'=>200,
            'error'=>0,
            'msg'=>$str,
        ];
        self::sendAjax($res);
        die;
    }

    private static function sendAjax($res)
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $res;
        $response->send();
    }

    /*CURD
  * =============================================================*/
    /**
     * @return string
     * @throws \Exception
     */
    function actionIndex()
    {
        $res=CurdService::getDataList($_GET,'*',CurdService::getCTimeKey());
        return $this->render('index', $res);
    }

    function actionAdd()
    {
        echo "OK";
    }

    function actionUpdate()
    {
        echo "OK";
    }

    function actionDel()
    {
        echo "Ok";
    }
}