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
			<table class="table">
					<tr>
						<td algin="right">登录账号</td>
						<td>
							<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
						</td>
					</tr>
					<tr>
						<td algin="right">登录密码</td>
						<td>
							<?= $form->field($model, 'password')->textInput(['autofocus' => true]) ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?= $form->field($model, 'rememberMe')->checkbox() ?>
						</td>
					</tr>
				</tr>
			</table>
			<?= Html::submitButton('', ['class' => 'btn btn-block btn-primary login_btn', 'name' => 'login-button']) ?>
		 <?php ActiveForm::end(); ?>
	</div>
</div>
