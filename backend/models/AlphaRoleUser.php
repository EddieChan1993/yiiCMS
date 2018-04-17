<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_role_user".
 *
 * @property int $role_user_id
 * @property int $user_id
 * @property int $role_id
 */
class AlphaRoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_user_id' => 'Role User ID',
            'user_id' => 'User ID',
            'role_id' => 'Role ID',
        ];
    }
}
