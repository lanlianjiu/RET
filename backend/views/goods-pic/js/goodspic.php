<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	var app = angular.module("myApp", []);
	app.controller("goodspic-controller", function($scope) {

		var tableId = $('#goodspic-table');
        var goodsId = $.utils.getUrlParams('goods_id');
		var dialog_add_edit = $('#edit_dialog');
        $scope.modal = {};
            
		$scope.addAction = function() {
            $scope.modal = {};
            $scope.modal.is_used = 1;
             $scope.getColor();
			dialog_add_edit.modal('show');
		};
		
		$scope.edit_action = function(id) {

			var tableData = tableId.bootstrapTable('getRowByUniqueId', id);
            $scope.modal = tableData;
            $scope.modal.is_used = Number(tableData.is_used);
			$scope.$apply();
			dialog_add_edit.modal('show');
		};

          $scope.getColor = function() {
            
            $.ajax({
                type: "GET",
                url: "<?=Url::toRoute('shp-goodsextend/getcolor')?>",
                cache: false,
                dataType:"json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                success: function(data){
                     $("#c_color_id").select2({
							placeholder: "--请选择--",
							data:data
						});
                   console.log(data);
                }
            });
        };

		$scope.saveAction = function() {
			
			var URL = ($scope.modal.goods_pic_id) ? "<?=Url::toRoute('goods-pic/update')?>" : "<?=Url::toRoute('goods-pic/create')?>";
			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:{
                    goods_pic_id:$scope.modal.goods_pic_id,
                    'ShpGoodsPicModel[goods_pic_url]':$('input[up-id="goods_pic_url"]').val(),
					'ShpGoodsPicModel[goods_id]':goodsId,
					'ShpGoodsPicModel[color_id]':$("#c_color_id").select2().val(),
					'ShpGoodsPicModel[is_used]':$scope.modal.is_used
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
				arrayId.push(data[i].goods_pic_id);
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
						url: "<?=Url::toRoute('goods-pic/delete')?>",
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
			h +='<a id="edit_btn" onclick="editAction(' +row.goods_pic_id +')" class="action-a-btn" > <i class="fa fa-edit icon-white"></i></a>';
			h +='<a id="delete_btn" onclick="deleteAction('+row.goods_pic_id +')" class="action-a-btn" > <i class="fa fa-trash icon-white"></i></a>';
		return h;
    };
    
    function  logoFormatter(value, row, index) {
		var h = "";
			h +='<img style="height:50px;width:50px;" src="'+row.goods_pic_url+'" />';
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