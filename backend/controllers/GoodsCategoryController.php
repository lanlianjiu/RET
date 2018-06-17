<?php
namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoodsCategory;
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

}
