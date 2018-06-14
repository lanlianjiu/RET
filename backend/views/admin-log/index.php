
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\AdminLog;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminLog();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div data-content-box="body" ng-app="myApp" ng-controller="admin-log-controller">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
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
                        <table id="adminLog-table" data-toggle="table" data-show-columns="true" data-autoheight="137" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-log/table" class="table table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="controller_id" width="120">控制器ID</th>
                                    <th data-sortable="true" data-field="action_id" width="80">方法ID</th>
                                    <th data-sortable="true" data-field="url" width="80">访问地址</th>
                                    <th data-sortable="true" data-field="module_name" width="80">模块</th>
                                    <th data-sortable="true" data-field="func_name" width="120">功能</th>
                                    <th data-sortable="true" data-field="right_name" width="120">方法</th>
                                    <th data-sortable="true" data-field="client_ip" width="120">客户端IP</th>
                                    <th data-sortable="true" data-field="create_user" width="120">用户</th>
                                    <th data-sortable="true" data-field="create_date" width="120">时间</th>
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
                    <h5 class="modal-title bootstrap-dialog-title">查看</h5>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "admin-log-form", "class"=>"form-horizontal", "action"=>"index.php?r=admin-log/save"]); ?> 

                    <table class="table">
                        <tr>
                            <td> 
                               <input type="text" class="form-control hide" ng-model="modal.id" id="id" name="AdminLog[id]" />
                               <label for="controller_id" class="control-label">控制器</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" id="controller_id" ng-model="modal.controller_id" name="AdminLog[controller_id]" placeholder="" />
                            </td>
                            <td> 
                                <label for="action_id" class="control-label">方法</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" id="action_id" ng-model="modal.action_id" name="AdminLog[action_id]" placeholder="" />
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                  <label for="url" class="control-label">URL</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" ng-model="modal.url" id="url" name="AdminLog[url]" placeholder="" />
                            </td>
                            <td> 
                                 <label for="module_name" class="control-label">模块</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" ng-model="modal.module_name" id="module_name" name="AdminLog[module_name]" placeholder="" />
                            </td>
                        </tr>
                         <tr>
                            <td> 
                                 <label for="func_name" class="control-label">功能</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" ng-model="modal.func_name" id="func_name" name="AdminLog[func_name]" placeholder="" />
                            </td>
                             <td> 
                                  <label for="right_name" class="control-label">方法名</label>
                            </td>
                            <td>
                               <input type="text" class="form-control" ng-model="modal.right_name" id="right_name" name="AdminLog[right_name]" placeholder="" />
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                <label for="client_ip" class="control-label">客户端IP</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" ng-model="modal.client_ip" id="client_ip" name="AdminLog[client_ip]" placeholder="" />
                            </td>
                             <td> 
                               <label for="create_user" class="control-label">创建人</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" ng-model="modal.create_user" id="create_user" name="AdminLog[create_user]" placeholder="" />
                            </td>
                        </tr>
                         <tr>
                            <td> 
                                <label for="create_date" class="control-label">创建时间</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" ng-model="modal.create_date" id="create_date" name="AdminLog[create_date]" placeholder="" />
                            </td>
                        </tr>
                    </table>  

                    
                    <?php ActiveForm::end(); ?>          
                </div>
                <div class="modal-footer text-c">
                    <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
                        id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
                </div>
            </div>
        </div>
    </div>
 </div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/log.php';?>
<?php $this->endBlock(); ?>