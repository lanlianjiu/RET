<?php

namespace backend\controllers;

class GoodsBrandController  extends BaseController
{
    public $layout = "lte_main";
    public function actionIndex()
    {
        return $this->render('index');
    }

}
