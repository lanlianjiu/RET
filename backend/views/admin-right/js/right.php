<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>
 window.controllerData = <?php echo json_encode($controllerData); ?>;
 function searchAction(){
		$('#admin-right-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){

	if(type == 'create'){
		$("#id").val('');
        //$("#menu_id").val('');
		$("#right_name").val('');
		$("#display_label").val('');
		$("#controller").val('');
		$("#des").val('');
		$("#display_order").val('');
		$("#has_lef").val('');
		$("#create_user").val('');
		$("#create_date").val('');
		$("#update_user").val('');
		$("#update_date").val('');
		
	}else{
		$("#id").val(data.id);
    	$("#menu_id").val(data.menu_id);
    	$("#right_name").val(data.right_name);
		$("#controller").val((data.menu == undefined)?"":data.menu.controller);
    	$("#display_label").val(data.display_label);
    	$("#des").val(data.des);
    	$("#controller option").each(function(){
        	var opt = $(this);
    		if(opt.val() == data.controller){
    			opt.attr('selected', true);
    			opt.change();
    			return false;
    		}
        });
    	$("#display_order").val(data.display_order);
    	$("#has_lef").val(data.has_lef);
    	$("#create_user").val(data.create_user);
    	$("#create_date").val(data.create_date);
    	$("#update_user").val(data.update_user);
    	$("#update_date").val(data.update_date);
    };

	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
	  //$("#menu_id").attr({readonly:true,disabled:true});
      $("#right_name").attr({readonly:true,disabled:true});
      $("#display_label").attr({readonly:true,disabled:true});
	  $("#controller").attr({readonly:true,disabled:true});
      $("#display_label").parent().parent().show();
      $("#des").attr({readonly:true,disabled:true});
      $("#display_order").attr({readonly:true,disabled:true});
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

	}else{
      $("#id").attr({readonly:false,disabled:false});
	  //$("#menu_id").attr({readonly:false,disabled:false});
      $("#right_name").attr({readonly:false,disabled:false});
      $("#display_label").attr({readonly:false,disabled:false});
      $("#display_label").parent().parent().hide();
	  $("#controller").attr({readonly:false,disabled:false});
      $("#des").attr({readonly:false,disabled:false});
      $("#display_order").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('admin-right/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data.model, type);
			  
			   if(type == "view"){

					for(var i in data.actions){
						for(var j in data.actions[i]){

							for(var m in data.actions[i][j]){
								
								if(data.actions[i][j][m].state){
									data.actions[i][j][m].state.disabled = true;
								}
							}
						}
					}
			   }
			  
			   $('#treeview').treeview({
					data:data.actions,
					showIcon: false,
			        showCheckbox: true,
			        levels: 2,
			        onNodeChecked: function(event, node) {
			          changeCheckState(node, true);
			        },
			        onNodeUnchecked: function (event, node) {
			        	changeCheckState(node, false);
			        }
				});
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
		ids = getCheckId($('#adminRight-table').bootstrapTable('getSelections'));
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('admin-right/delete')?>",
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
					   $('#adminRight-table').bootstrapTable('refresh');
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
	$('#admin-right-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    var menu_id = $("#menu_id").val();
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('admin-right/right-action')?>",
		   data: {'rightId':0, 'menu_id':menu_id},
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
			        levels: 2,
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
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#admin-right-form').bind('submit', function(e) {
	e.preventDefault();

	var checkNodes = $('#treeview').treeview('getChecked');
	var rightUrls = [];
	if(checkNodes.length > 0){
		for(i = 0; i < checkNodes.length; i++){
			var node = checkNodes[i];
			if(node.type == 'a'){
				var url = {'c':node.c, 'a':node.a};
				rightUrls.push(url);
			}
		}
	}
	
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('admin-right/create')?>" : "<?=Url::toRoute('admin-right/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	data:{id:id},
    	data: {"rightUrls":rightUrls},
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		$('#adminRight-table').bootstrapTable('refresh');
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

//配置功能url
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

$("#controller").change(function(){
    // 先清空第二个
	var controller = $(this).val();
     $("#action").empty();
     var option = $("<option>").html("请选择");
     $("#action").append(option);
    // 实际的应用中，这里的option一般都是用循环生成多个了
     var actions = window.controllerData[controller];
     var nodes = actions.nodes;
     var rightTree = {'text':controller, 'selectable':false, 'state':{'checked':false}, 'type':'r'};
     rightTree['nodes'] = nodes;
     
     $('#treeview').treeview({
		data: [rightTree],
		showIcon: false,
        showCheckbox: true,
        levels: 2,
        onNodeChecked: function(event, node) {
          changeCheckState(node, true);
        },
        onNodeUnchecked: function (event, node) {
        	changeCheckState(node, false);
        }
	});
     
});

function  operateFormatter(value, row, index) {
	  var h = "";
      h +='<a id="view_btn" onclick="viewAction('+ row.id +')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
      h +='<a id="edit_btn" onclick="editAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-edit icon-white"></i></a>';
	  h +='<a id="delete_btn" onclick="deleteAction('+ row.id +')" class="action-a-btn" href="#"> <i class="fa fa-trash icon-white"></i></a>';
	 return h;
}
</script>