
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use backend\models\AdminRight;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminRight();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="admin-right-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-header search-box">
                            <form bootstrap-table-form="adminRight-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>ID</label>
                                    <input type="text" class="form-control"  name="id"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminRight-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
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
                        <table id="adminRight-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="137" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-method="post" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=admin-right/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="right_name" width="80">名称</th>
                                    <th data-sortable="true" data-field="display_order" width="80">显示顺序</th>
                                    <th data-sortable="true" data-field="has_lef" width="120">是否有子</th>
                                    <th data-sortable="true" data-field="display_order" width="120">顺序</th>
                                    <th data-sortable="true" data-field="update_user" width="120">修改人</th>
                                    <th data-sortable="true" data-field="update_date" width="120">修改时间</th>
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
                    <h5 class="modal-title bootstrap-dialog-title">路由管理</h5>
                </div>
                <div class="modal-body">
                   
                    <form id="admin-right-form" role="form"  method="post" >        
                        <table class="table">
                            <tr>
                                <td align="right">        
                                    <label for="right_name" class="control-label">名称</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.right_name" id="right_name" name="AdminRight[right_name]" placeholder="必填" />
                                </td>
                                <td align="right"> 
                                    <label for="display_order" class="control-label">显示顺序</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.display_order" id="display_order" name="AdminRight[display_order]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="des" class="control-label">描述</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" class="form-control" ng-model="modal.des" id="des" name="AdminRight[des]" placeholder="" />
                                </td>
                            </tr>

                            <tr>
                                <td align="right">    
                                    <label for="controller" class="control-label">控制器</label>
                                </td>
                                <td colspan="3">
                                <select class="form-control" ng-model="modal.controller" name="SystemFunction[controller]" id="controller">
                                        <option>请选择</option>
                                        <?php 
                                        
                                        foreach($controllerData as $key=>$data){
                                            echo "<option value='" . $key . "'>". $key."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="actions" class="control-label">路由地址</label>
                                </td>
                                <td colspan="3">
                                    <div id="treeview"></div>
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
<?php include '/js/right.php';?>
<?php $this->endBlock(); ?>