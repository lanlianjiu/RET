<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "web_nav_type".
 *
 * @property integer $web_navType_id
 * @property string $web_navType_name
 *
 * @property WebNav[] $webNavs
 */
class WebNavTypeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_nav_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['web_navType_id', 'web_navType_name'], 'required'],
            [['web_navType_id'], 'integer'],
            [['web_navType_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'web_navType_id' => 'Web Nav Type ID',
            'web_navType_name' => 'Web Nav Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebNavs()
    {
        return $this->hasMany(WebNav::className(), ['web_navType_id' => 'web_navType_id']);
    }
}
