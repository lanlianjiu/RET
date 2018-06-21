<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_order_staus".
 *
 * @property integer $order_status_id
 * @property string $order_status_name
 * @property integer $is_used
 */
class ShpOrderStaus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_order_staus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_status_id', 'order_status_name', 'is_used'], 'required'],
            [['order_status_id', 'is_used'], 'integer'],
            [['order_status_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_status_id' => 'Order Status ID',
            'order_status_name' => 'Order Status Name',
            'is_used' => 'Is Used',
        ];
    }
}
