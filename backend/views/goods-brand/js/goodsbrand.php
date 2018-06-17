<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	var app = angular.module("myApp", []);
	app.controller("web-goodsbrand-controller", function($scope) {

		var tableId = $('#goodsbrand-table');
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
            $scope.modal.is_used = Number(tableData.is_used)
            console.log($scope.modal);
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

		$scope.saveAction = function() {
			
			var URL = ($scope.modal.brand_id) ? "<?=Url::toRoute('goods-brand/update')?>" : "<?=Url::toRoute('goods-brand/create')?>";
			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:{
                    brand_id:$scope.modal.brand_id,
                    'ShpGoodsBrand[brand_icon]':$('input[up-id="brand_icon"]').val(),
					'ShpGoodsBrand[brand_name]':$scope.modal.brand_name,
					'ShpGoodsBrand[web_nav_name]':$scope.modal.web_nav_name,
					'ShpGoodsBrand[is_used]':$scope.modal.is_used
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
				arrayId.push(data[i].brand_id);
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
						url: "<?=Url::toRoute('goods-brand/delete')?>",
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
			h +='<a id="edit_btn" onclick="editAction(' +row.brand_id +')" class="action-a-btn" > <i class="fa fa-edit icon-white"></i></a>';
			h +='<a id="delete_btn" onclick="deleteAction('+row.brand_id +')" class="action-a-btn" > <i class="fa fa-trash icon-white"></i></a>';
		return h;
    };
    
    function  logoFormatter(value, row, index) {
		var h = "";
			h +='<img style="height:50px;width:50px;" src="'+row.brand_icon+'" />';
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