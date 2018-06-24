<?php
namespace frontend\widgets\banner;

use Yii;
use yii\bootstrap\Widget;
class BannerWidget extends Widget{

    public $items = [];

    public function run(){

        $data['items'] = $this->items;
        return $this->render('index',['data'=>$data]);
    }

}






?>