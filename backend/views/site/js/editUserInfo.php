<?php
use yii\helpers\Url;
?>

<script>
$('#update_psw_btn').click(function (e) {
    e.preventDefault();
	$('#update-psw-form').submit();
});

$('#update-psw-form').bind('submit', function(e) {
	e.preventDefault();
	$("#msg_info").addClass('hide');
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: "<?=Url::toRoute('site/psw-save')?>",
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$("#msg_info").removeClass('hide');
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
</script>