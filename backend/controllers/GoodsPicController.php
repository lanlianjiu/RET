<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsPicModel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class GoodsPicController extends BaseController
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
        
        $postParams = Yii::$app->request->post("postParams");
        $params = json_decode($postParams);
        $goods_id = $params->goods_id;
        $query = Yii::$app->db->createCommand('
         SELECT 
         *
           FROM shp_goods_pic g
          WHERE g.goods_id='.$goods_id.'')->queryAll();
        return json_encode($query);
    }

    
    /**
     * Creates a new ShpGoodsPicModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShpGoodsPicModel();
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


}
