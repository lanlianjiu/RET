<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goods_size".
 *
 * @property integer $goods_size_id
 * @property string $size_value
 * @property integer $is_used
 * @property integer $goods_id
 *
 * @property ShpGoods $goods
 */
class ShpGoodsSize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goods_size';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size_value', 'is_used', 'goods_id'], 'required'],
            [['is_used', 'goods_id'], 'integer'],
            [['size_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_size_id' => 'Goods Size ID',
            'size_value' => 'Size Value',
            'is_used' => 'Is Used',
            'goods_id' => 'Goods ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(ShpGoods::className(), ['goods_id' => 'goods_id']);
    }
}
