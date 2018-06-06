
<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
	var app = angular.module("myApp", []);
	app.controller("admin-role-controller", function($scope) {

		$scope.modal = {};
		var tableId = $('#adminRole-table');
		var dialog_add_edit = $('#edit_dialog');
		var treeview_dialog = $('#treeview');
		
		$scope.addAction = function() {
			$scope.modal = {};
			dialog_add_edit.modal('show');
		};

		$scope.edit_action = function(id) {
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.modal = tableData;
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

		$scope.saveAction = function() {
			var id = $("#id").val();
			var action = id == "" ? "<?=Url::toRoute('admin-role/create')?>" : "<?=Url::toRoute('admin-role/update')?>";
			$("#admin-role-form").ajaxSubmit({
				type: "post",
				dataType:"json",
				url: action,
				data:{id:id},
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
						url: "<?=Url::toRoute('admin-role/delete')?>",
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

		// 分配权限
		function changeCheckState(node, checked){
			if(!!node.nodes == true){
				var nodes = node.nodes;
				for(var i = 0; i < nodes.length; i++){
					var node1 = nodes[i];
					if(checked == true){
						treeview_dialog.treeview('checkNode', [ node1.nodeId, { silent: true } ]);
					}
					else{
						treeview_dialog.treeview('uncheckNode', [ node1.nodeId, { silent: true } ]);
					}
					changeCheckState(node1, checked);
				}
			}
		};

		$scope.right_action = function(roleId) {

			$('#select_role_id').val(roleId);
			
			$.ajax({
				type: "GET",
				url: "<?=Url::toRoute('admin-role/get-all-rights')?>",
				data: {'roleId':roleId},
				cache: false,
				dataType:"json",
				error: function (xmlHttpRequest, textStatus, errorThrown) {
					alert("出错了，" + textStatus);
				},
				success: function(data){

					treeview_dialog.treeview({
						data:data,
						showIcon: false,
						showCheckbox: true,
						onNodeChecked: function(event, node) {
							changeCheckState(node, true);
						},
						onNodeUnchecked: function (event, node) {
							changeCheckState(node, false);
						}
					});
				}
			});

			$('#tree_dialog').modal('show');

		};

		$scope.saveRight = function() {
			
			var role_id = $('#select_role_id').val();
			var checkNodes = treeview_dialog.treeview('getChecked');

			if(checkNodes.length > 0){

				var rids = [];
				for(i = 0; i < checkNodes.length; i++){
					var node = checkNodes[i];
					if(node.type == 'r'){
						rids.push(node.rid);
					}
				};

				$.ajax({
					type: "GET",
					url: "<?=Url::toRoute('admin-role/save-rights')?>",
					data: {"rids":rids, 'roleId':role_id},
					cache: false,
					dataType:"json",
					error: function (xmlHttpRequest, textStatus, errorThrown) {
							alert("出错了，" + textStatus);
						},
					success: function(data){
						if(data.errno == 0){
							$('#tree_dialog').modal('hide');
						}else{
							
						}
						
					}
				});
			}

		};	

	});

	function  operateFormatter(value, row, index) {
		var h = "";
		var action = "<?=Url::toRoute('admin-user-role/index')?>"+'&roleId='+row.id;
		h +='<a id="view_btn" class="action-a-btn" href="'+action+'">分配用户</a>';
		h +='<a id="view_btn" onclick="rightAction('+row.id+')" class="action-a-btn" href="#">分配权限</a>';
		h +='<a id="edit_btn" onclick="editAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
		h +='<a id="delete_btn" onclick="deleteAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
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

	//分配权限
	function rightAction(roleId) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.right_action(roleId);
	};

</script>