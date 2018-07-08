
<?php
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="createOrder-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-header search-box">
                            <form bootstrap-table-form="allOrder-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>单号</label>
                                    <input type="text" class="form-control"  name="order_no"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="allOrder-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/createOrder.php';?>
<?php $this->endBlock(); ?>