<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\WebNavModel;
use frontend\widgets\banner\BannerWidget;
AppAsset::register($this);
//查询导航
$navmodel = new WebNavModel();
$mainNav = $navmodel->getMainnav();
$severNav = $navmodel->getServernav();
$this->title = '首页';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="<?=Url::base()?>/favicon2.ico">
     <title><?=$this->title?></title>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?=Url::base()?>/css/site.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container" style="width: 1035px;">
        <div class="site-index">
            <div class="body-content">
                <div class="row no-margin" style="background-color: #fbffed;">
                    <div class="col-lg-9">
                       <marquee scrollamount="3"><b>广州拓新保洁服务热线：0571-888888</b></marquee>
                    </div>
                    <div class="col-lg-3 inline">
                       <p class="title-nav"><?php echo '<a href="'.Url::toRoute('web-content/signup').'">注册</a>'; ?></p>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-lg-12 no-padding" style="height:195px;background-color: #A2D410;">
                        <embed src="img/flash5985.swf" width="100%" height="195" type="application/x-shockwave-flash" wmode="transparent" quality="high" align="absmiddle">
                    </div>
                </div>
                <div class="row no-margin ">
                    <div class="col-lg-12 no-padding">
                        <ul class="nav nav-pills nav-justified header-nav">
                            <?php
                            
                            foreach ($mainNav as $key => $value) {
                                echo  '<li><a href="'.Url::toRoute($value['url']).'">'.$value['web_nav_name'].'</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="row no-margin">
                            
                    <div class="col-lg-3" style="height:700px;border:1px solid #ddd;margin-top:5px;margin-bottom:5px;padding-right: 10px;
    padding-left: 10px;">
                        <h2><img src="img/index_08.png" width="238" height="38"></h2>
                        <div><?=BannerWidget::widget()?></div>
                        <div class="service-item"> 
                            <ul>
                                <?php
                                    foreach ($severNav as $key => $value) {
                                        echo  '<li><a href="#">'.$value['web_nav_name'].'</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <h3 class="content-title" style="margin-top: 2px;"><a href="Default.aspx">首页</a><span class="p-rl5">&gt;</span><a href="#">服务项目</a></h3>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer index-footer">
            <div class="row no-margin">
           <p> 版权所有：广州市拓新保洁服务有限公司     技术支持：广州首传科技有限公司</p>
            <p>公司地址：广州市萍水路389号        联系电话：0571-567567556        Email:771678566@qq.com</P>
            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
