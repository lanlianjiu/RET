<?php
use yii\helpers\Url;
 define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
 include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

	var app = angular.module("myApp", []);
	app.controller("admin-goodscategory-controller", function($scope) {
        
        $scope.modal = {};
      
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
                // beforeRemove: delCategory,
                // beforeEditName: editCategory,
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
                        if ($scope.categoryPId) {
                            var treeObj = $.fn.zTree.getZTreeObj("category-tree");
                            var nodes = treeObj.getNodes();
                            if (nodes.length > 0) {
                                var node = treeObj.getNodeByParam('Id', $scope.categoryPId);

                                treeObj.selectNode(node)
                                treeObj.setting.callback.onClick(null, treeObj.setting.treeId, node);

                                // var nodeSelect = treeObj.getSelectedNodes();
                                // treeObj.expandNode(nodeSelect[0], true, true, true);
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

                                // var nodeSelect = treeObj.getSelectedNodes();
                                // treeObj.expandNode(nodeSelect[0], true, true, true);
                                treeObj.expandAll(true);
                            };
                        };
                        //初始化树图、删除时
                        if (!$scope.categoryPId && !$scope.newId) {
                            
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

        function selectCategory(event, treeId, treeNode) {

            $scope.categoryPId = treeNode.Id;

            $scope.$apply(function() {

                if (treeNode.children != undefined) {
                    $scope.butTags = false;
                } else {
                    $scope.butTags = true;

                };
            });
        };

        $scope.reloadTree();
        
    });
    

	function  operateFormatter(value, row, index) {
		var h = "";
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

    //分类
    function editCategory(treeId, treeNode) {

        var $scope = angular.element('[data-content-box="body"]').scope();

    
        return false;
    };

    function delCategory(treeId, treeNode) {

        var $scope = angular.element('[data-content-box="body"]').scope();

        $.dialog.Confirm('确认删除【' + treeNode.name + '】分类吗?', function(result) {
            var $scope = $('html').scope();
            if (result) {

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

            return false;
        });
    };

    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_" + treeNode.tId).unbind().remove();
    };

    function showRemoveBtn(treeId, treeNode) {
        if (treeNode.Id == 1) {
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