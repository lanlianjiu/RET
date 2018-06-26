<?php

use yii\helpers\Url;

?>
<div id="myCarousel" class="carousel slide" data-ride="carousel" >
	<!-- 轮播（Carousel）指标 -->
	<div class="imgNum">
        <?php foreach ($data['items'] as $k=>$list):?>
		<a data-target="#myCarousel" data-slide-to="<?=$k?>" class="<?=isset($list['active'])&&$list['active']?'active':'' ?>"></a>
		<?php endforeach;?>
	</div>   
	<!-- 轮播（Carousel）项目 -->
	<div class="carousel-inner home-banner" role="listbox" >
         <?php foreach ($data['items'] as $k=>$list):?>
		<div class=" <?=isset($list['active'])&&$list['active']?'active':'' ?>">
			<a herf="<?=Url::to($list['url'])?>"><img style="height:331px;width:100%"  src="<?=$list['image_url']?>" alt="First slide">
                <div class="carousel-caption">
                    <?=$list['html']?>
                </div>
            </a>
		</div>
		<?php endforeach;?>
	</div>
</div> 
