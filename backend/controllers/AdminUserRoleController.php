<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\AdminUserRole;
use yii\web\NotFoundHttpException;
use backend\models\AdminUser;

/**
 * AdminUserRoleController implements the CRUD actions for AdminUserRole model.
 */
class AdminUserRoleController extends BaseController
{
	public $layout = "lte_main";
 
    /**
     * Lists all AdminUserRole models.
     * @return mixed
     */
    public function actionIndex($roleId)
    {
        
        return $this->render('index', [
            'role_id'=>$roleId
        ]);
    }

    public function actionTable($postParams)
    {
        $params = json_decode($postParams);
        $roleId = $params->roleId;
        $query = Yii::$app->db->createCommand('
         SELECT 
         ur.*,
         u.uname user_name,
         r.*
           FROM admin_user_role ur,
                admin_user u,
                admin_role r 
          WHERE ur.user_id = u.id
            AND ur.role_id = r.id
            AND ur.role_id='.$roleId.'')->queryAll();
        return json_encode($query);
    }

    /**
     * Displays a single AdminUserRole model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminUserRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUserRole();
        
        if ($model->load(Yii::$app->request->post())) {
              $user_name = Yii::$app->request->post('user_name', '');
              $condition = array();
              if(empty($user_name) == false){
                  $condition['uname'] = $user_name;
              }
              
              if(empty($model->user_id) == false){
                  $condition['id'] = $model->user_id;
              }
              
              if(count($condition) > 0){
                  $user = AdminUser::findOne($condition);
                  if(empty($user) == false){
                      $model->user_id = $user->id;
                  }
                  else{
                      $msg = array('error'=>2, 'data'=>array('user_id'=>'用户不存在'));
                      echo json_encode($msg);
                      exit();
                  }
              }
              
              $model->create_user = Yii::$app->user->identity->uname;
              $model->create_date = date('Y-m-d H:i:s');
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
     * Updates an existing AdminUserRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
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
     * Deletes an existing AdminUserRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminUserRole::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the AdminUserRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUserRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUserRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
