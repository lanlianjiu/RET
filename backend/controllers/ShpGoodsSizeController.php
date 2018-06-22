<?php

namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsSize;
use yii\web\NotFoundHttpException;

class ShpGoodsSizeController extends BaseController
{
    public $layout = "lte_main";
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTable()
    {
        $postParams = Yii::$app->request->post("postParams");
        $params = json_decode($postParams);
        $goods_id = $params->goods_id;
        $query = Yii::$app->db->createCommand('
         SELECT 
         *
           FROM shp_goods_size 
          WHERE goods_id='.$goods_id.'')->queryAll();
        return json_encode($query);
    }

     /**
     * Creates a new ShpGoodsSize model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShpGoodsSize();
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
     * Deletes an existing ShpGoodsSize model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = ShpGoodsSize::deleteAll(['in', 'goods_size_id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Updates an existing ShpGoodsSize model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('goods_size_id');
        $model = $this->findModel($id);

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
     * Finds the ShpGoodsSize model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShpGoodsSize the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShpGoodsSize::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
