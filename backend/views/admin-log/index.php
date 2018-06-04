
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
<div class="content-box" ng-app="myApp" ng-controller="admin-log-controller">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <form bootstrap-table-form="adminLog-table" class="form-inline">
                        <div class="form-group" style="margin: 5px;">
                            <label>主键ID</label> <input type="text" class="form-control" name="id"  />
                        </div>
                        <div class="form-group">
                            <a bootstrap-table-search="adminLog-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                        </div>
                    </form>
                </div>
                <div class="box-header search-box">
                    <div class="box-body">
                        <table id="adminLog-table" data-toggle="table" data-show-columns="true" data-autoheight="150" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="orderId" data-unique-id="orderId" data-custom-url="index.php?r=admin-log/table" class="table table-hover th-table">
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
    <!-- /.content -->
    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">设置</h5>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "admin-log-form", "class"=>"form-horizontal", "action"=>"index.php?r=admin-log/save"]); ?>                      
                            
                    <input type="hidden" class="form-control" id="id" name="AdminLog[id]" />

                    <div id="controller_id_div" class="form-group">
                        <label for="controller_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("controller_id")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="controller_id" name="AdminLog[controller_id]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="action_id_div" class="form-group">
                        <label for="action_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("action_id")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="action_id" name="AdminLog[action_id]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="url_div" class="form-group">
                        <label for="url" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("url")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="url" name="AdminLog[url]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="module_name_div" class="form-group">
                        <label for="module_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("module_name")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="module_name" name="AdminLog[module_name]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="func_name_div" class="form-group">
                        <label for="func_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("func_name")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="func_name" name="AdminLog[func_name]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="right_name_div" class="form-group">
                        <label for="right_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("right_name")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="right_name" name="AdminLog[right_name]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="client_ip_div" class="form-group">
                        <label for="client_ip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("client_ip")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="client_ip" name="AdminLog[client_ip]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="create_user_div" class="form-group">
                        <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="create_user" name="AdminLog[create_user]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="create_date_div" class="form-group">
                        <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="create_date" name="AdminLog[create_date]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div> 

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