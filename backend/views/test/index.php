
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\Test;

$modelLabel = new \backend\models\Test();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
        			|
        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'test-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('test/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'controller_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'controller_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('controller_id').'</th>';
              echo '<th onclick="orderby(\'action_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'action_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('action_id').'</th>';
              echo '<th onclick="orderby(\'url\', \'desc\')" '.CommonFun::sortClass($orderby, 'url').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('url').'</th>';
              echo '<th onclick="orderby(\'module_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'module_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('module_name').'</th>';
              echo '<th onclick="orderby(\'func_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'func_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('func_name').'</th>';
              echo '<th onclick="orderby(\'right_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'right_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('right_name').'</th>';
              echo '<th onclick="orderby(\'client_ip\', \'desc\')" '.CommonFun::sortClass($orderby, 'client_ip').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('client_ip').'</th>';
              echo '<th onclick="orderby(\'create_user\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_user').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_user').'</th>';
              echo '<th onclick="orderby(\'create_date\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_date').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->controller_id . '</td>';
                echo '  <td>' . $model->action_id . '</td>';
                echo '  <td>' . $model->url . '</td>';
                echo '  <td>' . $model->module_name . '</td>';
                echo '  <td>' . $model->func_name . '</td>';
                echo '  <td>' . $model->right_name . '</td>';
                echo '  <td>' . $model->client_ip . '</td>';
                echo '  <td>' . $model->create_user . '</td>';
                echo '  <td>' . $model->create_date . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '»',
              	    'prevPageLabel' => '«',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
          	</div>
		  </div>
		  <!-- row end -->
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

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "test-form", "class"=>"form-horizontal", "action"=>Url::toRoute("test/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="controller_id_div" class="form-group">
              <label for="controller_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("controller_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="controller_id" name="Test[controller_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="action_id_div" class="form-group">
              <label for="action_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("action_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="action_id" name="Test[action_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="url_div" class="form-group">
              <label for="url" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("url")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="url" name="Test[url]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="module_name_div" class="form-group">
              <label for="module_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("module_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="module_name" name="Test[module_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="func_name_div" class="form-group">
              <label for="func_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("func_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="func_name" name="Test[func_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="right_name_div" class="form-group">
              <label for="right_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("right_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="right_name" name="Test[right_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="client_ip_div" class="form-group">
              <label for="client_ip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("client_ip")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_ip" name="Test[client_ip]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_user_div" class="form-group">
              <label for="create_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_user" name="Test[create_user]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_date_div" class="form-group">
              <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_date" name="Test[create_date]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/test.php';?>
<?php $this->endBlock(); ?>