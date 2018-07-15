
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use backend\models\ShpGoodsSize;
use yii\helpers\Url;
$modelLabel = new \backend\models\ShpGoodsSize();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="ShpGoodsSize-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12" >
                            <form bootstrap-table-form="ShpGoodsSize-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>名称</label>
                                    <input type="text" class="form-control"  name="menu_name"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="ShpGoodsSize-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button id="create_btn" ng-click="addAction()" type="button" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button id="delete_btn" ng-click="del_action()" type="button" class="btn btn-sm btn-danger-outline"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="ShpGoodsSize-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="100" 
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-refresh="true" data-show-export="true"
                            data-id-field="goods_size_id" data-unique-id="goods_size_id" data-method="post" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=shp-goods-size/table" class="table table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="goods_size_id" width="80">ID</th>
                                    <th data-sortable="true" data-field="goods_id" width="80">商品ID</th>
                                    <th data-sortable="true" data-field="" width="80">商品名称</th>
                                    <th data-sortable="true" data-field="size_value" width="120">尺寸值</th>
                                    <th data-sortable="true" data-field="is_used" width="120">是否启用</th>
                                    <th data-formatter="operateFormatter" width="120">操作</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">添加</h5>
                </div>
                <div class="modal-body">
                    
                    <form id="shp-goods-size-form" role="form"  method="post" > 

                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="size_value" class="control-label">尺寸值</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.size_value" id="size_value" name="ShpGoodsSize[size_value]" placeholder="必填" />
                                </td>
                                 <td align="right">
                                     <input type="checkbox" ng-model="modal.is_used" ng-true-value="1" ng-false-value="0" id="is_used" name="ShpGoodsSize[is_used]"  />
                                </td>
                                <td align="left"> 
                                    <label for="is_used" class="control-label">是否启用</label>
                                </td>
                            </tr>
                        </table>
                        
                    </form>          
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button id="edit_dialog_ok" ng-click="saveAction()"  class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php require dirname(__FILE__).'/js/shpgoodssize.php';?>
<?php $this->endBlock(); ?>