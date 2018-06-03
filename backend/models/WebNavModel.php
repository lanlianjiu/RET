<?php

namespace backend\models;

use Yii;
use backend\models\WebContentModel;
use backend\models\WebNavTypeModel;
/**
 * This is the model class for table "web_nav".
 *
 * @property integer $web_nav_id
 * @property integer $web_navType_id
 * @property string $web_nav_name
 * @property string $url
 *
 * @property WebContent $webContent
 * @property WebNavType $webNavType
 */
class WebNavModel extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_nav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['web_navType_id', 'web_nav_name', 'url','controller'], 'required'],
            [['web_navType_id'], 'integer'],
            [['web_nav_name'], 'string', 'max' => 32],
            [['url','controller'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'web_nav_id' => '主键',
            'web_navType_id' => '类型',
            'web_nav_name' => '名称',
            'controller' => '控制器',
            'url' => 'URL',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebContent()
    {
        return $this->hasOne(WebContentModel::className(), ['web_nav_id' => 'web_nav_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebNavType()
    {
        return $this->hasOne(WebNavTypeModel::className(), ['web_navType_id' => 'web_navType_id']);
    }
}
