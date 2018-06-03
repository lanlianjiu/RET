<?php
use yii\helpers\Url;
  define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
  include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
window.controllerData = <?php echo json_encode($controllerData); ?>;
function searchAction(){
		$('#web-nav-search-form').submit();
}
function viewAction(id){
		initModel(id, 'view', 'fun');
}

function initEditSystemModule(data, type){
	if(type == 'create'){

		$("#web_nav_id").val('');
		$("#web_navType_id").val('');
		$("#web_nav_name").val('');
		$("#controller_id").val('');
		$("#actionUrl").val('');
		
	}else{

		$("#web_nav_id").val(data.web_nav_id);
    	$("#web_navType_id").val(data.web_navType_id);
    	$("#web_nav_name").val(data.web_nav_name);
		$("#controller_id").val(data.controller);
		$("#actionUrl").val(data.url);
    }

	if(type == "view"){

      $("#web_nav_id").attr({readonly:true,disabled:true});
      $("#web_navType_id").attr({readonly:true,disabled:true});
      $("#web_nav_name").attr({readonly:true,disabled:true});
	  $("#controller_id").attr({readonly:true,disabled:true});
	  $("#actionUrl").attr({readonly:true,disabled:true});
	  $('#edit_dialog_ok').addClass('hidden');
	}else{

      $("#web_nav_id").attr({readonly:false,disabled:false});
      $("#web_navType_id").attr({readonly:false,disabled:false});
      $("#web_nav_name").attr({readonly:false,disabled:false});
	  $("#controller_id").attr({readonly:false,disabled:false});
	  $("#actionUrl").attr({readonly:false,disabled:false});
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
	}else{
		ids = getCheckId($('#webnav-table').bootstrapTable('getSelections'));
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
					  $('#webnav-table').bootstrapTable('refresh');
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
	$('#web-nav-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#web-nav-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#web_nav_id").val();
	var action = id == "" ? "<?=Url::toRoute('web-nav/create')?>" : "<?=Url::toRoute('web-nav/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	data:{web_nav_id:id},
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		 $('#webnav-table').bootstrapTable('refresh');
        	}else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

$("#controller_id").change(function(){
    // 先清空第二个
    var controller = $(this).val();
    $("#actionUrl").empty();
    var option = $("<option>").html("请选择");
    $("#actionUrl").append(option);
    var actions = window.controllerData[controller];
	var nodes = actions.nodes;
	
	if(nodes !== undefined){
		for(i = 0; i < nodes.length; i++){
			var action = nodes[i];
			var option = $("<option>").val(action.a).html(action.text);
			$("#actionUrl").append(option);
     	}
	}else{
		$("#actionUrl").append(option);
	};
    
});

function  operateFormatter(value, row, index) {
	 var h = "";
	    h +='<a id="view_btn" onclick="viewAction(' + row.web_nav_id + ')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
	    h +='<a id="edit_btn" onclick="editAction(' +row.web_nav_id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
	    h +='<a id="delete_btn" onclick="deleteAction('+row.web_nav_id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}
 
</script>