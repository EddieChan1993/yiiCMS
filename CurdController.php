<?php

namespace backend\controllers;

use Yii;
use yii\base\Exception;


/**
 * 增删改查 基类控制器
 */
abstract class CurdController extends AdminController
{
    /**
     * @var \backend\models\BaseActiveRecord
     */
    protected $model;

    /**
     * 重定向url
     * @var string
     */
    protected $redirectUrl;

    protected $createView = 'create';
    protected $updateView = 'update';
    protected $indexView = 'index';
    protected $templateVar;

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    /**
     * 列表页
     * @return string
     */
    public function actionIndex()
    {
        $data = Yii::$app->request->get();
        $queryResult = $this->getData($data);
        return $this->render($this->indexView, [
            'datum' => $queryResult['data'],
            'page' => $queryResult['page'],
            'get' => $data
        ]);
    }

    /**
     * 获取数据
     * @param array $data
     * @return array
     */
    protected function getData($data): array
    {
        $conditions = [];
        if (!empty($data['condition']) && is_array($data['condition'])) {
            foreach ($data['condition'] as $key => $val) {
                if (!empty($val) || $val === 0) {
                    $conditions [] = [$key => $val];
                }
            }
        }
        if (!empty($data['s_date'])) {
            $conditions[] = [
                '>=',
                'c_time',
                strtotime($data['s_date'])
            ];
        }
        if (!empty($data['e_date'])) {
            $conditions[] = [
                '<=',
                'c_time',
                strtotime($data['e_date'] . " 23:59:59")
            ];
        }
        $fields = [];
        if (isset($data['fields'])) {
            $fields = $data['fields'];
        }
        $sort = ['id' => SORT_DESC];
        if (isset($data['sort'])) {
            $sort = $data['sort'];
        }
        $queryResult = $this->model->getMultiData($conditions, $fields, $sort, 20);
        return $queryResult;
    }

    /**
     * 创建
     * @return \yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {
            $param = Yii::$app->request->post();
            try {
                $result = $this->model->saveData($param);
                if (!$result) {
                    $errors = $this->model->getFirstErrors();
                    throw  new Exception(current($errors));
                }
                Yii::$app->session->setFlash('msg', '创建成功');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('err', $e->getMessage());
            }
            return $this->redirect($this->redirectUrl);
        } else {
            $get = Yii::$app->request->get();
            $this->templateVar['get'] = $get;
            return $this->render($this->createView, $this->templateVar);
        }
    }

    /**
     * 删除
     * @return \yii\web\Response
     */
    public function actionDelete()
    {
        $param = Yii::$app->request->get();
        try {
            $result = $this->model->deleteData($param['id']);
            if (!$result) {
                $errors = $this->model->getFirstErrors();
                throw  new Exception(current($errors));
            }
            Yii::$app->session->setFlash('msg', '删除成功');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('err', '删除失败：' . $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * 修改
     * @return string|\yii\web\Response
     */
    public function actionUpdate()
    {
        if (Yii::$app->request->isPost) {
            $param = Yii::$app->request->post();
            try {
                unset($param['_csrf']);
                $result = $this->model->updateData($param);
                if (!$result) {
                    $errors = $this->model->getFirstErrors();
                    throw  new Exception(current($errors));
                }
                Yii::$app->session->setFlash('msg', '修改成功');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('err', '修改失败：' . $e->getMessage());
            }
            return $this->redirect($this->redirectUrl);
        } else {
            $param = Yii::$app->request->get();
            if (!isset($param['id'])) {
                Yii::$app->session->setFlash('err', '无效的参数');
                return $this->redirect($this->redirectUrl);
            }
            $data = $this->model->getOneData($param['id']);
            if (!$data) {
                Yii::$app->session->setFlash('err', '无效的数据');
                return $this->redirect($this->redirectUrl);
            }
            $data['c_time'] = date('Y-m-d H:i:s', $data['c_time']);
            $this->templateVar['get'] = $param;
            $this->templateVar['data'] = $data;
            return $this->render($this->updateView, $this->templateVar);
        }
    }
}
