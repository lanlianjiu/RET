<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<div class="login-box">
  <div class="login-logo">
    <h3>登录</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->
	<?php $form = ActiveForm::begin(['id' => 'login-form', 'action'=>Url::toRoute('site/login')]); ?>
      <div class="form-group has-feedback">
        <input name="username" id="username" type="text" class="form-control" placeholder="用户名" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" id="password" type="password" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12" style="margin-bottom:20px;">
          <div class="checkbox icheck">
            <label>
              <input name="remember" id="remember" value="y" type="checkbox" /> &nbsp;记住我的登录
            </label>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-xs-12">
          <button id="login_btn" type="button" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
      </div>
    <?php ActiveForm::end(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- iCheck -->
<script src="<?=Url::base()?>/plugins/iCheck/icheck.min.js"></script>
<!-- /.login-box -->
<?php require dirname(__FILE__).'/js/login.php';?>