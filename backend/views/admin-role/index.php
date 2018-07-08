
<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use backend\models\AdminRole;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminRole();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="admin-role-controller">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <form bootstrap-table-form="adminRole-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>角色名称</label>
                                    <input type="text" class="form-control"  name="name" />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminRole-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
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
                        <table id="adminRole-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="100" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-method="post" data-hide-column="id" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=admin-role/table" class="table  table-hover  th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" >ID</th>
                                    <th data-sortable="true" data-field="code" >角色编号</th>
                                    <th data-sortable="true" data-field="name" >角色名称</th>
                                    <th data-sortable="true" data-field="des" >角色描述</th>
                                    <!-- <th data-sortable="true" data-field="update_user" >更新人</th>
                                    <th data-sortable="true" data-field="update_date">更新时间</th> -->
                                    <th data-formatter="operateFormatter" >操作</th>
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
                                    <label for="code" class="control-label">角色编号</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.code" class="form-control" id="code" name="AdminRole[code]" placeholder="必填" />
                                </td>
                                <td align="right"> 
                                    <label for="name" class="control-label">角色名称</label>
                                </td>
                                <td>
                                <input type="text" ng-model="modal.name" class="form-control" id="name" name="AdminRole[name]" placeholder="必填" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="des" class="control-label">描述</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" class="form-control" ng-model="modal.des" id="des" name="AdminRole[des]" placeholder="" />
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

    <!-- 分配权限 -->
    <div class="modal bootstrap-dialog type-primary modal-box fade" data-model-overflow="true" id="tree_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">权限分配</h5>
                </div>
                <div class="modal-body" style="height:450px;">
                    <input type="text" class="hide" id="select_role_id" />
                    <form id="system-role-form" role="form"  method="post" >
                        <div id="treeview"></div>
                    </form>            
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button id="right_dialog_ok" ng-click="saveRight()"  class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 分配权限-->

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <?php include '/js/role.php';?>
<?php $this->endBlock(); ?>