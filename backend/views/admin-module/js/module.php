<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
	
	var app = angular.module("myApp", []);
	app.controller("admin-module-controller", function($scope) {

		$scope.modal = {};
		var tableId = $('#adminModule-table');
		var dialog_add_edit = $('#edit_dialog');
		$scope.addModule = function() {
			$scope.modal = {};
			dialog_add_edit.modal('show');
		};

		$scope.edit_action = function(id) {
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.modal = tableData;
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

		$scope.saveModule = function() {

			//$("#admin-module-form").html5Validate(function() {

				var URL = ($scope.modal.id) ?  "<?=Url::toRoute('admin-module/update')?>": "<?=Url::toRoute('admin-module/create')?>";
				$.ajax({
					type: "post",
					dataType:"json",
					url: URL,
					data:{
						id:$scope.modal.id,
						'AdminModule[id]':$scope.modal.id,
						'AdminModule[code]':$scope.modal.code,
						'AdminModule[display_label]':$scope.modal.display_label,
						'AdminModule[meun_icon]':$scope.modal.meun_icon,
						'AdminModule[display_order]':$scope.modal.display_order,
						'AdminModule[des]':$scope.modal.des
					},
					success: function(value) 
					{
						if(value.errno == 0){
							dialog_add_edit.modal('hide');
							$.dialog.Success('操作成功！', function () {
								tableId.bootstrapTable('refresh');
							});
						}else{
							$.dialog.Warn(value.msg);
						}
					}
				});
				
			// }, {
			// 		novalidate: false	
			// 	});
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
							tableId.bootstrapTable('refresh');
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
		h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn"> <i class="fa fa-edit icon-white"></i></a>';
		h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn"> <i class="fa fa-trash icon-white"></i></a>';
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