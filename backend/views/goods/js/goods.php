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
			$("#sel_menu").select2().val();
			$("#sel_brand").select2().val();
			dialog_add_edit.modal('show');

		};
		
		$scope.edit_action = function(id) {

			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
            $scope.modal = tableData;
			console.log(tableData);
			$("#sel_menu").select2().val(tableData.category_id);
			$("#sel_brand").select2().val(tableData.brand_id);
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
                    'ShpGoods[category_id]':$("#sel_menu").select2().val(),
					'ShpGoods[brand_id]':$("#sel_brand").select2().val(),
					'ShpGoods[goods_name]':$scope.modal.goods_name,
					'ShpGoods[goods_price]':$scope.modal.goods_price,
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

		$scope.getCatgory = function() {

			$.ajax({
					type: "GET",
					url: "<?=Url::toRoute('goods/get-category')?>",
					cache: false,
					dataType:"json",
					error: function (xmlHttpRequest, textStatus, errorThrown) {
							alert("出错了，" + textStatus);
						},
					success: function(data){

						$("#sel_menu").select2({
							placeholder: "--请选择--",
							data:[
									{
										"id": "10",
										"text": "女装 /内衣",
										"children": [
											{
												"id": "1001",
												"text": "女装"
											}
										]
									},
									{
										"id": "11",
										"text": "男装 /运动户外",
										"children": [
											{
												"id": "1101",
												"text": "男装",
												// "children": [
												// 				{
												// 					"id": "110101",
												// 					"text": "男装"
												// 				}
												// 			]
											}
										]
									}
								]
						});
					}
			});
			
		
		};

		$scope.getCatgory();

		$("#sel_menu").change(function(){

			// 先清空第二个
			$("#sel_brand").select2({
				placeholder: "--请选择--",
				data:[]
			});

			var category_id = $(this).val();

			$.ajax({
					type: "GET",
					url: "<?=Url::toRoute('goods/category-to-brand')?>",
					cache: false,
					data:{'category_id':category_id},
					dataType:"json",
					error: function (xmlHttpRequest, textStatus, errorThrown) {
							alert("出错了，" + textStatus);
						},
					success: function(data){

						$("#sel_brand").select2({
							placeholder: "--请选择--",
							data:data
						});
					}
			});
			
		});
		
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