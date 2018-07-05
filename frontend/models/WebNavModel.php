<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "web_nav".
 *
 * @property integer $web_nav_id
 * @property integer $web_navType_id
 * @property string $web_nav_name
 * @property string $url
 *
 * @property WebContent $webContent
 * @property WebNavType $webNavType
 */
class WebNavModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_nav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['web_nav_id', 'web_navType_id', 'web_nav_name', 'url'], 'required'],
            [['web_nav_id', 'web_navType_id'], 'integer'],
            [['web_nav_name'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'web_nav_id' => 'Web Nav ID',
            'web_navType_id' => 'Web Nav Type ID',
            'web_nav_name' => 'Web Nav Name',
            'url' => 'Url',
        ];
    }

    // 查询主导航
    public function getMainnav(){
        
       $result = Yii::$app->db->createCommand('
            SELECT 
                *
              FROM web_nav
              WHERE web_navType_id = 1')->queryAll();
       return $result;
    }

    // 查询服务导航
    public function getServernav(){
      $result = Yii::$app->db->createCommand('
            SELECT 
                *
              FROM web_nav
              WHERE web_navType_id = 2')->queryAll();
       return $result;
    }

    //生成无限极分类树
    public function make_tree($arr){
        $refer = array();
        $tree = array();
        foreach($arr as $k => $v){
            $refer[$v['id']] = & $arr[$k]; //创建主键的数组引用
        }
        foreach($arr as $k => $v){
            $pid = $v['pid'];  //获取当前分类的父级id
            if($pid == 0){
            $tree[] = & $arr[$k];  //顶级栏目
            }else{
            if(isset($refer[$pid])){
                $refer[$pid]['subcat'][] = & $arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
            }
            }
        }
        return $tree;
    }

    // 查询分类
    public function getCategory(){
      $arr = Yii::$app->db->createCommand('
            SELECT 
            p.category_id id,
            p.category_p_id pid,
            p.category_name name
            FROM shp_goods_category p WHERE p.category_p_id is not null')->queryAll();

        $refer = array();
        $tree = array();
        foreach($arr as $k => $v){
            $refer[$v['id']] = & $arr[$k]; //创建主键的数组引用
        }
        foreach($arr as $k => $v){
            $pid = $v['pid'];  //获取当前分类的父级id
            if($pid == 1){
            $tree[] = & $arr[$k];  //顶级栏目
            }else{
            if(isset($refer[$pid])){
                $refer[$pid]['child'][] = & $arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
            }
            }
        }
        return $tree;
           
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebContent()
    {
        return $this->hasOne(WebContent::className(), ['web_nav_id' => 'web_nav_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebNavType()
    {
        return $this->hasOne(WebNavType::className(), ['web_navType_id' => 'web_navType_id']);
    }
}
