
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
	        <div class="text-center">
	         	<h3>Сбросить пароль</h3>
	          	<div class="panel-body">
		            <form action="<?php echo base_url(); ?>users/restorepass" id="register-form" role="form" autocomplete="off" class="form" method="post">
		              <div class="form-group">
		                <div class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
		                  <input id="email" name="email" placeholder="Email, указанный при регистрации " class="form-control" >
		                </div>
		              </div>
		              <?php if (!empty($error)) { ?>
		                <div class="has-error">
		                    <span class="help-block"><strong><?php echo $error; ?></strong></span>
		                </div>
			          <?php } ?>
		              <div class="form-group">
		                <button class="btn btn-lg btn-primary btn-block" type="submit">Сбросить</button>
		              </div>
		            </form>
	          	</div>
	        </div>
      	</div>
	</div>
</div>