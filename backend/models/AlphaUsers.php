<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_users".
 *
 * @property string $id
 * @property string $user_login 用户名
 * @property string $avatar
 * @property string $user_pass 登录密码；sp_password加密
 * @property string $user_pass_salt 密码验证
 * @property string $user_nicename 用户美名
 * @property string $user_email 登录邮箱
 * @property string $last_login_ip 最后登录ip
 * @property int $last_login_time 最后登录时间
 * @property int $update_time 更新时间
 * @property int $create_time 注册时间
 * @property int $user_status 用户状态 0：禁用； 1：正常 ；2：未验证
 * @property string $mobile 手机号
 * @property int $user_hits 登陆次数
 */
class AlphaUsers extends \yii\db\ActiveRecord
{
    const STOP = 0;
    const PASS = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_login_time', 'update_time', 'create_time', 'user_status', 'user_hits'], 'integer'],
            [['user_login'], 'unique'],
            [['user_login'], 'string', 'max' => 60],
            [['avatar', 'user_pass_salt'], 'string', 'max' => 255],
            [['user_pass'], 'string', 'max' => 64],
            [['user_nicename'], 'string', 'max' => 50],
            [['user_email'], 'string', 'max' => 100],
            [['last_login_ip'], 'string', 'max' => 16],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_login' => '账号',
            'avatar' => 'Avatar',
            'user_pass' => '密码',
            'user_pass_salt' => 'User Pass Salt',
            'user_nicename' => 'User Nicename',
            'user_email' => 'User Email',
            'last_login_ip' => 'Last Login Ip',
            'last_login_time' => 'Last Login Time',
            'update_time' => 'Update Time',
            'create_time' => 'Create Time',
            'user_status' => 'User Status',
            'mobile' => 'Mobile',
            'user_hits' => 'User Hits',
        ];
    }
}
