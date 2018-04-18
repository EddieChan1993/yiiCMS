<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_menu".
 *
 * @property int $id
 * @property int $parentid
 * @property string $module 模块
 * @property string $controller 控制器
 * @property string $method 操作名称
 * @property string $data 额外参数
 * @property int $type 菜单类型 1：权限认证；0：只作为菜单
 * @property int $status 状态，1显示，0禁用
 * @property string $name 菜单名称
 * @property string $icon 菜单图标
 * @property string $remark 备注
 * @property int $listorder 排序ID
 * @property string $nav_list 层级关系
 */
class AlphaMenu extends \yii\db\ActiveRecord
{
    const STOP = 0;
    const PASS = 1;

    const ONLY_MENU = 0;
    const AUTH_MENU = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'listorder'], 'integer'],
            [['name'], 'required'],
            [['name'], 'unique'],
            [['module', 'controller'], 'string', 'max' => 30],
            [['module', 'controller'], 'required'],
            [['method', 'data', 'name', 'icon'], 'string', 'max' => 50],
            [['type', 'status'], 'integer', 'max' => 1],
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
            'parentid' => 'Parentid',
            'module' => 'Module',
            'controller' => '控制器',
            'method' => '方法',
            'data' => 'Data',
            'type' => 'Type',
            'status' => 'Status',
            'name' => '菜单名称',
            'icon' => 'Icon',
            'remark' => 'Remark',
            'listorder' => 'Listorder',
            'nav_list' => 'Nav List',
        ];
    }
}
