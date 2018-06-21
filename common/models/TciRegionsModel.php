<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tci_regions".
 *
 * @property integer $region_id
 * @property integer $country_id
 * @property string $region_code
 * @property integer $region_tags
 * @property string $region_name
 * @property string $center_longitude
 * @property string $center_latitude
 * @property string $region_pinyin
 * @property integer $is_used
 * @property integer $region_p_id
 * @property string $level_key
 * @property string $full_name
 * @property string $full_pinyin
 * @property string $short_name
 * @property string $short_pinyin
 * @property string $alias_name
 * @property string $alias_pinyin
 * @property string $province_abbr
 * @property string $area_code
 * @property integer $cpn_tags
 *
 * @property TciRegionsModel $regionP
 * @property TciRegionsModel[] $tciRegionsModels
 * @property WebUserAddress[] $webUserAddresses
 * @property WebUserAddress[] $webUserAddresses0
 * @property WebUserAddress[] $webUserAddresses1
 */
class TciRegionsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tci_regions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'region_tags', 'region_name', 'is_used', 'level_key'], 'required'],
            [['country_id', 'region_tags', 'is_used', 'region_p_id', 'cpn_tags'], 'integer'],
            [['center_longitude', 'center_latitude'], 'number'],
            [['region_code', 'short_name', 'province_abbr', 'area_code'], 'string', 'max' => 32],
            [['region_name', 'region_pinyin', 'short_pinyin'], 'string', 'max' => 64],
            [['level_key'], 'string', 'max' => 255],
            [['full_name', 'full_pinyin', 'alias_name', 'alias_pinyin'], 'string', 'max' => 128],
            [['region_p_id', 'region_name'], 'unique', 'targetAttribute' => ['region_p_id', 'region_name'], 'message' => 'The combination of Region Name and Region P ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'country_id' => 'Country ID',
            'region_code' => 'Region Code',
            'region_tags' => 'Region Tags',
            'region_name' => 'Region Name',
            'center_longitude' => 'Center Longitude',
            'center_latitude' => 'Center Latitude',
            'region_pinyin' => 'Region Pinyin',
            'is_used' => 'Is Used',
            'region_p_id' => 'Region P ID',
            'level_key' => 'Level Key',
            'full_name' => 'Full Name',
            'full_pinyin' => 'Full Pinyin',
            'short_name' => 'Short Name',
            'short_pinyin' => 'Short Pinyin',
            'alias_name' => 'Alias Name',
            'alias_pinyin' => 'Alias Pinyin',
            'province_abbr' => 'Province Abbr',
            'area_code' => 'Area Code',
            'cpn_tags' => 'Cpn Tags',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegionP()
    {
        return $this->hasOne(TciRegionsModel::className(), ['region_id' => 'region_p_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTciRegionsModels()
    {
        return $this->hasMany(TciRegionsModel::className(), ['region_p_id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebUserAddresses()
    {
        return $this->hasMany(WebUserAddress::className(), ['province_id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebUserAddresses0()
    {
        return $this->hasMany(WebUserAddress::className(), ['city_id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebUserAddresses1()
    {
        return $this->hasMany(WebUserAddress::className(), ['country_id' => 'region_id']);
    }
}
