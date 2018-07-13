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

     /**
     * Updates an existing ShpGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('goods_id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
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
        $arr = Yii::$app->db->createCommand('
         SELECT 
              category_id id,
              category_p_id pid,
              category_name text
           FROM shp_goods_category
           ')->queryAll();

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
                $refer[$pid]['children'][] = & $arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
            }
            }
        }

        $result = $tree;
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


     /**
     * Finds the ShpGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ShpGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShpGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    

}
