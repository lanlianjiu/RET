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
use yii\bootstrap\Widget;
AppAsset::register($this);
//查询导航
$navmodel = new WebNavModel();
$mainNav = $navmodel->getMainnav();
$severNav = $navmodel->getServernav();
$categoryInfo = $navmodel->getCategory();
$this->title = '首页';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="<?=Url::base()?>/favicon.ico">
     <title><?=$this->title?></title>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?=Url::base()?>/css/reset.css">
    <link rel="stylesheet" href="<?=Url::base()?>/css/main.css">
</head>
<body>
<?php $this->beginBody() ?>
	<div class="headerBar">
		<div class="topBar">
			<div class="comWidth row">
                <!-- <div class="col-md-8" style="float:left">
                     <marquee scrollamount="3"><b>广州拓新保洁服务热线：0571-888888</b></marquee>
                </div> -->
				<div class="rightArea col-md-4">
					欢迎来到傻帽小婷网！
					<?php
						if(Yii::$app->user->isGuest){
							
							echo '<a href="'.Url::toRoute('web-content/login').'">[登录]</a>'; 
						}else{
							echo '<a href="'.Url::toRoute('web-content/logout').'">[退出]</a>';
						};
					?>
					<?php echo '<a href="'.Url::toRoute('web-content/signup').'">[免费注册]</a>'; ?>
				</div>
			</div>
		</div>
		<div class="logoBar">
			<div class="comWidth">
				<div class="logo fl">
					<a href="#">
						<img src="images/1.png" style="width: 110px;height: 55px;" alt="">
					</a>
				</div>
				<div class="search_box fl">
					<input type="text" class="search_text fl">
					<input type="button" value="搜 索" class="search_btn fr">
				</div>
				<div class="shopCar fr">
					<span class="shopText fl">购物车</span>
					<span class="shopNum fl">0</span>
				</div>
			</div>
		</div>
		<div class="navBox">
			<div class="comWidth clearfix">
				<div class="shopClass fl">
					<h5 class="h5-all">全部商品分类
						<i class="shopClass_icon"></i>
					</h5>
					<div class="shopClass_show">
					<?php
						foreach ($categoryInfo as $key => $value) {
							echo  '<dl class="shopClass_item">
										<dt>
											<a href="#" class="b">'.$value['name'].'</a>
										</dt>
										<div class="shopClass_list fade">
											<div class="shopClass_cont">
											'; 
												foreach ($value['child'] as $k => $v) {
													
											  echo '<dl class="shopList_item">
														<dt>'.$v['name'].'</dt>
														<dd class="shopClass_there_list">';
																foreach ($v['child'] as $n => $m) {
																	echo '<a href="#">'.$m['name'].'</a>';
																};

												 echo  '</dd>
													</dl>';
												};
									 echo  '</div>
										</div>
									</dl>';
						}
					?>
					</div>
				</div>
				<ul class="nav fl">
                     <?php
                                
                        foreach ($mainNav as $key => $value) {
                            echo  '<li><a href="'.Url::toRoute($value['url']).'">'.$value['web_nav_name'].'</a></li>';
                        }
                    ?>
				</ul>
			</div>
		</div>
	</div>
	 <?= $content ?>
	<div class="hr_25"></div>
	<div class="footer">
		<p>
			<a href="#">衣旺介绍</a>
			<i>|</i>
			<a href="#">衣旺公告</a>
			<i>|</i>
			<a href="#">衣旺特色</a>
			<i>|</i>
			<a href="#">联系我们</a>
			<i>|</i>客服热线：400-675-1234</p>
		<p>Copyright &copy; 2006 - 2014 衣旺网权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
		<p class="web">
			<a href="#">
				<img src="images/webLogo.jpg" alt="logo">
			</a>
		</p>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
