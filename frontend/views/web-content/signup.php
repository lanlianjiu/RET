<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '注册';
?>
<div class="site-signup websign-img panel">
    <p>请填写以下字段注册：</p>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
               <table class="table">
                    <tr>
                      <td width="100">头像</td>
                       <td>
                            <?= $form->field($model,'head_img')->widget('common\widgets\file_upload\FileUpload',['config'=>[]])?>
                       </td>
                    </tr>
                    <tr>
                       <td>账号</td>
                       <td>  <div class="form-inline feedback"><?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?></div></td>
                    </tr>
                      <tr>
                       <td>密码</td>
                       <td> <div class="form-inline feedback"><?= $form->field($model, 'password')->passwordInput() ?></div></td>
                   </tr>
                    <tr>
                       <td>重复密码</td>
                       <td> <div class="form-inline feedback"><?= $form->field($model, 'rePassword')->passwordInput() ?></div></td>
                    </tr>
                    <tr>
                       <td>邮箱</td>
                       <td>  <div class="form-inline feedback"><?= $form->field($model, 'email') ?></div></td>
                    </tr>
                     <tr>
                        <td>短信验证码</td>
                        <td class="form-inline">
                            <input id="smsCode" type="text" class="form-control" name="WebMessageModel[massage]" />
                            <span onclick="sendMassage()">发送验证码</span>
                        </td>
                    </tr>
                    <tr>
                        <td>验证码</td>
                       <td> <div class="form-inline feedback"><?= $form->field($model, 'verifyCode')->widget(Captcha::className())?></div></td>
                    </tr>
                    <tr>
                       <td colspan="2">
                           <div class="form-group">
                                <?= Html::submitButton('提交', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
                            </div>
                       </td>
                    </tr>
               </table>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php include '/js/signup.php';?>
