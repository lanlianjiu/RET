
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\ShpGoodsCategory;
use yii\helpers\Url;
$modelLabel = new \backend\models\ShpGoodsCategory();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div data-content-box="body" ng-app="myApp" ng-controller="admin-goodscategory-controller">
    <section class="content">
        <div class="row">
        
            <div class="col-xs-3" style="padding-right:0px;">
                <div class="panel panel-default">
                    <div class="panel-heading fa-th-font">
                        <h4 class="panel-title right-1x">
                            <span> <i class="fa fa-th-list"></i>
                                商品分类
                            </span>
                        </h4>
                    </div>
                    <div class="panel-body" data-adaptionHeight="36">
                        <ul id="category-tree" class="ztree"></ul>
                    </div>
                </div>
            </div>

            <div class="col-xs-9">
                <div class="box-header search-box">
                    <form bootstrap-table-form="adminLog-table" class="form-inline search-form">
                        <div class="form-group" style="margin: 5px;">
                            <label>主键ID</label> <input type="text" class="form-control" name="id"  />
                        </div>
                        <div class="form-group">
                            <button bootstrap-table-search="adminLog-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                        </div>
                    </form>
                </div>
                <div class="box-header search-box">
                    <div class="box-body">
                        <table id="categoryToBrand-table" data-toggle="table" data-show-columns="true" data-autoheight="140" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id"  class="table table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" data-hidden="true" width="80">ID</th>
                                    <th data-sortable="true" data-field="brandName" width="80">品牌名称</th>
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
                     
                     <form id="admin-role-form" role="form"  method="post" > 
                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="category_name" class="control-label">分类名称</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.category_name" class="form-control" id="category_name" name="ShpGoodsCategory[category_name]" placeholder="必填" />
                                </td> 
                                <td align="right"> 
                                    <label for="is_used" class="control-label">是否启用</label>
                                </td>
                                <td>
                                     <input type="checkbox" ng-model="modal.is_used" ng-true-value="1" ng-false-value="0" id="code" name="ShpGoodsCategory[is_used]"  />
                                </td>
                            </tr>
                        </table>

                    </form>        
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button  ng-click="saveAction()" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/goodscategory.php';?>
<?php $this->endBlock(); ?>