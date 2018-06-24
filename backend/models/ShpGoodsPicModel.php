<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goods_pic".
 *
 * @property integer $goods_pic_id
 * @property string $goods_pic_url
 * @property integer $is_used
 * @property integer $goods_id
 * @property integer $color_id
 *
 * @property ShpGoods $goods
 * @property ShpColor $color
 */
class ShpGoodsPicModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goods_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_pic_url', 'is_used', 'goods_id', 'color_id'], 'required'],
            [['is_used', 'goods_id', 'color_id'], 'integer'],
            [['goods_pic_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_pic_id' => 'Goods Pic ID',
            'goods_pic_url' => '',
            'is_used' => 'Is Used',
            'goods_id' => 'Goods ID',
            'color_id' => 'Color ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(ShpGoods::className(), ['goods_id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(ShpColor::className(), ['color_id' => 'color_id']);
    }
}
