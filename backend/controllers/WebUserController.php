<?php

namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\WebUserModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;

class WebUserController extends BaseController
{
    public $layout = "lte_main";

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTable()
    {
        
        $query = Yii::$app->db->createCommand('
         SELECT
             *
           FROM web_user')->queryAll();
        return json_encode($query);
    }


    /**
     * Updates an existing WebUserModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

              $model->updated_at = strtotime(date('Y-m-d H:i:s'));        
        
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

     /**
     * Deletes an existing WebUserModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = WebUserModel::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the WebUserModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WebUserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WebUserModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
