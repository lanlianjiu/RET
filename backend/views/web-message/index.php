
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

<div  data-content-box="body" ng-app="myApp" ng-controller="web-message-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <form bootstrap-table-form="webmessage-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>联系人</label>
                                    <input type="text" class="form-control"  name="connet_name"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="webmessage-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <table id="webmessage-table" data-toggle="table" data-show-columns="true" data-autoheight="150"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-refresh="true" data-show-export="true"
                            data-id-field="message_id" data-unique-id="message_id" data-method="post" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=web-message/table" class="table  table-hover th-table">
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
        </div>
    </section>

    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">留言信息</h5>
                </div>
                <div class="modal-body">
                   
                    <form id="admin-message-form" role="form"  method="post" >

                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="message_id" class="control-label">主键</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.message_id" class="form-control" id="message_id" name="WebMessage[message_id]" placeholder="" />
                                </td>
                                <td align="right"> 
                                    <label for="connet_name" class="control-label">联系人</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.connet_name" class="form-control" id="connet_name" name="WebMessage[connet_name]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="connet_phone" class="control-label">联系电话</label>
                                </td>
                                <td>
                                    <input type="text" ng-model="modal.connet_phone" class="form-control" id="connet_phone" name="WebMessage[connet_phone]" placeholder="" />
                                </td>
                                <td align="right"> 
                                    <label for="email" class="control-label">电子邮箱</label>
                                </td>
                                <td>
                                <input type="text" ng-model="modal.email" class="form-control" id="email" name="WebMessage[email]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="address" class="control-label">地址</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" ng-model="modal.address" class="form-control" id="address" name="WebMessage[address]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="message_content" class="control-label">留言内容</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" ng-model="modal.message_content" class="form-control" id="message_content" name="WebMessage[message_content]" placeholder="" />
                                </td>
                            </tr>
                            <!-- <tr>
                                <td> 
                                    <label for="is_look" class="control-label">是否已查看</label>
                                </td>
                                <td>
                                <input type="text" class="form-control" id="is_look" name="WebMessage[is_look]" placeholder="" /> 
                                </td>
                            </tr> -->
                        </table> 

                    </form>        
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php require dirname(__FILE__).'/js/webmessage.php';?>
<?php $this->endBlock(); ?>