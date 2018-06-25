<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goods".
 *
 * @property integer $goods_id
 * @property integer $brand_id
 * @property string $goods_name
 * @property integer $is_used
 * @property string $goods_price
 * @property integer $goods_color_id
 * @property integer $category_id
 *
 * @property ShpGoodsCategory $category
 * @property ShpGoodsBrand $brand
 * @property ShpColor $goodsColor
 * @property ShpGoodsPic[] $shpGoodsPics
 * @property ShpGoodsextend[] $shpGoodsextends
 */
class ShpGoods  extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'goods_name', 'is_used', 'category_id'], 'required'],
            [['brand_id', 'is_used', 'goods_color_id', 'category_id'], 'integer'],
            [['goods_price'], 'number'],
            [['goods_name','goods_main_pic'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'brand_id' => 'Brand ID',
            'goods_name' => 'Goods Name',
            'is_used' => 'Is Used',
            'goods_price' => 'Goods Price',
            'goods_color_id' => 'Goods Color ID',
            'category_id' => 'Category ID',
            'goods_main_pic' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ShpGoodsCategory::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(ShpGoodsBrand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsColor()
    {
        return $this->hasOne(ShpColor::className(), ['color_id' => 'goods_color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpGoodsPics()
    {
        return $this->hasMany(ShpGoodsPic::className(), ['goods_id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpGoodsextends()
    {
        return $this->hasMany(ShpGoodsextend::className(), ['goods_id' => 'goods_id']);
    }
}
