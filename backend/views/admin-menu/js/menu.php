<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 window.controllerData = <?php echo json_encode($controllerData); ?>;
 function searchAction(){
		$('#admin-menu-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#code").val('');
		$("#menu_name").val('');
// 		$("#module_id").val('');
// 		$("#display_label").val('');
		$("#des").val('');
		$("#display_order").val('');
// 		$("#entry_right_name").val('');
		$("#entry_url").val('');
		$("#action").val('');
		$("#controller").val('');
		$("#has_lef").val('');
		$("#create_user").val('');
		$("#create_date").val('');
		$("#update_user").val('');
		$("#update_date").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#code").val(data.code);
    	$("#menu_name").val(data.menu_name);
    	$("#module_id").val(data.module_id);
//     	$("#display_label").val(data.display_label);
    	$("#des").val(data.des);
    	$("#display_order").val(data.display_order);
//     	$("#entry_right_name").val(data.entry_right_name);
    	$("#entry_url").val(data.entry_url);
    	$("#action").val(data.action);
    	$("#controller").val(data.controller);
    	$("#has_lef").val(data.has_lef);
    	$("#create_user").val(data.create_user);
    	$("#create_date").val(data.create_date);
    	$("#update_user").val(data.update_user);
    	$("#update_date").val(data.update_date);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#code").attr({readonly:true,disabled:true});
      $("#menu_name").attr({readonly:true,disabled:true});
      $("#module_id").attr({readonly:true,disabled:true});
//       $("#display_label").attr({readonly:true,disabled:true});
      $("#des").attr({readonly:true,disabled:true});
      $("#display_order").attr({readonly:true,disabled:true});
//       $("#entry_right_name").attr({readonly:true,disabled:true});
      $("#entry_url").attr({readonly:true,disabled:true});
      $("#action").attr({readonly:true,disabled:true});
      $("#controller").attr({readonly:true,disabled:true});
      $("#has_lef").attr({readonly:true,disabled:true});
      $("#has_lef").parent().parent().show();
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
      $("#menu_name").attr({readonly:false,disabled:false});
      $("#module_id").attr({readonly:false,disabled:false});
//       $("#display_label").attr({readonly:false,disabled:false});
      $("#des").attr({readonly:false,disabled:false});
      $("#display_order").attr({readonly:false,disabled:false});
//       $("#entry_right_name").attr({readonly:false,disabled:false});
      $("#entry_url").attr({readonly:true,disabled:true});
//       $("#entry_url").attr({readonly:false,disabled:false});
      $("#action").attr({readonly:false,disabled:false});
      $("#controller").attr({readonly:false,disabled:false});
      $("#has_lef").attr({readonly:false,disabled:false});
      $("#has_lef").parent().parent().hide();
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
		   url: "<?=Url::toRoute('admin-menu/view')?>",
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

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		ids = getCheckId($('#adminMenu-table').bootstrapTable('getSelections'));
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('admin-menu/delete')?>",
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
					  $('#adminMenu-table').bootstrapTable('refresh');
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
	$('#admin-menu-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-menu-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-menu/create')?>" : "<?=Url::toRoute('admin-menu/update')?>";
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
        		$('#adminMenu-table').bootstrapTable('refresh');
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
$("#controller").change(function(){
    // 先清空第二个
	var controller = $(this).val();
     $("#action").empty();
     var option = $("<option>").html("请选择");
	 $("#action").append(option);
     var actions = window.controllerData[controller];
     var nodes = actions.nodes;
     for(i = 0; i < nodes.length; i++){
         var action = nodes[i];
         var option = $("<option>").val(action.a).html(action.text);
         $("#action").append(option);
     }
});

function  operateFormatter(value, row, index) {
	  var h = "";
	  var action = "<?=Url::toRoute('admin-right/index')?>"+'&id='+row.id;
	  h +='<a id="view_btn" class="action-a-btn" href="'+action+'">路由管理</a>';
      h +='<a id="view_btn" onclick="viewAction('+ row.id +')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
      h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
	  h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}
 
</script>