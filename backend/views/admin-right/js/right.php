<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 window.controllerData = <?php echo json_encode($controllerData); ?>;
var app = angular.module("myApp", []);
app.controller("admin-right-controller", function($scope) {

	var menuId = $.utils.getUrlParams('id');

	$scope.modal = {};
	var tableId = $('#adminRight-table');
	var dialog_add_edit = $('#edit_dialog');
	var treeview_dialog = $('#treeview');
	//配置功能url
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

	//编辑默认树图勾选
	function initModel(id, type, fun){
	
		$.ajax({
			type: "GET",
			url: "<?=Url::toRoute('admin-right/view')?>",
			data: {"id":id},
			cache: false,
			dataType:"json",
			error: function (xmlHttpRequest, textStatus, errorThrown) {
					alert("出错了，" + textStatus);
				},
			success: function(data){
				
				if(type == "view"){

						for(var i in data.actions){
							for(var j in data.actions[i]){

								for(var m in data.actions[i][j]){
									
									if(data.actions[i][j][m].state){
										data.actions[i][j][m].state.disabled = true;
									}
								}
							}
						}
				}
			
				treeview_dialog.treeview({
					data:data.actions,
					showIcon: false,
					showCheckbox: true,
					levels: 2,
					onNodeChecked: function(event, node) {
					changeCheckState(node, true);
					},
					onNodeUnchecked: function (event, node) {
						changeCheckState(node, false);
					}
				});
				treeview_dialog.treeview('collapseAll',{ silent: true });
			}
		});
	};

	//监听改变控制器
	$("#controller").change(function(){
		// 先清空第二个
		var controller = $(this).val();
		$("#action").empty();
		var option = $("<option>").html("请选择");
		$("#action").append(option);
		// 实际的应用中，这里的option一般都是用循环生成多个了
		var actions = window.controllerData[controller];
		var nodes = actions.nodes;
		var rightTree = {'text':controller, 'selectable':false, 'state':{'checked':false}, 'type':'r'};
		rightTree['nodes'] = nodes;
		
		treeview_dialog.treeview({
			data: [rightTree],
			showIcon: false,
			showCheckbox: true,
			levels: 2,
			onNodeChecked: function(event, node) {
			changeCheckState(node, true);
			},
			onNodeUnchecked: function (event, node) {
				changeCheckState(node, false);
			}
		});
		
	});

	$scope.addAction = function() {

		$scope.modal = {};

		$.ajax({
			type: "GET",
			url: "<?=Url::toRoute('admin-right/right-action')?>",
			data: {'rightId':0, 'menu_id':menuId},
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
					levels: 2,
					onNodeChecked: function(event, node) {

						changeCheckState(node, true);
					},
					onNodeUnchecked: function (event, node) {
						changeCheckState(node, false);
					}
				});
			}
		});

		dialog_add_edit.modal('show');
	};

	
	$scope.edit_action = function(id) {
		var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
		$scope.modal = tableData;
		console.log(tableData);
		initModel(id,"edit");
		$scope.$apply();
		dialog_add_edit.modal('show');
	};

	$scope.saveAction = function() {

		
		var checkNodes = treeview_dialog.treeview('getChecked');
		var rightUrls = [];
		if(checkNodes.length > 0){
			for(i = 0; i < checkNodes.length; i++){
				var node = checkNodes[i];
				if(node.type == 'a'){
					var url = {'c':node.c, 'a':node.a};
					rightUrls.push(url);
				}
			}
		};

		var action = ($scope.modal.id) ? "<?=Url::toRoute('admin-right/update')?>" : "<?=Url::toRoute('admin-right/create')?>";
		$.ajax({
			type: "post",
			dataType:"json",
			url: action,
			data:{
				id:$scope.modal.id,
				'AdminRight[menu_id]':menuId,
				'AdminRight[right_name]':$scope.modal.right_name,
				'AdminRight[display_order]':$scope.modal.display_order,
				'AdminRight[des]':$scope.modal.des,
				'SystemFunction[controller]':$scope.modal.controller,
				"rightUrls":rightUrls
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
					url: "<?=Url::toRoute('admin-right/delete')?>",
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
    //   h +='<a id="view_btn" onclick="viewAction('+ row.id +')" class="action-a-btn"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
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