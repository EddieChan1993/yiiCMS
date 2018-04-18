<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_role".
 *
 * @property string $id
 * @property string $name 角色名称
 * @property int $pid 父角色ID
 * @property int $status 0禁用 1开启
 * @property string $remark 备注
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 * @property int $listorder 排序字段
 * @property string $rules 拥有的权限规则
 * @property string $nav_list 该角色对应首页导航
 */
class AlphaRole extends \yii\db\ActiveRecord
{
    const STOP = 0;
    const PASS = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['pid', 'create_time', 'update_time', 'listorder'], 'integer'],
            [['rules'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['status'], 'integer', 'max' => 1],
            [['remark', 'nav_list'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '角色名称',
            'pid' => 'Pid',
            'status' => 'Status',
            'remark' => 'Remark',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'listorder' => 'Listorder',
            'rules' => 'Rules',
            'nav_list' => 'Nav List',
        ];
    }
}
