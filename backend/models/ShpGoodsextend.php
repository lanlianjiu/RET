<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goodsextend".
 *
 * @property integer $goods_extend_id
 * @property integer $goods_stock_num
 * @property integer $goods_sales_num
 * @property integer $goods_id
 * @property integer $color_id
 * @property integer $goods_size_id
 *
 * @property ShpGoods $goods
 * @property ShpColor $color
 * @property ShpGoodsSize $goodsSize
 */
class ShpGoodsextend extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goodsextend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_stock_num', 'goods_sales_num', 'goods_id', 'color_id', 'goods_size_id'], 'integer'],
            [['goods_stock_num', 'goods_id', 'color_id', 'goods_size_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_extend_id' => 'Goods Extend ID',
            'goods_stock_num' => 'Goods Stock Num',
            'goods_sales_num' => 'Goods Sales Num',
            'goods_id' => 'Goods ID',
            'color_id' => 'Color ID',
            'goods_size_id' => 'Goods Size ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsSize()
    {
        return $this->hasOne(ShpGoodsSize::className(), ['goods_size_id' => 'goods_size_id']);
    }
}
