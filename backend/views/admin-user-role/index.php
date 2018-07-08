
<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use backend\models\AdminUserRole;
use yii\helpers\Url;

$modelLabel = new \backend\models\AdminUserRole();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="admin-user-role-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <form bootstrap-table-form="adminUserrole-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>名称</label>
                                    <input type="text" class="form-control"  name="user_id"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminUserrole-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button id="create_btn" type="button" ng-click="addAction()" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button id="delete_btn" type="button" ng-click="del_action()" class="btn btn-sm btn-danger-outline"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="adminUserrole-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="100" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-method="post" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=admin-user-role/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="user_name" width="80">用户名称</th>
                                    <th data-sortable="true" data-field="name" width="80">角色</th>
                                    <th data-sortable="true" data-field="create_user" width="80">创建人</th>
                                    <th data-sortable="true" data-field="create_date" width="120">创建时间</th>
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
                    <h5 class="modal-title bootstrap-dialog-title">角色用户管理</h5>
                </div>
                <div class="modal-body">
                                          
                    <form id="admin-user-role-form" role="form"  method="post" > 

                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="user_id" class="control-label">用户ID</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.user_id" class="form-control" id="user_id" name="AdminUserRole[user_id]" />
                                </td>
                                <td align="right"> 
                                    <label for="user_name" class="control-label">用户名</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.user_name" class="form-control" id="user_name" name="AdminUserRole[user_name]" />
                                </td>
                            </tr>
                        </table>
                   
                    </form>          
                    </div>
                    <div class="modal-footer text-c">
                        <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                        <button id="edit_dialog_ok" ng-click="saveAction()" class="btn btn-primary">确定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/user-role.php';?>
<?php $this->endBlock(); ?>