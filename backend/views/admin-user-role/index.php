
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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box-header search-box">
         <!-- row start search-->
          	<div class="row">
                <div class="col-sm-12">
                    <form bootstrap-table-form="adminUserrole-table" class="form-inline">
                        <div class="form-group" style="margin: 5px;">
                            <label>ID:</label>
                            <input type="text" class="form-control"  name="id" />
                        </div>

                        <div class="form-group" style="margin: 5px;">
                            <label>用户ID:</label>
                            <input type="text" class="form-control"  name="user_id"  />
                        </div>
                        <div class="form-group">
                            <a bootstrap-table-search="adminUserrole-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                        </div>
                    </form>
                </div>
          	</div>
          	<!-- row end search -->
        </div>
       <div class="box">
            <div class="box-body">
                 <div class="input-group input-group-sm action-toolbar">
                    <label>用户-角色管理&nbsp;</label>
                    <button id="create_btn" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                    <button id="delete_btn" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                </div>
                <table id="adminUserrole-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                    data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                    data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-user-role/table" class="table  table-hover th-table">
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
  </div>
</section>
<!-- /.content -->

<div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title bootstrap-dialog-title">角色用户管理</h5>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-user-role-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-user-role/save")]); ?>                         
                <input type="hidden" class="form-control" id="id" name="AdminUserRole[id]" />

                <div id="user_id_div" class="form-group">
                    <label for="user_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("user_id")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_id" name="AdminUserRole[user_id]" />
                    </div>
                    <div class="clearfix"></div>
                </div>
          
                <div id="user_name_div" class="form-group">
                    <label for="user_name" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_name" name="user_name" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <input type="hidden" class="form-control" id="role_id" name="AdminUserRole[role_id]" value="<?=$role_id?>"/>

                <div id="create_user_div" class="form-group">
                    <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_user" name="AdminUserRole[create_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_date_div" class="form-group">
                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_date" name="AdminUserRole[create_date]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_user_div" class="form-group">
                    <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_user" name="AdminUserRole[update_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_date_div" class="form-group">
                    <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_date" name="AdminUserRole[update_date]" placeholder="" />
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
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/user-role.php';?>
<?php $this->endBlock(); ?>