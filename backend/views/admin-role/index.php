
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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box-header search-box">
         <!-- row start search-->
          	<div class="row">
                <div class="col-sm-12">
                    <form bootstrap-table-form="adminRole-table" class="form-inline">
                        <div class="form-group" style="margin: 5px;">
                            <label>ID</label>
                            <input type="text" class="form-control"  name="id"  />
                        </div>

                        <div class="form-group" style="margin: 5px;">
                            <label>角色名称</label>
                            <input type="text" class="form-control"  name="name"  />
                        </div>
                        <div class="form-group">
                            <a bootstrap-table-search="adminRole-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                        </div>
                    </form>
                </div>
          	</div>
          	<!-- row end search -->
        </div>
        <div class="box">
            <div class="box-body">
                <div class="input-group input-group-sm action-toolbar">
                    <label>角色管理&nbsp;</label>
                    <button id="create_btn" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                    <button id="delete_btn" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                </div>
                <table id="adminRole-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                    data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                    data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-role/table" class="table  table-hover  th-table">
                    <thead>
                        <tr>
                            <th data-checkbox="true" width="80"></th>
                            <th data-sortable="true" data-field="id" width="80">ID</th>
                            <th data-sortable="true" data-field="code" width="80">角色编号</th>
                            <th data-sortable="true" data-field="name" width="80">角色名称</th>
                            <th data-sortable="true" data-field="des" width="80">角色描述</th>
                            <th data-sortable="true" data-field="update_user" width="120">更新人</th>
                            <th data-sortable="true" data-field="update_date" width="120">更新时间</th>
                            <th data-formatter="operateFormatter" width="120">操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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
                <?php $form = ActiveForm::begin(["id" => "admin-role-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-role/save")]); ?>                      
                <input type="hidden" class="form-control" id="id" name="AdminRole[id]" />
                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("code")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="AdminRole[code]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="name_div" class="form-group">
                    <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="AdminRole[name]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="des_div" class="form-group">
                    <label for="des" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("des")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="des" name="AdminRole[des]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="create_user_div" class="form-group">
                    <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_user" name="AdminRole[create_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="create_date_div" class="form-group">
                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_date" name="AdminRole[create_date]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="update_user_div" class="form-group">
                    <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_user" name="AdminRole[update_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="update_date_div" class="form-group">
                    <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_date" name="AdminRole[update_date]" placeholder="" />
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

<!-- 分配权限 -->
<div class="modal bootstrap-dialog type-primary modal-box fade" id="tree_dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title bootstrap-dialog-title">权限分配</h5>
			</div>
			<div class="modal-body">
			     <input type="hidden" id="select_role_id" />
                <?php $form = ActiveForm::begin(["id" => "system-role-form", "class"=>"form-horizontal", "action"=>Url::toRoute("system-role/save")]); ?>                
               <div id="treeview"></div>
                <?php ActiveForm::end(); ?>            
            </div>
			<div class="modal-footer text-c">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="right_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>
<!-- 分配权限结束 -->

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <?php include '/js/role.php';?>
<?php $this->endBlock(); ?>