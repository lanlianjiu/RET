<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "web_message".
 *
 * @property integer $message_id
 * @property string $connet_name
 * @property string $connet_phone
 * @property string $email
 * @property string $address
 * @property string $message_content
 * @property string $create_date
 * @property integer $is_look
 */
class WebMessageModel extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['connet_name', 'connet_phone', 'email', 'address', 'message_content', 'create_date'], 'required'],
            [['create_date'], 'safe'],
            [['is_look'], 'integer'],
            [['connet_name', 'email'], 'string', 'max' => 32],
            [['connet_phone'], 'string', 'max' => 11],
            [['address', 'message_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => '主键',
            'connet_name' => '联系人',
            'connet_phone' => '联系电话',
            'email' => '电子邮箱',
            'address' => '地址',
            'message_content' => '留言内容',
            'create_date' => '留言时间',
            'is_look' => '是否已查看',
        ];
    }
}
