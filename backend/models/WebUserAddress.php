<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "web_user_address".
 *
 * @property integer $user_address_id
 * @property integer $user_id
 * @property string $detail_address
 * @property string $user_phone
 * @property integer $is_default
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $country_id
 *
 * @property WebUser $user
 * @property TciRegions $province
 * @property TciRegions $city
 * @property TciRegions $country
 */
class WebUserAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'detail_address', 'province_id', 'city_id', 'country_id'], 'required'],
            [['user_id', 'is_default', 'province_id', 'city_id', 'country_id'], 'integer'],
            [['detail_address'], 'string', 'max' => 255],
            [['user_phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_address_id' => 'User Address ID',
            'user_id' => 'User ID',
            'detail_address' => 'Detail Address',
            'user_phone' => 'User Phone',
            'is_default' => 'Is Default',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(WebUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(TciRegions::className(), ['region_id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(TciRegions::className(), ['region_id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(TciRegions::className(), ['region_id' => 'country_id']);
    }
}
