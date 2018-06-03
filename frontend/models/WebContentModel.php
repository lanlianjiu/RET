<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "web_content".
 *
 * @property integer $web_nav_id
 * @property string $web_content
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 *
 * @property WebNav $webNav
 */
class WebContentModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['web_nav_id', 'create_user', 'create_date'], 'required'],
            [['web_nav_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['web_content'], 'string', 'max' => 255],
            [['create_user', 'update_user'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'web_nav_id' => 'Web Nav ID',
            'web_content' => 'Web Content',
            'create_user' => 'Create User',
            'create_date' => 'Create Date',
            'update_user' => 'Update User',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebNav()
    {
        return $this->hasOne(WebNav::className(), ['web_nav_id' => 'web_nav_id']);
    }
}
