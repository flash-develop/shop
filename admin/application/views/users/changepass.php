<form action="<?php echo base_url(); ?>users/changepass/<?php echo $hashed_in_url_email; ?>" method="post" class="form-horizontal">
    <input name="second_password" value="<?php echo $user_id; ?>" type="hidden">
    <h2 class="form-signin-heading text-center-margin-bottom">Смена пароля</h2>

    <div class="row">
      <div class="form-group">
        <label class="col-md-4 control-label" for="first_password">Новый пароль</label>  
        <div class="col-md-4">
          <input id="first_password" name="password" value="" placeholder="Введите новый пароль" class="form-control input-md" type="password">
          <?php if (form_error('password')) { ?>
            <div class="has-error">
                <span class="help-block"><strong><?php echo form_error('password'); ?></strong></span>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label" for="second_password">Подтверждение пароля</label>
        <div class="col-md-4">
          <input id="second_password" name="password_confirm" value="" placeholder="Повторите новый пароль" class="form-control input-md" type="password">
          <?php if (form_error('password_confirm')) { ?>
            <div class="has-error">
                <span class="help-block"><strong><?php echo form_error('password_confirm'); ?></strong></span>
            </div>
          <?php } ?>
        </div>
      </div> 
    <div class="col-md-4 col-md-offset-4"> 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Обновить пароль</button>
    </div>

</form>
