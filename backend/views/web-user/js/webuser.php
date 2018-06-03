<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

function searchAction(){
		$('#web-nav-search-form').submit();
}
function viewAction(id){
		//initModel(id, 'view', 'fun');
    var editData = $('#webuser-table').bootstrapTable('getRowByUniqueId', id);
    initEditSystemModule(editData, 'view');
}

function initEditSystemModule(data, type){
	if(type == 'create'){

		$("#id").val('');
		$("#username").val('');
		$("#email").val('');
		$("#vip_1v").val('');
		$("#created_at").val('');
        $("#updated_at").val('');
		
	}else{

		$("#id").val(data.id);
    	$("#username").val(data.username);
    	$("#email").val(data.email);
		$("#vip_1v").val(data.vip_1v);
		$("#created_at").val(data.created_at);
        $("#updated_at").val(data.updated_at);
    }

	if(type == "view"){

      $("#id").attr({readonly:true,disabled:true});
      $("#username").attr({readonly:true,disabled:true});
      $("#email").attr({readonly:true,disabled:true});
	  $("#vip_1v").attr({readonly:true,disabled:true});
	  $("#created_at").attr({readonly:true,disabled:true});
      $("#updated_at").attr({readonly:true,disabled:true});
	  $('#edit_dialog_ok').addClass('hidden');
	}else{

      $("#id").attr({readonly:false,disabled:false});
      $("#username").attr({readonly:false,disabled:false});
      $("#email").attr({readonly:false,disabled:false});
	  $("#vip_1v").attr({readonly:false,disabled:false});
	  $("#created_at").attr({readonly:false,disabled:false});
      $("#updated_at").attr({readonly:false,disabled:false});
	  $('#edit_dialog_ok').removeClass('hidden');
	}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		type: "GET",
		url: "<?=Url::toRoute('web-nav/view')?>",
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
    var editData = $('#webuser-table').bootstrapTable('getRowByUniqueId', id);
    initEditSystemModule(editData, 'edit');
}

//获取选中id
function getCheckId(data) {

	var arrayId = [];
	for (var i in data) {
		arrayId.push(data[i].id);
	}
	return arrayId;
};

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}else{
		ids = getCheckId($('#webuser-table').bootstrapTable('getSelections'));
	}
	
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
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
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					  $('#webuser-table').bootstrapTable('refresh');
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
	$('#web-user-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#web-user-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('web-user/create')?>" : "<?=Url::toRoute('web-user/update')?>";
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
        		 $('#webuser-table').bootstrapTable('refresh');
        	}else{
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
	    h +='<a id="view_btn" onclick="viewAction(' + row.id + ')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
	    h +='<a id="edit_btn" onclick="editAction(' +row.id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
	    h +='<a id="delete_btn" onclick="deleteAction('+row.id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}
 
</script>