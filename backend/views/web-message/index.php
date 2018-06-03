
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use backend\models\WebMessageModel;
use yii\helpers\Url;
$modelLabel = new \backend\models\WebMessageModel();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box-header search-box">
          	<div class="row">
                <div class="col-sm-12">
                    <form bootstrap-table-form="webmessage-table" class="form-inline">
                        <div class="form-group" style="margin: 5px;">
                            <label>ID</label>
                            <input type="text" class="form-control"  name="message_id"  />
                        </div>
                        <div class="form-group">
                            <a bootstrap-table-search="webmessage-table" class="btn btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</a>
                        </div>
                    </form>
                </div>
          	</div>
        </div>
        <!-- /.box-header -->
        <div class="box">
            <div class="box-body">
                <table id="webmessage-table" data-toggle="table" data-show-columns="true" data-autoheight="160" data-show-export="true"
                    data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                    data-id-field="message_id" data-unique-id="message_id" data-custom-url="index.php?r=web-message/table" class="table  table-hover th-table">
                    <thead>
                        <tr>
                            <th data-checkbox="true" width="80"></th>
                            <th data-sortable="true" data-field="message_id" width="80">ID</th>
                            <th data-sortable="true" data-field="connet_name" width="120">联系人</th>
                            <th data-sortable="true" data-field="connet_phone" width="80">联系电话</th>
                            <th data-sortable="true" data-field="email" width="80">电子邮箱</th>
                            <th data-sortable="true" data-field="address" width="80">地址</th>
                            <th data-sortable="true" data-field="message_content" width="120">留言内容</th>
                            <th data-sortable="true" data-field="create_date" width="120">留言时间</th>
                            <th data-sortable="true" data-field="is_look" width="120">是否已查看</th>
                            <th data-formatter="operateFormatter" width="120">操作</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
				<h3>留言信息</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-message-form", "class"=>"form-horizontal", "action"=>"index.php?r=admin-log/save"]); ?>                      
                        
                <input type="hidden" class="form-control" id="id" name="WebMessage[id]" />

                <div id="message_id_div" class="form-group">
                    <label for="message_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("message_id")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="message_id" name="WebMessage[message_id]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="connet_name_div" class="form-group">
                    <label for="connet_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("connet_name")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="connet_name" name="WebMessage[connet_name]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="connet_phone_div" class="form-group">
                    <label for="connet_phone" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("connet_phone")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="connet_phone" name="WebMessage[connet_phone]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="email_div" class="form-group">
                    <label for="email" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="WebMessage[email]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="address_div" class="form-group">
                    <label for="address" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("address")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="WebMessage[address]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="message_content_div" class="form-group">
                    <label for="message_content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("message_content")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="message_content" name="WebMessage[message_content]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="create_date_div" class="form-group">
                    <label for="create_date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_date")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="create_date" name="WebMessage[create_date]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="is_look_div" class="form-group">
                    <label for="is_look" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("is_look")?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="is_look" name="WebMessage[is_look]" placeholder="" />
                    </div>
                    <div class="clearfix"></div>
                </div> 

                <?php ActiveForm::end(); ?>          
            </div>
            <div class="modal-footer text-c">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
		</div>
	</div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php include '/js/webmessage.php';?>
<?php $this->endBlock(); ?>