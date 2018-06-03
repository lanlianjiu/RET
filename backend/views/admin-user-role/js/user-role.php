<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 function searchAction(){
		$('#admin-user-role-search-form').submit();
	}
 function viewAction(id){
	//initModel(id, 'view', 'fun');
	var editData = $('#adminUserrole-table').bootstrapTable('getRowByUniqueId', id);
	initEditSystemModule(editData, 'view');
}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#user_id").val('');
		$("#user_name").val('');
// 		$("#role_id").val('');
		$("#create_user").val('');
		$("#create_date").val('');
		$("#update_user").val('');
		$("#update_date").val('');
		
	}else{
		$("#id").val(data.id);
		$("#user_id").val(data.user_id);
		$("#user_name").val(data.user_name);
    	$("#role_id").val(data.role_id);
    	$("#create_user").val(data.create_user);
    	$("#create_date").val(data.create_date);
    	$("#update_user").val(data.update_user);
    	$("#update_date").val(data.update_date);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
	  $("#user_id").attr({readonly:true,disabled:true});
	  $("#user_name").attr({readonly:true,disabled:true});
//       $("#role_id").attr({readonly:true,disabled:true});
//       $("#role_id").parent().parent().show();
      $("#create_user").attr({readonly:true,disabled:true});
      $("#create_user").parent().parent().show();
      $("#create_date").attr({readonly:true,disabled:true});
      $("#create_date").parent().parent().show();
      $("#update_user").attr({readonly:true,disabled:true});
      $("#update_user").parent().parent().show();
      $("#update_date").attr({readonly:true,disabled:true});
      $("#update_date").parent().parent().show();
	  $('#edit_dialog_ok').addClass('hidden');

	}else{

	  $("#id").attr({readonly:false,disabled:false});
	  $("#user_id").attr({readonly:false,disabled:false});
	  $("#user_name").attr({readonly:false,disabled:false});
//       $("#role_id").attr({readonly:false,disabled:false});
//       $("#role_id").parent().parent().hide();
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
		   url: "<?=Url::toRoute('admin-user-role/view')?>",
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
	//initModel(id, 'edit');
	
	var editData = $('#adminUserrole-table').bootstrapTable('getRowByUniqueId', id);
	initEditSystemModule(editData, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
	ids = getCheckId($('#adminUserrole-table').bootstrapTable('getSelections'));
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('admin-user-role/delete')?>",
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
					  $('#adminUserrole-table').bootstrapTable('refresh');
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}

function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#admin-user-role-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-user-role-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-user-role/create')?>" : "<?=Url::toRoute('admin-user-role/update')?>";
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
        		window.location.reload();
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
	  console.log()
      h +='<a id="view_btn" onclick="viewAction('+ row.id +')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
	  h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
      h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}
</script>