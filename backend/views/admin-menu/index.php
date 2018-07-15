
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use backend\models\AdminMenu;
use yii\helpers\Url;
$modelLabel = new \backend\models\AdminMenu();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<div  data-content-box="body" ng-app="myApp" ng-controller="admin-menu-controller">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header search-box">
                    <div class="row">
                        <div class="col-sm-12" >
                            <form bootstrap-table-form="adminMenu-table" class="form-inline search-form">
                                <div class="form-group" style="margin: 5px;">
                                    <label>名称</label>
                                    <input type="text" class="form-control"  name="menu_name"  />
                                </div>
                                <div class="form-group">
                                    <button bootstrap-table-search="adminMenu-table" class="btn btn-outline btn-primary btn-sm"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button id="create_btn" ng-click="addMenu()" type="button" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button id="delete_btn" ng-click="del_action()" type="button" class="btn btn-sm btn-danger-outline"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="adminMenu-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="100" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-refresh="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-method="post" data-hide-column="id" data-content-type="application/x-www-form-urlencoded; charset=UTF-8" data-custom-url="index.php?r=admin-menu/table" class="table table-hover th-table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true" width="80"></th>
                                    <th data-sortable="true" data-field="id" width="80">ID</th>
                                    <th data-sortable="true" data-field="code" width="80">code</th>
                                    <th data-sortable="true" data-field="menu_name" width="80">名称</th>
                                    <th data-sortable="true" data-field="entry_right_name" width="120">入口地址名称</th>
                                    <th data-sortable="true" data-field="entry_url" width="120">入口地址</th>
                                    <th data-sortable="true" data-field="des" width="120">描述</th>
                                    <th data-sortable="true" data-field="display_order" width="120">显示顺序</th>
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

    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">子菜单管理</h5>
                </div>
                <div class="modal-body">
                    
                    <form id="admin-menu-form" role="form"  method="post" > 

                        <table class="table">
                            <tr>
                                <td align="right"> 
                                    <label for="code" class="control-label">编码</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.code" id="code" name="AdminMenu[code]" placeholder="必填" />
                                </td>
                                <td align="right"> 
                                    <label for="menu_name" class="control-label">名称</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="modal.menu_name" id="menu_name" name="AdminMenu[menu_name]" placeholder="必填" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td align="right"> 
                                    <label for="entry_url" class="control-label">入口地址</label>
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" ng-model="modal.entry_url" id="entry_url" name="AdminMenu[entry_url]" />
                                </td>
                                <td align="right"> 
                                    <label for="display_order" class="control-label">显示顺序</label>
                                </td>
                                <td>
                                <input type="text" class="form-control" ng-model="modal.display_order" id="display_order" name="AdminMenu[display_order]" placeholder="" />
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="controller" class="control-label">控制器</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" ng-model="modal.controller" name="AdminMenu[controller]" id="controller">
                                        <option ng-repeat="item in controllerData" value="{{item}}">{{item}}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"> 
                                    <label for="action" class="control-label">操作</label>
                                </td>
                                <td colspan="3">
                                    <select class="form-control" ng-model="modal.action" name="AdminMenu[action]" id="action">
                                        <option ng-repeat="item in selectData" value="{{item.value}}">{{item.label}}</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td align="right"> 
                                    <label for="des" class="control-label">描述</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" class="form-control" ng-model="modal.des" id="des" name="AdminMenu[des]" placeholder="" />
                                </td>
                            </tr>
                            
                        </table>
                        
                    </form>          
                </div>
                <div class="modal-footer text-c">
                    <button  class="btn btn-default" data-dismiss="modal">关闭</button> 
                    <button id="edit_dialog_ok" ng-click="saveMenu()"  class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<?php require dirname(__FILE__).'/js/menu.php';?>
<?php $this->endBlock(); ?>