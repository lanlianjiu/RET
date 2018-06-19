<?php
use yii\helpers\Url;
 define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
 include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	var app = angular.module("myApp", []);
	app.controller("admin-goodscategory-controller", function($scope) {
        
        $scope.modal = {};
        $scope.data = {};
        var tableId = $('#goodsbrand-table');
        var dialog_add_edit = $('#edit_dialog');
        var dialog_brand = $('#brand_dialog');
      
        var zTreeObj;
        var setting = {
            view: {
                addHoverDom: addHoverDom,
                removeHoverDom: removeHoverDom,
                selectedMulti: false
            },
            edit: {
                enable: true,
                editNameSelectAll: false,
                showRemoveBtn: showRemoveBtn,
                showRenameBtn: showRenameBtn,
                removeTitle: "删除分类",
                renameTitle: "编辑分类"
            },
            data: {
                key: {
                    name: "name"
                },
                simpleData: {
                    enable: true,
                    idKey: "Id",
                    pIdKey: "pId",
                    rootPId: 0
                }
            },
            callback: {
                beforeRemove: delCategory,
                beforeEditName: editCategory,
                onClick: selectCategory
            }
        };

         //加载树图
        $scope.reloadTree = function() {

            $.ajax({
                type: "GET",
                url: "<?=Url::toRoute('goods-category/tree')?>",
                cache: false,
                dataType:"json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                success: function(data){
                    
                    zTreeObj = $.fn.zTree.init($("#category-tree"), setting, data);

                        zTreeObj.expandAll(false);

                        //修改时刷新树图
                        if ($scope.categoryId) {
                            var treeObj = $.fn.zTree.getZTreeObj("category-tree");
                            var nodes = treeObj.getNodes();
                            if (nodes.length > 0) {
                                var node = treeObj.getNodeByParam('Id', $scope.categoryId);

                                treeObj.selectNode(node)
                                treeObj.setting.callback.onClick(null, treeObj.setting.treeId, node);
                                treeObj.expandAll(true);
                            };
                        };
                        //新增时刷新树图
                        if ($scope.newId) {
                            var treeObj = $.fn.zTree.getZTreeObj("category-tree");
                            var nodes = treeObj.getNodes();
                            if (nodes.length > 0) {
                                var node = treeObj.getNodeByParam('Id', $scope.newId);
                                treeObj.selectNode(node);
                                treeObj.setting.callback.onClick(null, treeObj.setting.treeId, node);
                                treeObj.expandAll(true);
                            };
                        };
                        //初始化树图、删除时
                        if (!$scope.categoryId && !$scope.newId) {
                            
                            var treeObj = $.fn.zTree.getZTreeObj("category-tree");
                            var nodes = treeObj.getNodes()
                            if (nodes.length > 0) {
                                
                                var node = treeObj.getNodeByParam('Id', nodes[0].Id);
                                treeObj.selectNode(node);
                                treeObj.setting.callback.onClick(null, treeObj.setting.treeId, node);
                                treeObj.expandAll(true);

                            };
                        };

                    }

            });
        };

        $scope.serachTable = function(params) {

             $('#categoryToBrand-table').bootstrapTable('refresh', {
                url:"index.php?r=goods-category/category-to-brand",
                query: {
                    category_id:params || 1
                }
            });
        };

        function selectCategory(event, treeId, treeNode) {
           
           $scope.serachTable(treeNode.Id);

            $scope.categoryId = treeNode.Id;

            $scope.$apply();
        };

        $scope.saveAction = function() {

            var URL = ($scope.modal.category_id) ? "<?=Url::toRoute('goods-category/update-category')?>" : "<?=Url::toRoute('goods-category/create-category')?>";
            var data = {};
            if($scope.modal.category_id){
                data = {
                            category_id:$scope.modal.category_id,
                            'ShpGoodsCategory[category_name]':$scope.modal.category_name,
                            'ShpGoodsCategory[is_used]':$scope.modal.is_used
                    }
            }else{

                data = {
                        'ShpGoodsCategory[category_p_id]':$scope.data.category_p_id,
                        'ShpGoodsCategory[category_name]':$scope.modal.category_name,
                        'ShpGoodsCategory[is_used]':$scope.modal.is_used
                    }
            };

			$.ajax({
				type: "post",
				dataType:"json",
				url: URL,
				data:data,
				success: function(value) 
				{
					if(value.errno == 0){
						dialog_add_edit.modal('hide');
                        $scope.categoryId = $scope.modal.category_id;
                        $scope.newId = value.pk_id || "";
                        $scope.reloadTree();
						$.dialog.Success('操作成功！');
                        $scope.$apply();
					}else{
						$.dialog.Warn(value.msg);
					}
				}
			});
           
        };
       
        //品牌
        $scope.addBrand = function() {

            $scope.modal = {};
           
            $.ajax({
                type: "GET",
                url: "<?=Url::toRoute('goods-category/category-cbrand')?>",
                cache: false,
                data:{category_id:$scope.categoryId},
                dataType:"json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                success: function(data){
                    $("#c_brand").select2({
							placeholder: "--请选择--",
							data:data
						});
                    dialog_brand.modal('show');
                }

            });
			
        };

        $scope.saveCbrand = function() {
            
            $.ajax({
				type: "post",
				dataType:"json",
				url: "<?=Url::toRoute('goods-category/create-c2b')?>",
				data:{
					'ShpCategory2brand[brand_id]':Number($("#c_brand").select2().val()),
					'ShpCategory2brand[category_id]':Number($scope.categoryId)
				},
				success: function(value) 
				{
					if(value.errno == 0){

						dialog_brand.modal('hide');

						$.dialog.Success('操作成功！', function () {
							$scope.serachTable($scope.categoryId);
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
				arrayId.push(data[i].category2brand_id);
			}
			return arrayId;
		};

        $scope.del_brand = function(id) {

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
						url: "<?=Url::toRoute('goods-category/delete-c2b')?>",
						data: {"ids":ids},
						cache: false,
						dataType:"json",
						error: function (xmlHttpRequest, textStatus, errorThrown) {
								alert("出错了，" + textStatus);
							},
						success: function(data){
							
							$.dialog.Success('成功!');
							$scope.serachTable();
						}
					});
				}
			});
            
        };

        $scope.reloadTree();
    });

	function  operateFormatter(value, row, index) {
		var h = "";
		h +='<a id="delete_btn" onclick="deleteAction('+ row.category2brand_id +')" class="action-a-btn"> <i class="fa fa-trash icon-white"></i></a>';
		return h;
	};

	function deleteAction(id) {
		var $scope = angular.element('[data-content-box="body"]').scope();
		$scope.del_brand(id);
    };

    //分类
    function editCategory(treeId, treeNode) {

        var $scope = angular.element('[data-content-box="body"]').scope();
        $scope.modal.category_id = treeNode.Id;
        $scope.modal.category_name = treeNode.categoryName;
        $scope.modal.is_used = Number(treeNode.isUsed);
        $scope.$apply();
        $("#edit_dialog").modal('show');
        return false;
    };

    function delCategory(treeId, treeNode) {

        var $scope = angular.element('[data-content-box="body"]').scope();

        $.dialog.Confirm('确认删除【' + treeNode.categoryName + '】分类吗?', function(result) {
          
            if (result) {

                var ids = [];
                    ids[0] = Number(treeNode.Id);
                	$.ajax({
                        type: "GET",
                        dataType:"json",
                        url: "<?=Url::toRoute('goods-category/delete-category')?>",
                        data:{"ids":ids},
                        success: function(value) 
                        {
                            if(value.errno == 0){

                                $('#edit_dialog').modal('hide');
                                $scope.categoryId = null;
                                $scope.newId = null;
                                $scope.reloadTree();
                                $.dialog.Success('操作成功！');
                            }else{

                                $.dialog.Warn(value.msg);
                            }
                        }
			        });

            } else {
                return result;
            };
        });
        return false;
    };
    
   
    function addHoverDom(treeId, treeNode) {

        var $scope = angular.element('[data-content-box="body"]').scope();
        var sObj = $("#" + treeNode.tId + "_span");
        if (treeNode.editNameFlag || $("#addBtn_" + treeNode.tId).length > 0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId +
            "' title='新增商品分类''></span>";
        sObj.after(addStr);
        var btn = $("#addBtn_" + treeNode.tId);
        if (btn) btn.bind("click", function() {
            var $scope = angular.element('[data-content-box="body"]').scope();
            $("#edit_dialog").modal('show');
            $scope.data = {};
            $scope.modal = {};
            $scope.data.category_p_id = treeNode.Id;
            $scope.modal.is_used = 1;
            return false;
        });
    };

    // 控制树图删除按钮
    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_" + treeNode.tId).unbind().remove();
    };
    
    function showRemoveBtn(treeId, treeNode) {
       
        if (treeNode.children) {
            return false;
        } else {
            return true;
        };

    };

    function showRenameBtn(treeId, treeNode) {
        if (treeNode.Id == 1) {
            return false;
        } else {
            return true;
        };
    };

</script>