<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';

?>
<div class="loginBox">
	<div class="login_cont">
	 <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
			<ul class="login">
				<li class="l_tit">管理员帐号</li>
				<li class="mb_10"><?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?></li>
				<li class="l_tit">密码</li>
				<li class="mb_10"><?= $form->field($model, 'password')->passwordInput() ?></li>
				<!-- <li class="l_tit">验证码</li>
				<li class="mb_10"><input type="text"  name="verify" class="login_input password_icon"></li> -->
				<img src="getVerify.php" alt="" />
				<li class="autoLogin"> <?= $form->field($model, 'rememberMe')->checkbox() ?><label for="a1">自动登陆(一周内自动登陆)</label></li>
				<li><?= Html::submitButton('登录', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button']) ?></li>
			</ul>
		 <?php ActiveForm::end(); ?>
	</div>
</div>
