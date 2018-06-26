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

    // 查询分类
    public function getCategory(){
       $categoryData = Yii::$app->db->createCommand('
            SELECT 
            p.category_id id,
            p.category_p_id pid,
            p.category_name name
            FROM shp_goods_category p WHERE p.category_p_id = 1')->queryAll();

            //无限极分类，实现具有父子关系的数据分类
        //     function category($arr,$pid=0,$level=0){
        //         //定义一个静态变量，存储一个空数组，用静态变量，是因为静态变量不会被销毁，会保存之前保留的值，普通变量在函数结束时，会死亡，生长周期函数开始到函数结束，再次调用重新开始生长
        //         //保存一个空数组
        //         static $list=array();
        //         //通过遍历查找是否属于顶级父类，pid=0为顶级父类，
        //         foreach($arr as $value){
        //             //进行判断如果pid=0，那么为顶级父类，放入定义的空数组里
        //             if($value['pid']==$pid){
        //                 //添加空格进行分层
        //                 $arr['level']=$level;
        //                 $list[]=$value;
        //                 //递归点，调用自身，把顶级父类的主键id作为父类进行再调用循环，空格+1
        //                 category($arr,$value['id'],$level+1);
        //             }
        //         }
        //         return $list;//递归出口
        //     }

        //   $result =   category($categoryData);

        foreach($categoryData as $key => $value){

            $categoryData[$key]['child'] =  array();

            $carray = Yii::$app->db->createCommand('
             SELECT 
                    p.category_id id,
                    p.category_p_id pid,
                    p.category_name name
              FROM  shp_goods_category p 
             WHERE  p.category_p_id='.$value['id'].'')->queryAll();

             foreach($carray as $k => $v){

                $carray[$k]['childs'] = array();
                $barray = Yii::$app->db->createCommand('
                SELECT 
                        p.category_id id,
                        p.category_p_id pid,
                        p.category_name name
                FROM  shp_goods_category p 
                WHERE  p.category_p_id='.$v['id'].'')->queryAll();

                if(!is_null($barray)){
                    $carray[$k]['childs'] = $barray;
                };
                
             };

            $categoryData[$key]['child'] = $carray;
        };

       return $categoryData;
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
