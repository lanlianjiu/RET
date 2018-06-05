<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	// function searchAction(){
	// 		$('#admin-module-search-form').submit();
	// }
	// function viewAction(id){
	// 		initModel(id, 'view', 'fun');
	// }

	// function initEditSystemModule(data, type){
	// 	if(type == 'create'){
	// 		$("#id").val('');
	// 		$("#code").val('');
	// 		$("#display_label").val('');
	// 		$("#meun_icon").val('');
	// 		$("#has_lef").val('');
	// 		$("#des").val('');
	// 		$("#entry_url").val('');
	// 		$("#display_order").val('');
	// 		$("#create_user").val('');
	// 		$("#create_date").val('');
	// 		$("#update_user").val('');
	// 		$("#update_date").val('');
			
	// 	}
	// 	else{
	// 		$("#id").val(data.id);
	// 		$("#code").val(data.code);
	// 		$("#display_label").val(data.display_label);
	// 		$("#meun_icon").val(data.meun_icon);
	// 		$("#has_lef").val(data.has_lef);
	// 		$("#des").val(data.des);
	// 		$("#entry_url").val(data.entry_url);
	// 		$("#display_order").val(data.display_order);
	// 		$("#create_user").val(data.create_user);
	// 		$("#create_date").val(data.create_date);
	// 		$("#update_user").val(data.update_user);
	// 		$("#update_date").val(data.update_date);
	// 		}
	// 	if(type == "view"){
	// 	$("#id").attr({readonly:true,disabled:true});
	// 	$("#code").attr({readonly:true,disabled:true});
	// 	$("#display_label").attr({readonly:true,disabled:true});
	// 	$("#meun_icon").attr({readonly:true,disabled:true});
	// 	$("#has_lef").attr({readonly:true,disabled:true});
	// 	$("#des").attr({readonly:true,disabled:true});
	// 	$("#entry_url").attr({readonly:true,disabled:true});
	// 	$("#display_order").attr({readonly:true,disabled:true});
	// 	$("#create_user").attr({readonly:true,disabled:true});
	// 	$("#create_user").parent().parent().show();
	// 	$("#create_date").attr({readonly:true,disabled:true});
	// 	$("#create_date").parent().parent().show();
	// 	$("#update_user").attr({readonly:true,disabled:true});
	// 	$("#update_user").parent().parent().show();
	// 	$("#update_date").attr({readonly:true,disabled:true});
	// 	$("#update_date").parent().parent().show();
	// 	$('#edit_dialog_ok').addClass('hidden');
	// 	}
	// 	else{
	// 	$("#id").attr({readonly:false,disabled:false});
	// 	$("#code").attr({readonly:false,disabled:false});
	// 	$("#display_label").attr({readonly:false,disabled:false});
	// 	$("#meun_icon").attr({readonly:false,disabled:false});
	// 	$("#has_lef").attr({readonly:false,disabled:false});
	// 	$("#des").attr({readonly:false,disabled:false});
	// 	$("#entry_url").attr({readonly:false,disabled:false});
	// 	$("#display_order").attr({readonly:false,disabled:false});
	// 	$("#create_user").attr({readonly:false,disabled:false});
	// 	$("#create_user").parent().parent().hide();
	// 	$("#create_date").attr({readonly:false,disabled:false});
	// 	$("#create_date").parent().parent().hide();
	// 	$("#update_user").attr({readonly:false,disabled:false});
	// 	$("#update_user").parent().parent().hide();
	// 	$("#update_date").attr({readonly:false,disabled:false});
	// 	$("#update_date").parent().parent().hide();
	// 		$('#edit_dialog_ok').removeClass('hidden');
	// 		}
	// 		$('#edit_dialog').modal('show');
	// }

	// function initModel(id, type, fun){
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "<?=Url::toRoute('admin-module/view')?>",
	// 		data: {"id":id},
	// 		cache: false,
	// 		dataType:"json",
	// 		error: function (xmlHttpRequest, textStatus, errorThrown) {
	// 				alert("出错了，" + textStatus);
	// 			},
	// 		success: function(data){
	// 			initEditSystemModule(data, type);
	// 		}
	// 		});
	// }
		
	// function editAction(id){
	// 	initModel(id, 'edit');
	// }

	// //获取选中id
	// function getCheckId(data) {

	// 	var arrayId = [];
	// 	for (var i in data) {
	// 		arrayId.push(data[i].web_nav_id);
	// 	}
	// 	return arrayId;
	// };

	// function deleteAction(id){

	// 	var ids = [];
	// 	if(!!id == true){
	// 		ids[0] = id;
	// 	}else{
	// 	ids = getCheckId($('#adminModule-table').bootstrapTable('getSelections'));
	// 	};

	// 	if(ids.length == 0){
	// 		$.dialog.Warn("请选择删除数据!");
	// 		return;
	// 	};

	// 	$.dialog.Confirm('确认删除选中的记录吗?', function (result) {

	// 		if(result){
	// 			$.ajax({
	// 				type: "GET",
	// 				url: "<?=Url::toRoute('admin-module/delete')?>",
	// 				data: {"ids":ids},
	// 				cache: false,
	// 				dataType:"json",
	// 				error: function (xmlHttpRequest, textStatus, errorThrown) {
	// 						alert("出错了，" + textStatus);
	// 					},
	// 				success: function(data){
	// 					for(i = 0; i < ids.length; i++){
	// 						$('#rowid_' + ids[i]).remove();
	// 					}
	// 						$.dialog.Success('成功!');
	// 					$('#adminModule-table').bootstrapTable('refresh');
	// 				}
	// 			});
	// 		}
	// 	});
	// }

	// $('#edit_dialog_ok').click(function (e) {
	// 	e.preventDefault();
	// 	$('#admin-module-form').submit();
	// });

	// $('#create_btn').click(function (e) {
	// 	e.preventDefault();
	// 	initEditSystemModule({}, 'create');
	// });

	// $('#delete_btn').click(function (e) {
	// 	e.preventDefault();
	// 	deleteAction('');
	// });

	// $('#admin-module-form').bind('submit', function(e) {
	// 	e.preventDefault();
	// 	var id = $("#id").val();
	// 	var action = id == "" ? "<?=Url::toRoute('admin-module/create')?>" : "<?=Url::toRoute('admin-module/update')?>";
	// 	$(this).ajaxSubmit({
	// 		type: "post",
	// 		dataType:"json",
	// 		url: action,
	// 		data:{id:id},
	// 		success: function(value) 
	// 		{
	// 			if(value.errno == 0){
	// 				$('#edit_dialog').modal('hide');
	// 				admin_tool.alert('msg_info', '添加成功', 'success');
	// 				$('#adminModule-table').bootstrapTable('refresh');
	// 			}
	// 			else{
	// 				var json = value.data;
	// 				for(var key in json){
	// 					$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
						
	// 				}
	// 			}

	// 		}
	// 	});
	// });

	var app = angular.module("myApp", []);
	app.controller("admin-module-controller", function($scope) {

		$scope.modal = {};
		var tableId = $('#adminModule-table');

		$scope.addModule = function() {
			$scope.modal = {};
			$('#edit_dialog').modal('show');
		};

		$scope.edit_action = function(id) {
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.modal = tableData;
			$scope.$apply();
			$('#edit_dialog').modal('show');
		};

		$scope.saveModule = function() {
			var id = $("#id").val();
		    var action = id == "" ? "<?=Url::toRoute('admin-module/create')?>" : "<?=Url::toRoute('admin-module/update')?>";
			$("#admin-module-form").ajaxSubmit({
				type: "post",
				dataType:"json",
				url: action,
				data:{id:id},
				success: function(value) 
				{
					if(value.errno == 0){
						$('#edit_dialog').modal('hide');
							$.dialog.Success('操作成功！', function () {
							tableId.bootstrapTable('refresh');
						});
					}else{
						$.dialog.Warn(value);
					}
				}
			});
		};

		$scope.getCheckId = function (data) {
			
			var arrayId = [];
			for (var i in data) {
				arrayId.push(data[i].id);
			}
			return arrayId;
		};

		$scope.del_action = function(id) {
			
				var ids = [];
			if(!!id == true){
				ids[0] = id;
			}else{
				ids = $scope.getCheckId(tableId.bootstrapTable('getSelections'));
			};
			if(ids.length == 0){
				$.dialog.Warn("请选择删除数据!");
				return;
			};

			$.dialog.Confirm('确认删除选中的记录吗?', function (result) {

				if(result){
					$.ajax({
						type: "GET",
						url: "<?=Url::toRoute('admin-module/delete')?>",
						data: {"ids":ids},
						cache: false,
						dataType:"json",
						error: function (xmlHttpRequest, textStatus, errorThrown) {
								alert("出错了，" + textStatus);
							},
						success: function(data){
							
							$.dialog.Success('成功!');
							$('#adminModule-table').bootstrapTable('refresh');
						}
					});
				}
			});
		};

	});

	function  operateFormatter(value, row, index) {
		var h = "";
		var action = "<?=Url::toRoute('admin-menu/index')?>"+'&mid='+row.id;
		h +='<a id="view_btn" class="action-a-btn" href="'+action+'">二级菜单</a>';
		// h +='<a id="view_btn" onclick="viewAction('+ row.id +')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
		h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
		h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
		return h;
	};

	function editAction(id) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.edit_action(id);
	};

	function deleteAction(id) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.del_action(id);
	};

</script>