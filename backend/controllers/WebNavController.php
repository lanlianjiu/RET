<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\WebNavModel;
use backend\models\WebContentModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
class WebNavController extends BaseController
{
    public $layout = "lte_main";
    
    public function actionIndex()
    {
         $controllers = $this->getWebController();
       
        $controllerData = array();
        foreach($controllers as $c){
            $controllerData[$c['text']] = $c;
        };
        return $this->render('index',['controllerData'=>$controllerData]);
    }

     public function actionTable()
    {
        $query = Yii::$app->db->createCommand('
         SELECT *
           FROM web_nav w,
                web_content c 
          WHERE w.web_nav_id = c.web_nav_id')->queryAll();
        return json_encode($query);
    }

    /**
     * Displays a single WebNavModel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
       
        $model = $this->findModel($id)->getAttributes();
        $wmodel = $this->findCModel($id)->getAttributes();
        $result = (object) array_merge((array) $model, (array) $wmodel);
       
        echo json_encode($result);
    }

    /**
     * Creates a new WebNavModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WebNavModel();
        $wmodel = new WebContentModel();
        $transaction = Yii::$app->db->beginTransaction();

        try{ 
            
            if ($model->load(Yii::$app->request->post())) {
                
                $wmodel->create_user = Yii::$app->user->identity->uname;
                $wmodel->create_date = date('Y-m-d H:i:s');

                $controllerName = substr($model->controller, 0, strlen($model->controller) - 10);
                $model->url = Inflector::camel2id(StringHelper::basename($controllerName)) . '/' .$model->url;
                $nsaveResult =(($model->save())&&($model->validate()));
                
                $pkid = $model->attributes['web_nav_id'];
                $wmodel->web_nav_id = $pkid;
                
                $csaveResult = (($wmodel->validate())&&($wmodel->save()));
               
                if($nsaveResult&&$csaveResult){
                    
                    $transaction->commit();
                    $msg = array('errno'=>0, 'msg'=>'保存成功');
                    echo json_encode($msg);
                };
            };

         }catch(\Exception $e){

            $transaction->rollBack();
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            return json_encode($msg);
        };
 
    }

    /**
     * Updates an existing WebNavModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
       
        $id = Yii::$app->request->post('web_nav_id');
        $model = $this->findModel($id);
        $wmodel = $this->findCModel($id);

        $transaction = Yii::$app->db->beginTransaction();

        try{ 
            
            if ($model->load(Yii::$app->request->post())) {
                
                $wmodel->update_user = Yii::$app->user->identity->uname;
                $wmodel->update_date = date('Y-m-d H:i:s');

                $controllerName = substr($model->controller, 0, strlen($model->controller) - 10);
                $model->url = Inflector::camel2id(StringHelper::basename($controllerName)) . '/' .$model->url;

                $nsaveResult =(($model->save())&&($model->validate()));
                
                $pkid = $model->attributes['web_nav_id'];
                $wmodel->web_nav_id = $pkid;
                
                $csaveResult = (($wmodel->validate())&&($wmodel->save()));
               
                if($nsaveResult&&$csaveResult){
                    
                    $transaction->commit();
                    $msg = array('errno'=>0, 'msg'=>'保存成功');
                    echo json_encode($msg);
                };
            };

         }catch(\Exception $e){

            $transaction->rollBack();
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            return json_encode($msg);
        };
    
    }

    /**
     * Deletes an existing WebNavModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
       
        $transaction = Yii::$app->db->beginTransaction();
        try{ 

            if(count($ids) > 0){

                $b = WebContentModel::deleteAll(['in', 'web_nav_id', $ids]);
                $c = WebNavModel::deleteAll(['in', 'web_nav_id', $ids]);
                if($c&&$b){
                    echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
                    $transaction->commit();
                }
                
            }else{
                
                echo json_encode(array('errno'=>2, 'msg'=>''));
            }
           

         }catch(\Exception $e){

            $transaction->rollBack();
            echo json_encode(array('errno'=>2, 'msg'=>''));
        };
 
    }

    /**
     * Finds the WebNavModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WebNavModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WebNavModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     /**
     * Finds the WebContentModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WebContentModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCModel($id)
    {
        if (($model = WebContentModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
