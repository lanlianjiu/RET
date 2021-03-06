<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 	window.controllerData = <?php echo json_encode($controllerData); ?>;
	var app = angular.module("myApp", []);
	app.controller("admin-menu-controller", function($scope) {

		var moduleId = $.utils.getUrlParams('mid');

		var tableId = $('#adminMenu-table');
		var dialog_add_edit = $('#edit_dialog');
		$scope.modal = {};
		$scope.selectData = {};
		$scope.controllerData = {};

		for(var i in window.controllerData){
			$scope.controllerData[i] = i;
		};

		$("#controller").change(function(){
			// 先清空第二个
			var controller = $(this).val();
			$scope.selectFun(controller);
		});
	
		$scope.selectFun = function(controller) {
			$scope.selectData = {};
			var actions = window.controllerData[controller];
			var nodes = actions.nodes;
			if(nodes !== undefined){
				for(i = 0; i < nodes.length; i++){
					var action = nodes[i];
					$scope.selectData[i] = {
						label:action.text,
						value:action.a
					}
				}
			};
		};

		$scope.addMenu = function() {
			$scope.modal = {};
			dialog_add_edit.modal('show');
		};

		$scope.edit_action = function(id) {
			
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.modal = tableData;
			$scope.selectFun(tableData.controller);
			var str = tableData.entry_url;
			var index = str.lastIndexOf("\/"); 
			str  = str.substring(index + 1, str.length);
			$scope.modal.entry_url = str;
			$scope.$apply();

			dialog_add_edit.modal('show');
		};

		$scope.saveMenu = function() {
			
			var URL = ($scope.modal.id) ? "<?=Url::toRoute('admin-menu/update')?>" : "<?=Url::toRoute('admin-menu/create')?>";
			
			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:{
					id:$scope.modal.id,
					'AdminMenu[id]':$scope.modal.id,
					'AdminMenu[module_id]':moduleId,
					'AdminMenu[code]':$scope.modal.code,
					'AdminMenu[menu_name]':$scope.modal.menu_name,
					'AdminMenu[entry_url]':$scope.modal.entry_url,
					'AdminMenu[display_order]':$scope.modal.display_order,
					'AdminMenu[controller]':$scope.modal.controller,
					'AdminMenu[action]':$scope.modal.action,
					'AdminMenu[des]':$scope.modal.des
				},
				success: function(value) 
				{
					if(value.errno == 0){
						dialog_add_edit.modal('hide');

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
						url: "<?=Url::toRoute('admin-menu/delete')?>",
						data: {"ids":ids},
						cache: false,
						dataType:"json",
						error: function (xmlHttpRequest, textStatus, errorThrown) {
								alert("出错了，" + textStatus);
							},
						success: function(data){
							
							$.dialog.Success('成功!');
							tableId.bootstrapTable('refresh');
						}
					});
				}
			});
		};

	});


	function  operateFormatter(value, row, index) {
		var h = "";
		var action = "<?=Url::toRoute('admin-right/index')?>"+'&id='+row.id;
		h +='<a id="view_btn" class="action-a-btn" href="'+action+'">路由管理</a>';
		h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn"> <i class="fa fa-edit icon-white"></i></a>';
		h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn"> <i class="fa fa-trash icon-white"></i></a>';
		return h;
	}

	function editAction(id) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.edit_action(id);
	};

	function deleteAction(id) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.del_action(id);
	};
 
</script>