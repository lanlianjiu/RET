
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
                                    <button bootstrap-table-search="adminMenu-table" class="btn btn-outline btn-primary btn-sm" href="#"> <i class="fa fa-search icon-white"></i> 搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="input-group input-group-sm action-toolbar">
                            <button id="create_btn" ng-click="addMenu()" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> 添加</button>
                            <button id="delete_btn" ng-click="del_action()" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 批量删除</button>
                        </div>
                        <table id="adminMenu-table" data-toolbar=".action-toolbar" data-toggle="table" data-show-columns="true" data-autoheight="130" data-show-export="true"
                            data-pagination="true" data-filter-control="true" data-checkbox="true" data-show-export="true"
                            data-id-field="id" data-unique-id="id" data-custom-url="index.php?r=admin-menu/table" class="table table-hover th-table">
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

    <div class="modal bootstrap-dialog type-primary modal-box fade" id="edit_dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title bootstrap-dialog-title">子菜单管理</h5>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "admin-menu-form", "class"=>"form-horizontal", "action"=>Url::toRoute('admin-menu/save')]); ?> 
                    <input type="text" class="form-control hide" ng-model="modal.id" id="id" name="AdminMenu[id]" />
                    <input type="text" class="form-control hide"  id="module_id" name="AdminMenu[module_id]" value="<?=$module_id?>"> 
                    <div id="code_div" class="form-group">
                        <label for="code" class="col-sm-2 control-label">编码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.code" id="code" name="AdminMenu[code]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="menu_name_div" class="form-group">
                        <label for="menu_name" class="col-sm-2 control-label">名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.menu_name" id="menu_name" name="AdminMenu[menu_name]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="des_div" class="form-group">
                        <label for="des" class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.des" id="des" name="AdminMenu[des]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="display_order_div" class="form-group">
                        <label for="display_order" class="col-sm-2 control-label">显示顺序</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.display_order" id="display_order" name="AdminMenu[display_order]" placeholder="" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="entry_url_div" class="form-group hide">
                        <label for="entry_url" class="col-sm-2 control-label">入口地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="modal.entry_url" id="entry_url" name="AdminMenu[entry_url]" placeholder="必填" />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="controller_div" class="form-group">
                        <label for="controller" class="col-sm-2 control-label">控制器</label>
                        <div class="col-sm-10">
                            <select class="form-control" ng-model="modal.controller" name="AdminMenu[controller]" id="controller">
                               <option ng-repeat="item in controllerData" value="{{item}}">{{item}}</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            
                    <div id="action_div" class="form-group">
                        <label for="action" class="col-sm-2 control-label">操作</label>
                        <div class="col-sm-10">
                            <select class="form-control" ng-model="modal.action" name="AdminMenu[action]" id="action">
                                <option ng-repeat="item in selectData" value="{{item.value}}">{{item.label}}</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php ActiveForm::end(); ?>          
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
<?php include '/js/menu.php';?>
<?php $this->endBlock(); ?>