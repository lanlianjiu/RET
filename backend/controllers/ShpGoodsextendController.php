<?php

namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsextend;
use yii\web\NotFoundHttpException;

class ShpGoodsextendController extends BaseController
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
        $goods_size_id = $params->goods_size_id;
        $query = Yii::$app->db->createCommand('
         SELECT 
         *
           FROM shp_goodsextend 
          WHERE goods_size_id='.$goods_size_id.'')->queryAll();
        return json_encode($query);
    }

    public function actionGetcolor()
    {
      
        $sql ='SELECT color_id as id, color_name as text FROM shp_color ';
        //  WHERE color_id not in (

        //         SELECT 
        //               color_id id
        //          FROM shp_goodsextend 
        //         WHERE goods_size_id ='.$goods_size_id.'

        //  )

        $query = Yii::$app->db->createCommand($sql)->queryAll();

        return json_encode($query);
    }

     /**
     * Creates a new ShpGoodsextend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShpGoodsextend();
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
     * Deletes an existing ShpGoodsextend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = ShpGoodsextend::deleteAll(['in', 'goods_extend_id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }


     /**
     * Updates an existing ShpGoodsextend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('goods_extend_id');
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
     * Finds the ShpGoodsextend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShpGoodsextend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShpGoodsextend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
