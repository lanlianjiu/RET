<?php

namespace backend\controllers;

class GoodsController extends BaseController
{
    public $layout = "lte_main";
    public function actionIndex()
    {
        return $this->render('index');
    }

}
