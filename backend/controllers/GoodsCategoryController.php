<?php

namespace backend\controllers;

class GoodsCategoryController extends BaseController
{
    public $layout = "lte_main";
    public function actionIndex()
    {
        return $this->render('index');
    }

}
