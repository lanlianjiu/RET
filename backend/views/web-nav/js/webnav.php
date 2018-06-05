<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
	window.controllerData = <?php echo json_encode($controllerData); ?>;

	var app = angular.module("myApp", []);
	app.controller("web-nav-controller", function($scope) {

		$scope.modal = {};
		var tableId = $('#webnav-table');

		$scope.addAction = function() {
			$scope.modal = {};
			$('#edit_dialog').modal('show');
		};

		$scope.edit_action = function(id) {
			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
			$scope.modal = tableData;
			$scope.$apply();
			$('#edit_dialog').modal('show');
		};

		$scope.saveAction = function() {
			var id = $("#web_nav_id").val();
			var action = (id == "") ? "<?=Url::toRoute('web-nav/create')?>" : "<?=Url::toRoute('web-nav/update')?>";
			$("#web-nav-form").ajaxSubmit({
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

	$("#controller_id").change(function(){
		// 先清空第二个
		var controller = $(this).val();
		$("#actionUrl").empty();
		var option = $("<option>").html("请选择");
		$("#actionUrl").append(option);
		var actions = window.controllerData[controller];
		var nodes = actions.nodes;
		
		if(nodes !== undefined){
			for(i = 0; i < nodes.length; i++){
				var action = nodes[i];
				var option = $("<option>").val(action.a).html(action.text);
				$("#actionUrl").append(option);
			}
		}else{
			$("#actionUrl").append(option);
		};
		
	});

	function  operateFormatter(value, row, index) {
		var h = "";
			h +='<a id="view_btn" onclick="viewAction(' + row.web_nav_id + ')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
			h +='<a id="edit_btn" onclick="editAction(' +row.web_nav_id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
			h +='<a id="delete_btn" onclick="deleteAction('+row.web_nav_id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
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