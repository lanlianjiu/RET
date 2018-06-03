<?php

namespace frontend\models;

use Yii;

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
class WebNavModel extends \yii\db\ActiveRecord
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
            [['web_nav_id', 'web_navType_id', 'web_nav_name', 'url'], 'required'],
            [['web_nav_id', 'web_navType_id'], 'integer'],
            [['web_nav_name'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'web_nav_id' => 'Web Nav ID',
            'web_navType_id' => 'Web Nav Type ID',
            'web_nav_name' => 'Web Nav Name',
            'url' => 'Url',
        ];
    }

    // 查询主导航
    public function getMainnav(){
        
       $result = Yii::$app->db->createCommand('
            SELECT 
                *
              FROM web_nav
              WHERE web_navType_id = 1')->queryAll();
       return $result;
    }

    // 查询服务导航
    public function getServernav(){
      $result = Yii::$app->db->createCommand('
            SELECT 
                *
              FROM web_nav
              WHERE web_navType_id = 2')->queryAll();
       return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebContent()
    {
        return $this->hasOne(WebContent::className(), ['web_nav_id' => 'web_nav_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebNavType()
    {
        return $this->hasOne(WebNavType::className(), ['web_navType_id' => 'web_navType_id']);
    }
}
