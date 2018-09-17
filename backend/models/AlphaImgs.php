<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alpha_imgs".
 *
 * @property int $id
 * @property string $img_size
 * @property string $upload_date 上传日期
 * @property string $user_id 操作者
 * @property string $ip 操作ip
 * @property string $img_path 图片路径
 * @property int $type 来源0-本地1-七牛
 */
class AlphaImgs extends \yii\db\ActiveRecord
{
    //文件保存的第三方位置
    const TencentCosType = 0;
    const HUWeiOBSType = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alpha_imgs';
    }

    public static $uploadName = [
        self::TencentCosType => "腾讯COS",
        self::HUWeiOBSType => "华为OBS",
    ];

    public static function showUpload($type)
    {
        switch ($type) {
            case self::TencentCosType:
                return "<span class='label label-success'>".self::$uploadName[$type]."</span>";
                break;
            case self::HUWeiOBSType:
                return "<span class='label label-info'>".self::$uploadName[$type]."</span>";
                break;
            default:
                return "<span class='label label-danger'>非法状态".$type."</span>";
                break;
        }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_date'],'integer'],
            [['img_size', 'user_id', 'ip', 'img_path'], 'string', 'max' => 255],
            [['type'], 'integer', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_size' => 'Img Size',
            'upload_date' => 'Upload Date',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'img_path' => 'Img Path',
            'type' => 'Type',
        ];
    }
}
