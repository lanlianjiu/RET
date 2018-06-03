
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use backend\models\AdminRight;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminRight();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
        <div class="col-xs-12">
            <!-- row start search-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-header search-box">
                        <form bootstrap-table-form="adminRight-table" class="form-inline">
                            <div class="form-group" style="margin: 5px;">
                                <label>ID</label>
                                <input type="text" class="form-control"  name="id"  />
                            </div>
                            <div class="form-group">
                                <a bootstrap-table-search="adminRight-table" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- row end search -->
            <div class="box">
                <div class="box-body">
                    <div class="input-group input-group-sm action-toolbar">
                        <label>路由管理&nbsp;</label>
                        <button id="create_btn" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                        <button id="delete_btn" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                    </div>
                    <table id="adminRight-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                        data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                        data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-right/table" class="table  table-hover th-table">
                        <thead>
                            <tr>
                                <th data-checkbox="true" width="80"></th>
                                <th data-sortable="true" data-field="id" width="80">ID</th>
                                <th data-sortable="true" data-field="right_name" width="80">名称</th>
                                <th data-sortable="true" data-field="display_order" width="80">显示顺序</th>
                                <th data-sortable="true" data-field="has_lef" width="120">是否有子</th>
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

<div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4>路由管理</h4>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-right-form", "class"=>"form-horizontal", "action"=>Url::toRoute('admin-right/save')]); ?>                      
                 
                 <input type="hidden" class="form-control" id="id" name="id" />
          		 <input type="hidden" class="form-control" id="menu_id" name="AdminRight[menu_id]" value="<?=$menu_id?>" />
                 
          <div id="right_name_div" class="form-group">
              <label for="right_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("right_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="right_name" name="AdminRight[right_name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="display_label_div" class="form-group">
              <label for="display_label" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("display_label")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="display_label" name="AdminRight[display_label]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="des_div" class="form-group">
              <label for="des" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("des")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="des" name="AdminRight[des]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="display_order_div" class="form-group">
              <label for="display_order" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("display_order")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="display_order" name="AdminRight[display_order]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

			<div id="controller_div" class="form-group">
    			<label for="controller" class="col-sm-2 control-label">控制器ID</label>
    			<div class="col-sm-10">
    				<select class="form-control" name="SystemFunction[controller]" id="controller">
    				  <option>请选择</option>
    				<?php 
    				   
    				  foreach($controllerData as $key=>$data){
    				      echo "<option value='" . $key . "'>". $key."</option>";
    				  }
    				?>
            	   </select>
    			</div>
    			<div class="clearfix"></div>
    		</div>

			<div id="actions_div" class="form-group">
    			<label for="actions" class="col-sm-2 control-label">路由地址</label>
    			<div class="col-sm-10">
    				<div id="treeview"></div>
    			</div>
    			<div class="clearfix"><br/></div>
    		</div>  

          <div id="has_lef_div" class="form-group">
              <label for="has_lef" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("has_lef")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="has_lef" name="AdminRight[has_lef]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_user_div" class="form-group">
              <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_user" name="AdminRight[create_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="AdminRight[create_date]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_user_div" class="form-group">
              <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_user" name="AdminRight[update_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_date_div" class="form-group">
              <label for="update_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_date" name="AdminRight[update_date]" placeholder="" />
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
<?php include '/js/right.php';?>
<?php $this->endBlock(); ?>