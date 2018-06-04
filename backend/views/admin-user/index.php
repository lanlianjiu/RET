
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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box-header search-box">
            <!-- row start search-->
          	<div class="row">
                <div class="col-sm-12">
                    <form bootstrap-table-form="adminUser-table" class="form-inline">
                    <div class="form-group" style="margin: 5px;">
                        <label>ID</label>
                        <input type="text" class="form-control"  name="id" />
                    </div>
                    <div class="form-group">
                        <a bootstrap-table-search="adminUser-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                    </div>
                </form>
                </div>
          	</div>
          	<!-- row end search -->
        </div>
        <div class="box">
            <div class="box-body">
                <div class="input-group input-group-sm action-toolbar">
                    <label>用户管理&nbsp;</label>
                    <button id="create_btn" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                    <button id="delete_btn" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                </div>
                <table id="adminUser-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                    data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                    data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-user/table" class="table  table-hover th-table">
                    <thead>
                        <tr>
                            <th data-checkbox="true" width="80"></th>
                            <th data-sortable="true" data-field="id" width="80">ID</th>
                            <!-- <th data-sortable="true" data-field="password" width="120">密码</th>
                            <th data-sortable="true" data-field="auth_key" width="80">自动登录key</th> -->
                            <th data-sortable="true" data-field="uname" width="80">登录账号</th>
                            <th data-sortable="true" data-field="last_ip" width="80">最近一次登录ip</th>
                            <th data-sortable="true" data-field="is_online" width="80">是否在线</th>
                            <!-- <th data-sortable="true" data-field="domain_account" width="120">域账号</th> -->
                            <th data-sortable="true" data-field="status" width="120">状态</th>
                            <th data-sortable="true" data-field="create_user" width="120">创建人</th>
                            <th data-sortable="true" data-field="create_date" width="120">创建时间</th>
                            <!-- <th data-sortable="true" data-field="update_user" width="120">更新人</th>
                            <th data-sortable="true" data-field="update_date" width="120">更新时间</th> -->
                            <th data-formatter="operateFormatter" width="120">操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
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
                <?php $form = ActiveForm::begin(["id" => "admin-user-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-user/save")]); ?>                      
                 <input type="hidden" class="form-control" id="id" name="AdminUser[id]" />
                 <!-- 
                <div id="id_div" class="form-group">
                    <label for="id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("id")?></label>
                    <div class="col-sm-10">
                
                    </div>
                    <div class="clearfix"></div>
                </div>
                -->
                <div id="uname_div" class="form-group">
                    <label for="uname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("uname")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="uname" name="AdminUser[uname]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="password_div" class="form-group">
                    <label for="password" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("password")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="AdminUser[password]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="auth_key_div" class="form-group">
                    <label for="auth_key" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("auth_key")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="auth_key" name="AdminUser[auth_key]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="last_ip_div" class="form-group">
                    <label for="last_ip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("last_ip")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="last_ip" name="AdminUser[last_ip]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="is_online_div" class="form-group">
                    <label for="is_online" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_online")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="is_online" name="AdminUser[is_online]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="domain_account_div" class="form-group">
                    <label for="domain_account" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("domain_account")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="domain_account" name="AdminUser[domain_account]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="status_div" class="form-group">
                    <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="status" name="AdminUser[status]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_user_div" class="form-group">
                    <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_user" name="AdminUser[create_user]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_date_div" class="form-group">
                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_date" name="AdminUser[create_date]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_user_div" class="form-group">
                    <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_user" name="AdminUser[update_user]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?= $form->field($modelLabel,'head_img_url')->widget('common\widgets\file_upload\FileUpload',['config'=>[]])?>
                <div id="update_date_div" class="form-group">
                    <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_date" name="AdminUser[update_date]" placeholder="必填" />
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
<?php include '/js/user.php';?>
<?php $this->endBlock(); ?>