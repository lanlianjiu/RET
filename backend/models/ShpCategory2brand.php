<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_category2brand".
 *
 * @property integer $category2brand_id
 * @property integer $brand_id
 * @property integer $category_id
 *
 * @property ShpGoodsCategory $category
 * @property ShpGoodsBrand $brand
 */
class ShpCategory2brand extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_category2brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'category_id'], 'required'],
            [['brand_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category2brand_id' => 'Category2brand ID',
            'brand_id' => 'Brand ID',
            'category_id' => 'Category ID',
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
}
