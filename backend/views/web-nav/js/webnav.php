<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
	window.controllerData = <?php echo json_encode($controllerData); ?>;

	var app = angular.module("myApp", []);
	app.controller("web-nav-controller", function($scope) {

		var tableId = $('#webnav-table');
		var dialog_add_edit = $('#edit_dialog');
		$scope.modal = {};
		$scope.selectData = {};
		$scope.controllerData = {};
			
		for(var i in window.controllerData){
			$scope.controllerData[i] = i;
		};
	
		$scope.selectFun = function(controller) {
			$scope.selectData = {};
			var actions = window.controllerData[controller];
			
			if(actions !== undefined){

				var nodes = actions.nodes;

				if(nodes !== undefined){
					for(i = 0; i < nodes.length; i++){
						var action = nodes[i];
						$scope.selectData[i] = {
							label:action.text,
							value:action.a
						}
					}
				}
			};
		};

		$("#controller_id").change(function(){
			// 先清空第二个
			var controller = $(this).val();
			$scope.selectFun(controller);
		});

		$scope.addAction = function() {
			$scope.modal = {};
			dialog_add_edit.modal('show');
		};
		
		$scope.edit_action = function(id) {
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.selectFun(tableData.controller);
			$scope.modal = tableData;
			var str = tableData.url
			var index = str.lastIndexOf("\/");  
			str  = str.substring(index + 1, str.length);
			$scope.modal.url = str;
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

		$scope.saveAction = function() {
			
			var URL = ($scope.modal.web_nav_id) ? "<?=Url::toRoute('web-nav/update')?>" : "<?=Url::toRoute('web-nav/create')?>";
			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:{
					 web_nav_id:$scope.modal.web_nav_id,
					'WebNavModel[web_navType_id]':$scope.modal.web_navType_id,
					'WebNavModel[web_nav_name]':$scope.modal.web_nav_name,
					'WebNavModel[controller]':$scope.modal.controller,
					'WebNavModel[url]':$scope.modal.url
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
		};

		$scope.getCheckId = function (data) {
			
			var arrayId = [];
			for (var i in data) {
				arrayId.push(data[i].web_nav_id);
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
						url: "<?=Url::toRoute('web-nav/delete')?>",
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
			// h +='<a id="view_btn" onclick="viewAction(' + row.web_nav_id + ')" class="action-a-btn" > <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
			h +='<a id="edit_btn" onclick="editAction(' +row.web_nav_id +')" class="action-a-btn" > <i class="fa fa-edit icon-white"></i></a>';
			h +='<a id="delete_btn" onclick="deleteAction('+row.web_nav_id +')" class="action-a-btn" > <i class="fa fa-trash icon-white"></i></a>';
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