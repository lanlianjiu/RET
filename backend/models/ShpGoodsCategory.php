<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_goods_category".
 *
 * @property integer $category_p_id
 * @property string $category_name
 * @property integer $is_used
 * @property integer $category_id
 *
 * @property ShpCategory2brand[] $shpCategory2brands
 * @property ShpGoods[] $shpGoods
 */
class ShpGoodsCategory extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_p_id', 'is_used'], 'integer'],
            [['category_name', 'is_used'], 'required'],
            [['category_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_p_id' => 'Category P ID',
            'category_name' => 'Category Name',
            'is_used' => 'Is Used',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpCategory2brands()
    {
        return $this->hasMany(ShpCategory2brand::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpGoods()
    {
        return $this->hasMany(ShpGoods::className(), ['category_id' => 'category_id']);
    }
}
