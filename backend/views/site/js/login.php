<?php
use yii\helpers\Url;
?>
<script>
    $('#login_btn').click(function (e) {
        e.preventDefault();
        $('#login-form').submit();
    });
    $('#login-form').bind('submit', function (e) {
        e.preventDefault();
        $(this).ajaxSubmit({
            type: "post",
            dataType: "json",
            url: "<?=Url::toRoute('site/login')?>",
            success: function (value) {
                if (value.errno == 0) {
                    window.location.reload();
                } else {
                    $('#username').attr({
                        'data-placement': 'top',
                        'data-content': '<span class="text-danger">用户名或密码错误</span>',
                        'data-toggle': 'popover'
                    }).addClass('popover-show').popover({
                        html: true
                    }).popover('show');
                }

            }
        });
    });
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
</script>