
<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use backend\models\AdminUser;
use yii\helpers\Url;

$modelLabel = new \backend\models\AdminUser();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<div  data-content-box="body" ng-app="myApp" ng-controller="admin-user-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <form bootstrap-table-form="adminUser-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>ID</label>
                                    <input type="text" class="form-control"  name="id" />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminUser-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button id="create_btn" type="button" ng-click="addAction()" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button id="delete_btn" type="button" ng-click="del_action()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="adminUser-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-user/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="uname" width="80">登录账号</th>
                                    <th data-sortable="true" data-field="last_ip" width="80">最近一次登录ip</th>
                                    <th data-sortable="true" data-field="is_online" width="80">是否在线</th>
                                    <th data-sortable="true" data-field="status" width="120">状态</th>
                                    <th data-sortable="true" data-field="create_user" width="120">创建人</th>
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
                    <h5 class="modal-title bootstrap-dialog-title">添加</h5>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "admin-user-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-user/save")]); ?>                      
                    <input type="text" class="form-control hide" ng-model="modal.id" id="id" name="AdminUser[id]" />

                     <div id="head_img_url_div" class="form-group">
                        <label for="head_img_url" class="col-sm-2 control-label">头像</label>
                        <div class="col-sm-10">
                            <?= $form->field($modelLabel,'head_img_url')->widget('common\widgets\file_upload\FileUpload',['config'=>[]])?>
                        </div>
                    </div>

                   
                    <div id="uname_div" class="form-group">
                        <label for="uname" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.uname" id="uname" name="AdminUser[uname]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="password_div" class="form-group">
                        <label for="password" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" ng-model="modal.password" name="AdminUser[password]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="status_div" class="form-group">
                        <label for="status" class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  ng-model="modal.status"  id="status" name="AdminUser[status]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php ActiveForm::end(); ?>          
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
<?php include '/js/user.php';?>
<?php $this->endBlock(); ?>