
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
$modelLabel = new \backend\models\WebUserModel();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="web-user-controller">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <form bootstrap-table-form="webuser-table" class="form-inline search-form">
                            
                                <div class="form-group" style="margin: 5px;">
                                    <label>ID</label>
                                    <input type="text" class="form-control"  name="id"  />
                                </div>

                                <div class="form-group" style="margin: 5px;">
                                    <label>名称</label>
                                    <input type="text" class="form-control"  name="username"  />
                                </div>
                                <div class="form-group">
                                    <a bootstrap-table-search="webuser-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">  
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <div class="from-gruop">
                                <button id="delete_btn" ng-click="del_action()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                            </div>
                        </div>
                        <table id="webuser-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=web-user/table" class="table  table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="username" width="120">会员名称</th>
                                    <th data-sortable="true" data-field="email" width="80">邮箱</th>
                                    <th data-sortable="true" data-field="vip_1v" width="80">会员等级</th>
                                    <th data-sortable="true" data-field="created_at" width="80">创建时间</th>
                                    <th data-sortable="true" data-field="updated_at" width="80">更新时间</th>
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
                    <h5 class="modal-title bootstrap-dialog-title">会员管理</h5>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "web-user-form", "class"=>"form-horizontal"]); ?> 
                    <input type="text" class="form-control hide" ng-model="modal.id" id="id" name="WebUserModel[id]" />

                    <div id="username_div" class="form-group">
                        <label for="username" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.username" id="username" name="WebUserModel[username]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="email_div" class="form-group">
                        <label for="email" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.email" id="email" name="WebUserModel[email]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="vip_1v_div" class="form-group">
                        <label for="vip_1v" class="col-sm-2 control-label">会员等级</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.vip_1v" id="vip_1v" name="WebUserModel[vip_1v]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php ActiveForm::end(); ?>          
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button id="edit_dialog_ok" ng-click="saveAction()" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/webuser.php';?>
<?php $this->endBlock(); ?>