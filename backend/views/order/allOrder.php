
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="allOrder-controller">

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
                <div class="box">
                    <div class="box-body">
                        <table id="allOrder-table"  data-toggle="table" data-show-columns="true" data-autoheight="100" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="order_id" data-unique-id="order_id" data-custom-url="index.php?r=order/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="order_id" width="80">ID</th>
                                    <th data-sortable="true" data-field="order_no" width="80">单号</th>
                                    <th data-sortable="true" data-field="order_amount" width="80">订单金额</th>
                                    <th data-sortable="true" data-field="create_uid" width="120">创建人</th>
                                    <th data-sortable="true" data-field="create_time" width="120">创建时间</th>
                                    <th data-formatter="operateFormatter" width="120">操作</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/allOrder.php';?>
<?php $this->endBlock(); ?>