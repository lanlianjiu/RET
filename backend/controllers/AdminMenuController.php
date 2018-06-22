<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\AdminMenu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;



/**
 * AdminMenuController implements the CRUD actions for AdminMenu model.
 */
class AdminMenuController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all AdminMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $mid = Yii::$app->request->get('mid');
        $controllers = $this->getAllController();
        $controllerData = array();
        foreach($controllers as $c){
            $controllerData[$c['text']] = $c;
        
        };

        return $this->render('index', [
            'module_id'=>$mid,
            'controllerData'=>$controllerData,
        ]);
    }

    /**
     * Displays a single AdminMenu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    public function actionTable()
    {
        $postParams = Yii::$app->request->post("postParams");
        $params = json_decode($postParams);
        $mid = $params->mid;
        $query = Yii::$app->db->createCommand('
         SELECT 
         *
           FROM admin_menu m
          WHERE m.module_id='.$mid.'')->queryAll();
        return json_encode($query);
    }


    /**
     * Creates a new AdminMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminMenu();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->has_lef) == true){
                  $model->has_lef = 'n';
              }
              $model->display_label = $model->menu_name;
              $model->entry_right_name = $model->menu_name;
              $controllerName = substr($model->controller, 0, strlen($model->controller) - 10);
              $model->entry_url = Inflector::camel2id(StringHelper::basename($controllerName)) . '/' .$model->action;
              $model->create_user = Yii::$app->user->identity->uname;
              $model->create_date = date('Y-m-d H:i:s');
              $model->update_user = Yii::$app->user->identity->uname;
              $model->update_date = date('Y-m-d H:i:s');           
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
     * Updates an existing AdminMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
              $model->display_label = $model->menu_name;
              $model->entry_right_name = $model->menu_name;
              $controllerName = substr($model->controller, 0, strlen($model->controller) - 10);
              $model->entry_url = Inflector::camel2id(StringHelper::basename($controllerName)) . '/' .$model->action;
              $model->has_lef = 'n';
              $model->update_user = Yii::$app->user->identity->uname;
              $model->update_date = date('Y-m-d H:i:s');        
        
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
     * Deletes an existing AdminMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminMenu::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the AdminMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
 
}
