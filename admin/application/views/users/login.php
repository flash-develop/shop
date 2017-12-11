<?php 
  if ($this->session->userdata('new_user')) {
    $new_user = $this->session->userdata('new_user');
  } 
  if ($this->session->userdata('new_password')) {
    $new_password = $this->session->userdata('new_password');
  }
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="<?php echo base_url(); ?>users/login" method="post">
            <h2 class="form-signin-heading">Вход</h2>
            <?php if (!empty($message)) { ?>
                <span class="help-block" style="text-align: center; color: #08C20E;"><strong><?php echo $message; ?></strong></span>
            <?php } ?>
            <?php if (!empty($error)) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo $error; ?></strong></span>
                </div>
            <?php } ?>
            <?php if (isset($new_password['new_password'])) { ?>
                <span class="help-block" style="text-align: center; color: #08C20E;"><strong><?php echo $new_password['new_password']; ?></strong></span>
            <?php } ?>
            <?php if (isset($new_user['new_user_login'])) { ?>
                <span class="help-block" style="text-align: center; color: #08C20E;"><strong><?php echo $new_user['new_user_login']; ?></strong></span>
            <?php } ?>
            <?php if (!empty($authentication_error)) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo $authentication_error; ?></strong></span>
                </div>
            <?php } ?>
            <div class="form-group <?php echo (!empty(form_error('email_or_username'))) ? 'has-error' : ''; ?>">
                <label for="email_or_username">Email или имя пользователя</label>
                <input type="text" id="email_or_username" class="form-control" name="email_or_username" placeholder="Введите email или имя пользователя" autofocus>
                <?php if (!empty(form_error('email_or_username'))) { ?>
                    <span class="help-block"><strong><?php echo form_error('email_or_username'); ?></strong></span>
                <?php } ?>
            </div>
            <div class="form-group <?php echo (!empty(form_error('password'))) ? 'has-error' : ''; ?>">
                <label for="password">Пароль</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Пароль">
                <?php if (!empty(form_error('password'))) { ?>
                    <span class="help-block"><strong><?php echo form_error('password'); ?></strong></span>
                <?php } ?>
            </div>
            <div class="form-group"> 
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </div>
            <div class="form-group center-block"> 
                <a href="<?php echo base_url(); ?>users/registration"><p class="text-center">Еще не зарегистрированы? Исправить это!</p></a>
            </div>
            <div class="form-group center-block"> 
                <a href="<?php echo base_url(); ?>users/restorepass"><p class="text-center">Забыли пароль?</p></a>
            </div>
        </form>
    </div>
</div>

<?php 
$this->session->unset_userdata('new_user');
$this->session->unset_userdata('new_password'); 
?>