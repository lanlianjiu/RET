
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\ShpGoodsBrand;
use yii\helpers\Url;
$modelLabel = new \backend\models\ShpGoodsBrand();
$form = ActiveForm::begin(["id" => "web-nav-form"]);//定义form表单，调用组件需要
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="web-goodsbrand-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <form bootstrap-table-form="goodsbrand-table" class="form-inline search-form">
                            
                                <div class="form-group" style="margin: 5px;">
                                    <label>类型</label>
                                    <input type="text" class="form-control"  name="web_navType_id"  />
                                </div>

                                <div class="form-group" style="margin: 5px;">
                                    <label>名称</label>
                                    <input type="text" class="form-control"  name="web_nav_name"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="goodsbrand-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">  
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <div class="from-gruop">
                                <button id="create_btn" type="button" ng-click="addAction()" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-plus"></i> 添加</button>
                                <button id="delete_btn" type="button" ng-click="del_action()" class="btn btn-sm btn-danger-outline"><i class="fa fa-trash"></i> 批量删除</button>
                            </div>
                        </div>
                        <table id="goodsbrand-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="100" 
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-refresh="true" data-show-export="true" data-id-field="brand_id" data-unique-id="brand_id" data-hide-column="brand_icon" data-method="post" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=goods-brand/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="brand_id" width="80">ID</th>
                                    <th data-sortable="true" data-field="brand_name" width="120">品牌名称</th>
                                    <th data-sortable="true" data-field="brand_icon" width="80">品牌logo</th>
                                    <th data-formatter="logoFormatter" width="80">品牌logo</th>
                                    <th data-sortable="true" data-field="is_used" width="80">是否启用</th>
                                    <th data-formatter="operateFormatter" width="120">操作</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 弹窗 -->
    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">品牌</h5>
                </div>
                <div class="modal-body">
                    
                    <form id="web-nav-form" role="form"  method="post">
                     
                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="brand_icon" class="control-label">logo</label>
                                </td>
                                <td>
                                   <?= $form->field($modelLabel,'brand_icon')->widget('common\widgets\file_upload\FileUpload',['config'=>[]])?>
                                </td>
                                
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="brand_name" class="control-label">品牌名称</label>
                                </td>
                                <td>
                                   <input type="text" ng-model="modal.brand_name" class="form-control"  name="ShpGoodsBrand[brand_name]" placeholder="必填" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="is_used" class="control-label">是否启用</label>
                                </td>
                                <td>
                                     <input type="checkbox" ng-model="modal.is_used" ng-true-value="1" ng-false-value="0"  name="ShpGoodsBrand[is_used]"  />
                                </td>
                            </tr>
                        </table>

                    </form>          
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button  id="edit_dialog_ok" ng-click="saveAction()" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/goodsbrand.php';?>
<?php $this->endBlock(); ?>