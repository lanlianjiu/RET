<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	var app = angular.module("myApp", []);
	app.controller("ShpGoods-controller", function($scope) {

		var tableId = $('#goods-table');
		var dialog_add_edit = $('#edit_dialog');
        $scope.modal = {};
            
		$scope.addAction = function() {
            $scope.modal = {};
                $scope.modal.is_used = 1;
			dialog_add_edit.modal('show');
		};
		
		$scope.edit_action = function(id) {

			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
            $scope.modal = tableData;
            $scope.modal.is_used = Number(tableData.is_used);
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

		$scope.saveAction = function() {
			
			var URL = ($scope.modal.goods_id) ? "<?=Url::toRoute('goods/update')?>" : "<?=Url::toRoute('goods/create')?>";
			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:{
                    goods_id:$scope.modal.goods_id,
                    'ShpGoods[brand_icon]':$('input[up-id="brand_icon"]').val(),
					'ShpGoods[brand_name]':$scope.modal.brand_name,
					'ShpGoods[web_nav_name]':$scope.modal.web_nav_name,
					'ShpGoods[is_used]':$scope.modal.is_used
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
				arrayId.push(data[i].goods_id);
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
						url: "<?=Url::toRoute('goods/delete')?>",
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
			h +='<a id="edit_btn" onclick="editAction(' +row.goods_id +')" class="action-a-btn" > <i class="fa fa-edit icon-white"></i></a>';
			h +='<a id="delete_btn" onclick="deleteAction('+row.goods_id +')" class="action-a-btn" > <i class="fa fa-trash icon-white"></i></a>';
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