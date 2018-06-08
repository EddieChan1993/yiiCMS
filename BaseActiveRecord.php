<?php
/**
 * Created by PhpStorm.
 * User: 阿勇
 * Date: 2017/9/26
 * Time: 10:54
 */

namespace backend\models;


use common\models\BaseConst;
use yii\base\Exception;
use yii\data\Pagination;
use yii\db\ActiveRecord;

abstract class BaseActiveRecord extends ActiveRecord
{

    /**
     * 获取一条数据
     * @param int $id
     * @param array $fields
     * @return array
     */
    public function getOneData(int $id, array $fields = []): array
    {
        $query = $this->find()->where(['id' => $id, 'status' => BaseConst::NORMAL_STATUS]);
        if ($fields) {
            $query->select($fields);
        }
        $data = $query->asArray()->one();
        return !empty($data) ? $data : [];
    }

    /**
     * 保存一條数据到数据库
     * @param array $data
     * @return bool
     */
    public function saveData(array &$data): bool
    {
        if (!isset($data['c_time'])) {
            $data['c_time'] = time();
        }
        $insertData[$this->formName()] = $data;
        return $this->load($insertData) && $this->save();
    }

    /**
     * @param int $id
     * @param bool $isSoftDelete
     * @return bool
     */
    public function deleteData(int $id, bool $isSoftDelete = true): bool
    {
        if ($isSoftDelete) {
            $result = static::updateAll(['status' => 0], ['id' => $id]);
        } else {
            $result = static::deleteAll(['id' => $id]);
        }
        return $result;
    }

    /**
     * @param array $data
     * @return int 更新的记录数
     * @throws Exception
     */
    public function updateData(array &$data): int
    {
        if (!isset($data['id'])) {
            throw  new Exception('无效的ID参数');
        }
        return static::updateAll($data, ['id' => $data['id']]);
    }

    /**
     * @param array $conditions 查询条件 [['id' => $id],['>', 'create_time', $unixTime]];
     * @param array $fields 查询字段 ['id','name']
     * @param array $order 排序 ['create_time' => SORT_DESC]
     * @param int $pageSize 每页显示数量
     * @param int $curPage 当前页码
     * @return array  data表述数据  page表示分页信息
     */
    public function getMultiData(array &$conditions = [], array &$fields = [], array &$order = ['id' => SORT_DESC], int $pageSize = 20, int $curPage = 0): array
    {
        $conditions [] = ['status' => BaseConst::NORMAL_STATUS];
        $query = $this->find();
        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $query->andWhere($condition);
            }
        }
        if (!empty($fields)) {
            $query->select($fields);
        }
        $query->orderBy($order);
        $page = new Pagination(['totalCount' => $query->count()]);
        $page->setPageSize($pageSize);
        if ($curPage != 0) {
            $page->setPage(--$curPage);
            if ($curPage > $page->getPageCount()) {
                return ['data' => [], 'page' => $page];
            }
        }
        $query->offset($page->offset)->limit($page->limit);
        $datum = $query->asArray()->all();
        return ['data' => $datum, 'page' => $page];
    }

    /**
     * 获取所有数据
     * @param array $conditions
     * @param array $fields
     * @param array $order
     * @return array
     */
    public function getAllData(array &$conditions = [], array &$fields = [], array &$order = ['id' => SORT_DESC]): array
    {
        $conditions [] = ['status' => BaseConst::NORMAL_STATUS];
        $query = $this->find();
        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $query->andWhere($condition);
            }
        }
        if (!empty($fields)) {
            $query->select($fields);
        }
        $query->orderBy($order);
        $datum = $query->asArray()->all();
        return $datum ? $datum : [];
    }

    /**
     * 判断一个数据是否存在
     * @param int $id
     * @return bool
     */
    public function isExist(int $id): bool
    {
        $post = $this->find()->where(['id' => $id])->select(['id'])->asArray()->one();
        return $post ? true : false;
    }
}