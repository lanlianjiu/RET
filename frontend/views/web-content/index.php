<?php
  use yii\helpers\Url;
  use frontend\widgets\banner\BannerWidget;
?>
    <div class="banner comWidth clearfix">
		<div class="banner_bar banner_big">
            <div><?=BannerWidget::widget(['items'=> [
                ['label'=>'demo',
                'image_url'=>'images/banner/banner_01.jpg',
                'url'=>'site/index',
                 'html'=>'',
                 'active'=>'active'
                 ],
                ['label'=>'demo',
                'image_url'=>'images/banner/banner_02.jpg',
                'url'=>'site/index',
                'html'=>''],
                ['label'=>'demo',
                'image_url'=>'img/leftbanner/3.jpg',
                'url'=>'site/index',
                'html'=>''], 
                ['label'=>'demo',
                'image_url'=>'img/leftbanner/4.jpg',
                'url'=>'site/index',
                'html'=>''],
            ]])?></div>
		</div>
	</div>
	<div class="shopTit comWidth">
		<span class="icon"></span>
        <h3>女装</h3>
		<a href="#" class="more">更多&gt;&gt;</a>
	</div>
	<div class="shopList comWidth clearfix">
		<div class="rightArea">
			<div class="shopList_top clearfix row">
                 <?php
                            
                    foreach ($womendata as $key => $value) {
                        echo  '<div class="shop_item col-md-3">
                                    <div class="shop_img">
                                        <a href="#">
                                            <img src="'.$value['goods_main_pic'].'" alt="">
                                        </a>
                                    </div>
                                    <h3>'.$value['goods_name'].'</h3>
                                    <p>￥'.$value['goods_price'].'元</p>
                                </div>';
                    }
                    ?>
				
			</div>
		</div>
    </div>
    
    <div class="shopTit comWidth">
		<span class="icon"></span>
        <h3>男装</h3>
		<a href="#" class="more">更多&gt;&gt;</a>
	</div>
	<div class="shopList comWidth clearfix">
		<div class="rightArea">
			<div class="shopList_top clearfix row">
                 <?php
                            
                    foreach ($mendata as $key => $value) {
                        echo  '<div class="shop_item col-md-3">
                                    <div class="shop_img">
                                        <a href="#">
                                            <img src="'.$value['goods_main_pic'].'" alt="">
                                        </a>
                                    </div>
                                    <h3>'.$value['goods_name'].'</h3>
                                    <p>￥'.$value['goods_price'].'元</p>
                                </div>';
                    }
                    ?>
				
			</div>
		</div>
	</div>
