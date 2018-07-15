
<?php
use backend\models\AdminModule;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
$modelLabel = new \backend\models\AdminModule();
?>

<?php $this->beginBlock('header');?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock();?>
<div  data-content-box="body" ng-app="myApp" ng-controller="admin-module-controller">
    <!--content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- row start search-->
                <div class="search-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <form bootstrap-table-form="adminModule-table" class="form-inline search-form">

                                <div class="form-group" style="margin: 5px;">
                                    <label>编码</label>
                                    <input type="text" class="form-control"  name="code"  />
                                </div>

                                <div class="form-group" style="margin: 5px;">
                                    <label>显示名称</label>
                                    <input type="text" class="form-control"  name="display_label"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminModule-table" class="btn btn-outline btn-primary btn-sm" > <i class="fa fa-search icon-white"></i> 搜索</button>
                                     <button class="btn btn-default btn-sm" type="submit" bootstrap-table-reset="adminModule-table">
                                        <i class="fa fa-repeat"></i>
                                        清除搜索
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- row end search -->
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button ng-click="addModule()" id="create_btn" type="button" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button ng-click="del_action()" id="delete_btn" type="button" class="btn btn-sm btn-danger-outline"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="adminModule-table" data-toolbar=".action-toolbar" data-show-refresh="true" data-toggle="table" data-show-columns="true" data-autoheight="100" 
                            data-pagination="true" data-filter-control="true" data-hide-column="id,entry_url" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-method="post" data-custom-url="index.php?r=admin-module/table" class="table  table-hover  th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="code" width="80">编码</th>
                                    <th data-sortable="true" data-field="display_label" width="80">显示名称</th>
                                    <th data-sortable="true" data-field="meun_icon" width="80">菜单图标</th>
                                    <th data-sortable="true" data-field="has_lef" width="120">是否有子</th>
                                    <th data-sortable="true" data-field="des" width="120">描述</th>
                                    <th data-sortable="true" data-field="entry_url" width="120">入口地址</th>
                                    <th data-sortable="true" data-field="display_order" width="120">顺序</th>
                                    <!-- <th data-sortable="true" data-field="update_user" width="120">修改人</th>
                                    <th data-sortable="true" data-field="update_date" width="120">修改时间</th> -->
                                    <th data-formatter="operateFormatter" width="120">操作</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->

    <!-- 弹窗 -->
    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">主菜单管理</h5>
                </div>
                <div class="modal-body">
                    <form id="admin-module-form" role="form"  method="post" >                    
        
                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="code" class="control-label">编码</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.code" id="code" name="AdminModule[code]" data-type="required" placeholder="必填" />
                                </td>
                                <td align="right"> 
                                    <label for="code" class="control-label">显示名称</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="display_label" data-type="required" ng-model="modal.display_label" name="AdminModule[display_label]" placeholder="必填" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="code" class="control-label">图标</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="meun_icon"  ng-model="modal.meun_icon" name="AdminModule[meun_icon]" data-type="required" placeholder="必填" />
                                </td>
                                <td align="right"> 
                                    <label for="code" class="control-label">顺序</label>
                                </td>
                                <td>
                                <input type="text" class="form-control" id="display_order" ng-model="modal.display_order" name="AdminModule[display_order]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="code" class="control-label">描述</label>
                                </td>
                                <td colspan="3">
                                <textarea type="text" class="form-control" id="des" ng-model="modal.des" name="AdminModule[des]" placeholder="" ></textarea>
                                </td>
                            </tr>
                        </table>

                    </form>
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit"  class="btn btn-primary" ng-click="saveModule()">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');?>
<!-- <body></body>后代码块 -->
<?php require dirname(__FILE__).'/js/module.php';?>
<?php $this->endBlock();?>