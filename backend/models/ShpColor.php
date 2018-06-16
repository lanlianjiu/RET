<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_color".
 *
 * @property integer $color_id
 * @property string $color_name
 * @property integer $is_used
 * @property string $color_value
 *
 * @property ShpGoods[] $shpGoods
 */
class ShpColor extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_name', 'color_value'], 'required'],
            [['is_used'], 'integer'],
            [['color_name', 'color_value'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'color_id' => 'Color ID',
            'color_name' => 'Color Name',
            'is_used' => 'Is Used',
            'color_value' => 'Color Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpGoods()
    {
        return $this->hasMany(ShpGoods::className(), ['goods_color_id' => 'color_id']);
    }
}
