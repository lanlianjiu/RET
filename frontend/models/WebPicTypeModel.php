<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "web_pic_type".
 *
 * @property integer $pic_type_id
 * @property string $pic_type_name
 *
 * @property WebPic[] $webPics
 */
class WebPicTypeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_pic_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pic_type_id', 'pic_type_name'], 'required'],
            [['pic_type_id'], 'integer'],
            [['pic_type_name'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pic_type_id' => 'Pic Type ID',
            'pic_type_name' => 'Pic Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebPics()
    {
        return $this->hasMany(WebPic::className(), ['pic_type_id' => 'pic_type_id']);
    }
}
