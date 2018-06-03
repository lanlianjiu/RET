<?php
use yii\helpers\Url;
?>

<script>

function sendMassage(){
	console.log(2343);
	var phone = $("#smsCode").val();
	if(!phone){
		alert("请填号码");
		return false;
	};
	
	$.ajax({
		   type: "POST",
		   url: "<?=Url::toRoute('web-content/sendsms')?>",
		   data: {phone:phone},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){

		   }
		});
}
</script>