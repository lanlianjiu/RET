<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsBrand;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class GoodsBrandController  extends BaseController
{
    public $layout = "lte_main";

      public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create','upload','ueditor'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get','post'],
                ],
            ],
        ];
    }


    public function actions(){
        return [
            'upload'=>[
                    'class'=>'common\widgets\file_upload\UploadAction',
                    'config'=>[
                        'imagePathFormat' => "/SHP/backend/web/uploadimg/{yyyy}{mm}{dd}/{time}{rand:6}",
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
         SELECT *
           FROM shp_goods_brand')->queryAll();
        return json_encode($query);
    }

     /**
     * Creates a new ShpGoodsBrand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShpGoodsBrand();
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
     * Updates an existing ShpGoodsBrand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('brand_id');
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

    /**
     * Deletes an existing ShpGoodsBrand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = ShpGoodsBrand::deleteAll(['in', 'brand_id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    
      /**
     * Finds the ShpGoodsBrand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ShpGoodsBrand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShpGoodsBrand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
