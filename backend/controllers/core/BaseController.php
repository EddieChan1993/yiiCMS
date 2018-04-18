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
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public static $model;
    //表数据的时间创建字段，如果调用getDataList，需要设置
    public static $c_time_key="c_time";

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

    /*条件查询
     * =============================================================*/
    /**
     * @param $data
     * @param null $filed 需要显示的字段
     * @param string $c_time_key 创建时间key
     * @return array
     * @throws \Exception
     */
    protected static function getDataList($data, $filed = "*", $c_time_key='c_time')
    {
        if (empty(self::$model)) {
            throw new \Exception("模型没有指定");
        }

        $query=(new Query())->from(self::$model);
        if (!empty($data['condition']) && is_array($data['condition'])) {
            foreach ($data['condition'] as $key => $val) {
                if (!empty($val)||$val==="0") {
                    //排除为空的字段
                    $query->andFilterCompare($key, $val);
                }
            }
        }
        if (!empty($data['s_date']) && !empty($data['e_date'])) {
            $query->andFilterCompare($c_time_key, ['BETWEEN',[strtotime($data['s_date']),strtotime($data['e_date'])+86400]]);
        }
        if (!empty($data['s_date'])&&empty($data['e_date'])) {
            $query->andFilterCompare($c_time_key, ['>=',strtotime($data['s_date'])]);
        }
        if (!empty($data['e_date'])&&empty($data['s_date'])) {
            $query->andFilterCompare($c_time_key, ['<=',strtotime($data['e_date'])]);
        }

        $countNums = $query->count();
        $pagination = new Pagination([
            'defaultPageSize' => 13,
            'totalCount' => $countNums,
        ]);
        $lists = $query->orderBy("$c_time_key desc")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->select($filed)
            ->all();

        $pages = getPageWidge($pagination);
        $data = [
            'dataArr' => $lists,//每页数据
            'pages' => $pages,//分页按钮
            'dataNums' => $countNums,//总个数
            'get'=>$_GET
        ];
        return $data;
    }

    /*CURD
  * =============================================================*/
    function actionIndex()
    {
        $get = $_GET;
        $res=self::getDataList($get,'*',self::$c_time_key);
        return $this->render('index', $res);
    }

    function actionAdd()
    {

    }

    function actionUpdate()
    {

    }

    function actionDel()
    {

    }
}