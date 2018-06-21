<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shp_orders".
 *
 * @property integer $order_id
 * @property string $order_no
 * @property string $order_amount
 * @property integer $create_uid
 * @property string $create_time
 * @property integer $update_uid
 * @property string $update_time
 * @property integer $user_address_id
 * @property integer $order_status_id
 *
 * @property ShpOrderGoods[] $shpOrderGoods
 */
class ShpOrdersModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shp_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_no', 'order_amount', 'create_uid', 'create_time', 'user_address_id', 'order_status_id'], 'required'],
            [['order_amount'], 'number'],
            [['create_uid', 'update_uid', 'user_address_id', 'order_status_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['order_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'order_no' => 'Order No',
            'order_amount' => 'Order Amount',
            'create_uid' => 'Create Uid',
            'create_time' => 'Create Time',
            'update_uid' => 'Update Uid',
            'update_time' => 'Update Time',
            'user_address_id' => 'User Address ID',
            'order_status_id' => 'Order Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShpOrderGoods()
    {
        return $this->hasMany(ShpOrderGoods::className(), ['order_id' => 'order_id']);
    }
}
