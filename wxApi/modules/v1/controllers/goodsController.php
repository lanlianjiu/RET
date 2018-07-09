<?php

namespace wxApi\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
class goodsController extends ActiveController
{
   public $modelClass = 'wxApi\models\goodsModel';

}
