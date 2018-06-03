
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\AdminModule;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminModule();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
             <!-- row start search-->
            <div class="box-header search-box">
                <div class="row">
                    <div class="col-sm-12">
                         <form bootstrap-table-form="adminModule-table" class="form-inline">
                        
                            <div class="form-group" style="margin: 5px;">
                                <label>ID</label>
                                <input type="text" class="form-control"  name="id"  />
                            </div>

                            <div class="form-group" style="margin: 5px;">
                                <label>code</label>
                                <input type="text" class="form-control"  name="code"  />
                            </div>

                            <div class="form-group" style="margin: 5px;">
                                <label>显示名称</label>
                                <input type="text" class="form-control"  name="display_label"  />
                            </div>
                            <div class="form-group">
                                <a bootstrap-table-search="adminModule-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <!-- row end search -->
            <div class="box">  
                <div class="box-body">
                    <div class="input-group input-group-sm action-toolbar">
                        <label>一级菜单列表&nbsp;</label>
                        <button id="create_btn" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                        <button id="delete_btn" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                    </div>
                    <table id="adminModule-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                        data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                        data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-module/table" class="table  table-hover  th-table">
                        <thead>
                            <tr>
                                <th data-checkbox="true" width="80"></th>
                                <th data-sortable="true" data-field="id" width="80">ID</th>
                                <th data-sortable="true" data-field="code" width="80">code</th>
                                <th data-sortable="true" data-field="display_label" width="80">显示名称</th>
                                <th data-sortable="true" data-field="meun_icon" width="80">菜单图标</th>
                                <th data-sortable="true" data-field="has_lef" width="120">是否有子</th>
                                <th data-sortable="true" data-field="des" width="120">描述</th>
                                <th data-sortable="true" data-field="entry_url" width="120">入口地址</th>
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
<!-- /.content -->

<!-- 弹窗 -->
<div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4>主菜单管理</h4>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-module-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-module/save")]); ?> 
                <input type="hidden" class="form-control" id="id" name="AdminModule[id]" />
                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("code")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="AdminModule[code]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="display_label_div" class="form-group">
                    <label for="display_label" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("display_label")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="display_label" name="AdminModule[display_label]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="meun_icon_div" class="form-group">
                    <label for="meun_icon" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("meun_icon")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meun_icon" name="AdminModule[meun_icon]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
		        <!-- 
                <div id="has_lef_div" class="form-group">
                    <label for="has_lef" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("has_lef")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="has_lef" name="AdminModule[has_lef]" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                -->
                <div id="des_div" class="form-group">
                    <label for="des" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("des")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="des" name="AdminModule[des]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- 
                <div id="entry_url_div" class="form-group">
                    <label for="entry_url" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("entry_url")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="entry_url" name="AdminModule[entry_url]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                -->
                <div id="display_order_div" class="form-group">
                    <label for="display_order" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("display_order")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="display_order" name="AdminModule[display_order]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_user_div" class="form-group">
                    <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_user" name="AdminModule[create_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_date_div" class="form-group">
                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_date" name="AdminModule[create_date]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_user_div" class="form-group">
                    <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_user" name="AdminModule[update_user]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="update_date_div" class="form-group">
                    <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="update_date" name="AdminModule[update_date]" placeholder="" />
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
<?php include '/js/module.php';?>
<?php $this->endBlock(); ?>