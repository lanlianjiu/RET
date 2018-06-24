<?php

namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoods;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class GoodsController extends BaseController
{
    public $layout = "lte_main";

     public function actions(){
        return [
            'upload'=>[
                    'class'=>'common\widgets\file_upload\UploadAction',
                    'config'=>[
                        'imagePathFormat' => "/SHP/goodsUploadimg/{yyyy}{mm}{dd}/{time}{rand:6}",
                            ]
                    ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTable()
    {
        $query = Yii::$app->db->createCommand('
         SELECT 
              g.*,
              c.category_name categoryName,
              b.brand_name brandName,
              CASE g.is_used
              WHEN 0 THEN "否"
              WHEN 1 THEN "是"
              END AS isUsedname
           FROM shp_goods g, 
                shp_goods_category c,
                shp_goods_brand b
          WHERE g.brand_id = b.brand_id
            AND g.category_id = c.category_id
           
           ')->queryAll();

        return json_encode($query);
    }

     /**
     * Creates a new ShpGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShpGoods();
        if ($model->load(Yii::$app->request->post())) {
           
                   
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    public function actionGetCategory()
    {
        $query = Yii::$app->db->createCommand('
         SELECT 
              category_id id,
              category_p_id pid,
              category_name text
           FROM shp_goods_category
           ')->queryAll();

           function getTree($array, $pid =0, $level = 0){

                //声明静态数组,避免递归调用时,多次声明导致数组覆盖
                static $list = [];
                foreach ($array as $key => $value){
                    //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
                    if ($value['pid'] == $pid){
                        //父节点为根节点的节点,级别为0，也就是第一级
                        $value['level'] = $level;
                        //把数组放到list中
                        $list[$value['id']] = $value;
                        //把这个节点从数组中移除,减少后续递归消耗
                        unset($array[$key]);
                        //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                        getTree($array, $value['id'], $level+1);

                    }
                }
                return $list;
            };

            $result = getTree($query);

            foreach($result as $key => $value){
                $result[$key]['text'] =  str_repeat('--', $value['level']).$value['text'];
            }
        
           
        return json_encode($result);
    }

    public function actionCategoryToBrand()
    {
        $category_id = Yii::$app->request->get('category_id');
        $query = Yii::$app->db->createCommand('
         SELECT 
                b.brand_id id,
                b.brand_name text
           FROM  shp_category2brand c2b,
                 shp_goods_brand b
           WHERE c2b.brand_id = b.brand_id
             AND c2b.category_id = '.$category_id.'
           ')->queryAll();
           
        return json_encode($query);
    }

    

}
