<?php
use yii\helpers\Url;
define('ROOT_PATH',dirname(dirname(dirname(dirname(__FILE__)))));
include ROOT_PATH.'/web/js/iov-min-public.php';
?>

<script>

    function orderby(field, op){

        var url = window.location.search;
        var optemp = field + " desc";

        if(url.indexOf('orderby') != -1){
            url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
                var optemp = field + " desc";
                optemp = decodeURI($1) != optemp ? optemp : field + " asc";
                return "orderby=" + optemp;
            }); 
        }else{

            if(url.indexOf('?') != -1){
                url = url + "&orderby=" + encodeURI(optemp);
            }
            else{
                url = url + "?orderby=" + encodeURI(optemp);
            }
        }
        window.location.href=url; 
    }
    function searchAction(){
        $('#web-message-search-form').submit();
    }

    function viewAction(id){
        initModel(id, 'view', 'fun');
    }

    function initEditSystemModule(data, type){

        if(type == 'create'){
            $("#message_id").val('');
            $("#connet_name").val('');
            $("#connet_phone").val('');
            $("#email").val('');
            $("#address").val('');
            $("#message_content").val('');
            $("#create_date").val('');
            $("#is_look").val('');
            
        }else{
            $("#message_id").val(data.message_id);
            $("#connet_name").val(data.connet_name);
            $("#connet_phone").val(data.connet_phone);
            $("#email").val(data.email);
            $("#address").val(data.address);
            $("#message_content").val(data.message_content);
            $("#create_date").val(data.create_date);
            $("#is_look").val(data.is_look);
        }

        if(type == "view"){
            $("#message_id").attr({readonly:true,disabled:true});
            $("#connet_name").attr({readonly:true,disabled:true});
            $("#connet_phone").attr({readonly:true,disabled:true});
            $("#email").attr({readonly:true,disabled:true});
            $("#address").attr({readonly:true,disabled:true});
            $("#message_content").attr({readonly:true,disabled:true});
            $("#create_date").attr({readonly:true,disabled:true});
            $("#is_look").attr({readonly:true,disabled:true});
            $('#edit_dialog_ok').addClass('hidden');
        }else{
            $("#message_id").attr({readonly:false,disabled:false});
            $("#connet_name").attr({readonly:false,disabled:false});
            $("#connet_phone").attr({readonly:false,disabled:false});
            $("#email").attr({readonly:false,disabled:false});
            $("#address").attr({readonly:false,disabled:false});
            $("#message_content").attr({readonly:false,disabled:false});
            $("#create_date").attr({readonly:false,disabled:false});
            $("#is_look").attr({readonly:false,disabled:false});
            $('#edit_dialog_ok').removeClass('hidden');
        }
            $('#edit_dialog').modal('show');
    }

    function initModel(id, type, fun){
        
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('web-message/view')?>",
            data: {"message_id":id},
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
           ids = getCheckId($('#webmessage-table').bootstrapTable('getSelections'));
        }
        if(ids.length > 0){
            admin_tool.confirm('请确认是否删除', function(){
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('web-message/delete')?>",
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
                         $('#webmessage-table').bootstrapTable('refresh');
                    }
                    });
            });
        }
        else{
            admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
        }
        
    }

    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });

    function  operateFormatter(value, row, index) {
	 var h = "";
	 h +='<a id="view_btn" onclick="viewAction('+row.message_id+')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i></a>';
      //h +='<a id="edit_btn" onclick="editAction('+row.message_id+')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
       h +='<a id="delete_btn" onclick="deleteAction('+row.message_id+')" class="action-a-btn" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i></a>';
	 return h;
    }

</script>