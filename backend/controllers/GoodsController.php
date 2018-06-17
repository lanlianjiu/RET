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
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTable()
    {
        $query = Yii::$app->db->createCommand('
         SELECT 
              g.*
           FROM shp_goods g, 
                shp_goods_category c,
                shp_goods_brand b
          WHERE g.brand_id = b.brand_id
            AND g.category_id = c.category_id
           
           ')->queryAll();
        return json_encode($query);
    }

}
