<?php

namespace backend\controllers;
use Yii;
use yii\data\Pagination;
use backend\models\ShpGoods;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class OrderController extends BaseController
{
    public $layout = "lte_main";
   
    //全部订单
    public function actionAllorder()
    {
        return $this->render('allOrder');
    }

    //待支付
    public function actionTobepaid()
    {
        return $this->render('paidOrder');
    }
    
    //待发货
    public function actionDelivery()
    {
        return $this->render('deliveryOrder');
    }

    //已发货
    public function actionShipped()
    {
        return $this->render('shippedOrder');
    }

    //运输中
    public function actionTransportation()
    {
        return $this->render('transportationOrder');
    }

    //已送达
    public function actionDelivered()
    {
        return $this->render('deliveredOrder');
    }

    //待签收
    public function actionWaitsign()
    {
        return $this->render('waitsignOrder');
    }

    //已签收
    public function actionSigned()
    {
        return $this->render('signedOrder');
    }

    //待评价
    public function actionEvaluated()
    {
        return $this->render('evaluatedOrder');
    }

    //已完成
    public function actionCompleted()
    {
        return $this->render('completedOrder');
    }


    //已取消
    public function actionCancel()
    {
        return $this->render('cancelOrder');
    }

     public function actionTable()
    {

        $order_status_id = Yii::$app->request->post("order_status_id");
        
        $sql  = "SELECT *FROM shp_orders o";
        
        if(isset($order_status_id)){
           
            $sql = "SELECT *FROM shp_orders o WHERE o.order_status_id=".$order_status_id;
        };

        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return json_encode($query);
    }

}
