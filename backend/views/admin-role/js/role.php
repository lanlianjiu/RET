
<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 // 分配权限
 $(function(){
	// 树节点 http://www.htmleaf.com/jQuery/Menu-Navigation/201502141379.html
	$('#user_btn').click(function(){
		$('#tree_dialog').modal('show');
	});

	$('#right_btn').click(function(){
		
	});
});
function changeCheckState(node, checked){
	if(!!node.nodes == true){
		var nodes = node.nodes;
		for(var i = 0; i < nodes.length; i++){
			var node1 = nodes[i];
			if(checked == true){
				$('#treeview').treeview('checkNode', [ node1.nodeId, { silent: true } ]);
			}
			else{
				$('#treeview').treeview('uncheckNode', [ node1.nodeId, { silent: true } ]);
			}
			changeCheckState(node1, checked);
		}
	}
}

function rightAction(roleId){
	$('#select_role_id').val(roleId);
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-role/get-all-rights')?>",
		   data: {'roleId':roleId},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
				$('#treeview').treeview({
					data:data,
					showIcon: false,
			        showCheckbox: true,
			        onNodeChecked: function(event, node) {
			          //console.log('======',node);
			          changeCheckState(node, true);
			        },
			        onNodeUnchecked: function (event, node) {
			        	changeCheckState(node, false);
			        }
					});
		   }
		});
	$('#tree_dialog').modal('show');
}

$('#right_dialog_ok').click(function(){
	var role_id = $('#select_role_id').val();
	var checkNodes = $('#treeview').treeview('getChecked');
	if(checkNodes.length > 0){
		var rids = [];
		for(i = 0; i < checkNodes.length; i++){
			var node = checkNodes[i];
			if(node.type == 'r'){
				rids.push(node.rid);
			}
		}
		$.ajax({
			   type: "GET",
			   url: "<?=Url::toRoute('admin-role/save-rights')?>",
			   data: {"rids":rids, 'roleId':role_id},
			   cache: false,
			   dataType:"json",
			   error: function (xmlHttpRequest, textStatus, errorThrown) {
				    alert("出错了，" + textStatus);
				},
			   success: function(data){
				   if(data.errno == 0){
					   admin_tool.alert('msg_info', '保存成功', 'success');
				   }
				   else{
					   admin_tool.alert('msg_info', '保存失败', 'error');
				   }
				   $('#tree_dialog').modal('hide');
//	 			   console.log(msg);
				   //initEditSystemModule(data, type);
			   }
			});
// 		console.log('====',rids);
	}
});
//分配权限

 function searchAction(){
		$('#admin-role-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#code").val('');
		$("#name").val('');
		$("#des").val('');
		$("#create_user").val('');
		$("#create_date").val('');
		$("#update_user").val('');
		$("#update_date").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#code").val(data.code);
    	$("#name").val(data.name);
    	$("#des").val(data.des);
    	$("#create_user").val(data.create_user);
    	$("#create_date").val(data.create_date);
    	$("#update_user").val(data.update_user);
    	$("#update_date").val(data.update_date);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#code").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#des").attr({readonly:true,disabled:true});
      $("#create_user").attr({readonly:true,disabled:true});
      $("#create_user").parent().parent().show();
      $("#create_date").attr({readonly:true,disabled:true});
      $("#create_date").parent().parent().show();
      $("#update_user").attr({readonly:true,disabled:true});
      $("#update_user").parent().parent().show();
      $("#update_date").attr({readonly:true,disabled:true});
      $("#update_date").parent().parent().show();
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#code").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#des").attr({readonly:false,disabled:false});
      $("#create_user").attr({readonly:false,disabled:false});
      $("#create_user").parent().parent().hide();
      $("#create_date").attr({readonly:false,disabled:false});
      $("#create_date").parent().parent().hide();
      $("#update_user").attr({readonly:false,disabled:false});
      $("#update_user").parent().parent().hide();
      $("#update_date").attr({readonly:false,disabled:false});
      $("#update_date").parent().parent().hide();
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-role/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

//获取选中id
function getCheckId(data) {

	var arrayId = [];
	for (var i in data) {
		arrayId.push(data[i].web_nav_id);
	}
	return arrayId;
};

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		ids = getCheckId($('#adminRole-table').bootstrapTable('getSelections'));
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('admin-role/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    alert("出错了，" + textStatus);
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   $('#adminRole-table').bootstrapTable('refresh');
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}


$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#admin-role-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-role-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = (id == "") ? "<?=Url::toRoute('admin-role/create')?>" : "<?=Url::toRoute('admin-role/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	data:{id:id},
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		 $('#adminRole-table').bootstrapTable('refresh');
        	}
        	else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

function  operateFormatter(value, row, index) {
	  var h = "";
	  var action = "<?=Url::toRoute('admin-user-role/index')?>"+'&roleId='+row.id;
	  h +='<a id="view_btn" class="action-a-btn" href="'+action+'">分配用户</a>';
      h +='<a id="view_btn" onclick="rightAction('+row.id+')" class="action-a-btn" href="#">分配权限</a>';
      h +='<a id="view_btn" onclick="viewAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
	  h +='<a id="edit_btn" onclick="editAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
      h +='<a id="delete_btn" onclick="deleteAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}

 
</script>