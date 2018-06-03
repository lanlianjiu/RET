<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "web_pic".
 *
 * @property integer $pic_id
 * @property integer $pic_type_id
 * @property string $pic_url
 *
 * @property WebPicType $picType
 */
class WebPicModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pic_id', 'pic_type_id', 'pic_url'], 'required'],
            [['pic_id', 'pic_type_id'], 'integer'],
            [['pic_url'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pic_id' => 'Pic ID',
            'pic_type_id' => 'Pic Type ID',
            'pic_url' => 'Pic Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicType()
    {
        return $this->hasOne(WebPicType::className(), ['pic_type_id' => 'pic_type_id']);
    }
}
