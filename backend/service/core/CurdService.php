<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 16:26
 */

namespace backend\service\core;


use yii\data\Pagination;
use yii\db\Exception;
use yii\db\Query;

class CurdService extends AuthService
{
    //用于表单提交模型名称，eg:AlphaMenu
    private static $modelNameForm;
    //用于调用getDataList时使用得数据表名,eg::AlphaMenu::className()
    private static $model;
    //表数据的时间创建字段，如果调用getDataList，需要设置
    private static $c_time_key = "c_time";

    //创建时间是否为时间戳
    private static $isTimestrap=true;

    //每页显示条数
    private static $pageLimit = 13;

    /**
     * @param int $pageLimit
     */
    public static function setPageLimit(int $pageLimit)
    {
        self::$pageLimit = $pageLimit;
    }



    /**
     * @param bool $isTimestrap
     */
    public static function setIsTimestrap(bool $isTimestrap)
    {
        self::$isTimestrap = $isTimestrap;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getModelNameForm()
    {
        if (empty(self::$modelNameForm)) {
            throw new Exception("模型对象未定义,无法使用表单插件");
        }
        return self::$modelNameForm;
    }

    /**
     * @param $object
     * @throws Exception
     * @internal param mixed $modelNameForm
     */
    public static function setModelNameForm($object = null)
    {
        if (empty($object)) {
            throw new Exception("模型对象未定义,无法使用表单插件");
        }
        $arr = explode("\\", get_class($object));
        self::$modelNameForm = end($arr);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getModel()
    {
        if (empty(self::$model)) {
            throw new \Exception("model模型未定义,无法使用多功能列表查询");
        }
        return self::$model;
    }

    /**
     * @param mixed $model
     */
    public static function setModel($model)
    {
        self::$model = $model;
    }

    /**
     * @return string
     */
    public static function getCTimeKey()
    {
        return self::$c_time_key;
    }

    /**
     * @param string $c_time_key
     * @throws \Exception
     */
    public static function setCTimeKey($c_time_key)
    {
        self::$c_time_key = $c_time_key;
    }

    /**
     * @param $data
     * @param null $filed 需要显示的字段
     * @param string $c_time_key 创建时间key
     * @return array
     * @throws \Exception
     */
    public static function getDataList($data=null, $filed = "*")
    {
        if (empty(self::$model)) {
            throw new \Exception("模型没有指定");
        }

        $query = (new Query())->from(self::$model);
        if (!empty($data['condition']) && is_array($data['condition'])) {
            foreach ($data['condition'] as $key => $val) {
                if (!empty($val) || $val === "0") {
                    //排除为空的字段
                    $query->andFilterCompare($key, trim($val));
                }
            }
        }

        $c_time_key = self::$c_time_key;
        if (self::$isTimestrap) {
            if (!empty($data['s_date'])) {
                $query->andFilterCompare($c_time_key, strtotime($data['s_date']), '>=');
            }
            if (!empty($data['e_date'])) {
                $query->andFilterCompare($c_time_key, strtotime($data['e_date']), '<');
            }
        } else {
            if (!empty($data['s_date'])) {
                $query->andFilterCompare($c_time_key, $data['s_date'], '>=');
            }
            if (!empty($data['e_date'])) {
                $query->andFilterCompare($c_time_key, $data['e_date'], '<=');
            }
        }

        $countNums = $query->count();
        $pagination = new Pagination([
            'defaultPageSize' => self::$pageLimit,
            'totalCount' => $countNums,
        ]);
        $lists = $query->orderBy("$c_time_key desc")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->select($filed)
            ->all();

        $pages = getPageWidge($pagination);
        $res = [
            'dataArr' => $lists,//每页数据
            'pages' => $pages,//分页按钮
            'dataNums' => $countNums,//总个数
            'get' => $data
        ];
        return $res;
    }

}