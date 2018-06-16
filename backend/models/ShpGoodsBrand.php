<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goods_brand".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_icon
 * @property integer $is_used
 *
 * @property ShpCategory2brand[] $shpCategory2brands
 * @property ShpGoods[] $shpGoods
 */
class ShpGoodsBrand  extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goods_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name', 'is_used'], 'required'],
            [['is_used'], 'integer'],
            [['brand_name', 'brand_icon'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_icon' => 'Brand Icon',
            'is_used' => 'Is Used',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpCategory2brands()
    {
        return $this->hasMany(ShpCategory2brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpGoods()
    {
        return $this->hasMany(ShpGoods::className(), ['brand_id' => 'brand_id']);
    }
}
