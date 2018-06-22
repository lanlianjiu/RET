<?php
namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsCategory;
use backend\models\ShpCategory2brand;
use yii\web\NotFoundHttpException;

class GoodsCategoryController extends BaseController
{
    public $layout = "lte_main";

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTree()
    {
        $query = Yii::$app->db->createCommand("

           SELECT category_id Id,
                  CONCAT_WS('-',category_id,category_name) name,
                  category_name categoryName,
                  category_p_id pId,
                  CASE is_used
                  WHEN 0 THEN '否'
                  WHEN 1 THEN '是'
                  END AS isUsedname,
                  is_used isUsed
            FROM  shp_goods_category
         
        ")->queryAll();

        return json_encode($query);
    }

    public function actionCategoryToBrand()
    {
         
        $category_id = Yii::$app->request->post('category_id');
        $query = Yii::$app->db->createCommand('
         SELECT 
                c2b.category2brand_id category2brand_id,
                b.brand_name brandName
           FROM  shp_category2brand c2b,
                 shp_goods_brand b
           WHERE c2b.brand_id = b.brand_id
             AND c2b.category_id = '.$category_id.'
           ')->queryAll();
           
        return json_encode($query);
    }

     public function actionCategoryCbrand()
    {
        $category_id = Yii::$app->request->get('category_id');
        $query = Yii::$app->db->createCommand('
         SELECT 
                b.brand_id id,
                b.brand_name text
           FROM  shp_goods_brand b
           WHERE b.brand_id not in (
               SELECT c2b.brand_id id
                 FROM shp_category2brand c2b
                WHERE c2b.category_id = '.$category_id.'
           ) 
           ')->queryAll();
           
        return json_encode($query);
    }

    /**
     * Creates a new ShpCategory2brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateC2b()
    {
        $model = new ShpCategory2brand();
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
     * Deletes an existing ShpCategory2brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteC2b(array $ids)
    {
        if(count($ids) > 0){
            $c = ShpCategory2brand::deleteAll(['in', 'category2brand_id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }else{

            echo json_encode(array('errno'=>2, 'msg'=>'删除失败!'));
        }

    }

    
     /**
     * Creates a new ShpGoodsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateCategory()
    {
        $model = new ShpGoodsCategory();
        if ($model->load(Yii::$app->request->post())) {
           
                   
            if($model->validate() == true && $model->save()){
                $newid = $model->attributes['category_id'];
                $msg = array('errno'=>0, 'msg'=>'保存成功','pk_id'=>$newid);
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
     * Deletes an existing ShpGoodsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteCategory(array $ids)
    {
        if(count($ids) > 0){
            $c = ShpGoodsCategory::deleteAll(['in', 'category_id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }else{

            echo json_encode(array('errno'=>2, 'msg'=>'删除失败!'));
        }

    }

     /**
     * Updates an existing ShpGoodsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateCategory()
    {
        $id = Yii::$app->request->post('category_id');
        $model = $this->findCategoryModel($id);
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
     * Finds the ShpGoodsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ShpGoodsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCategoryModel($id)
    {
        if (($model = ShpGoodsCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
