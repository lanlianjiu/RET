<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<section class="content">
	<div class="row">
		
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">修改密码</h3>
          </div>
          <?php ActiveForm::begin(["id" => "update-psw-form", 'options' => ['class' => 'form-horizontal']]); ?>                      
            <div class="box-body">
            
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">当前角色</label>

                <div class="col-sm-9">
                  <input type="text" readonly="readonly" disabled="disabled" class="form-control" id="user_role" value="<?=$user_role?>" />
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">旧密码</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="old_password" name="old_password"  placeholder="旧密码" />
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">新密码</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="新密码">
                </div>
              </div>
              
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="确认密码">
                </div>
              </div>
            </div>
            <div class="box-footer">
              <label id="msg_info" class="control-label text-green hide"><i class="fa fa-check"></i>修改密码成功</label>
              <button id="update_psw_btn" type="button" class="btn btn-info pull-right">修改密码</button>
            </div>
          <?php ActiveForm::end(); ?>       
        </div>
      </div>
	</div>
</section>

<?php $this->beginBlock('footer');  ?>
<?php include '/js/psw.php';?>
<?php $this->endBlock(); ?>