<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_test".
 *
 * @property int $id
 * @property int $type 0-one 1-two 2-three
 * @property string $name
 * @property int $c_time 创建时间
 * @property int $u_time 编辑时间
 * @property int $d_time 软删除
 */
class AlphaTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_time', 'u_time', 'd_time'], 'integer'],
            [['type'], 'string', 'max' => 1],
            [['name'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'c_time' => 'C Time',
            'u_time' => 'U Time',
            'd_time' => 'D Time',
        ];
    }
}
