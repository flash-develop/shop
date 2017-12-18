<form action="<?php echo base_url(); ?>users/registration" method="post" class="form-horizontal">

    <h2 class="form-signin-heading text-center-margin-bottom">Регистрация</h2>

    <div class="row">
      <div class="form-group <?php echo (!empty(form_error('email'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="e-mail">Email</label>  
        <div class="col-md-4">
          <input id="e-mail" name="email" value="<?php echo set_value('email'); ?>" placeholder="Введите e-mail" class="form-control input-md" type="email">
          <div class="test-error"></div>
          <?php if (form_error('email')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('email'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-group <?php echo (!empty(form_error('password'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="pass_word">Пароль</label>
        <div class="col-md-4">
          <input id="pass_word" name="password" value="" placeholder="Введите пароль" class="form-control input-md" type="password">
          <?php if (form_error('password')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('password'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div> 

      <div class="form-group <?php echo (!empty(form_error('password_confirm'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="pass_word">Подтверждение пароля</label>
        <div class="col-md-4">
          <input id="pass_word" name="password_confirm" value="" placeholder="Подтвердите пароль" class="form-control input-md" type="password">
          <?php if (form_error('password_confirm')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('password_confirm'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div> 

      <div class="form-group <?php echo (!empty(form_error('username'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="username">Имя пользователя</label>  
        <div class="col-md-4">
          <input id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Ваш ник" class="form-control input-md" type="text">
          <?php if (form_error('username')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('username'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-group <?php echo (!empty(form_error('first_name'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="first_name">Имя</label>  
        <div class="col-md-4">
          <input id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" placeholder="Введите ваше имя" class="form-control input-md" type="text">
          <?php if (form_error('first_name')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('first_name'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-group <?php echo (!empty(form_error('last_name'))) ? 'has-error' : ''; ?>">
        <label class="col-md-4 control-label" for="last_name">Фамилия</label>  
        <div class="col-md-4">
          <input id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" placeholder="Введите вашу фамилию" class="form-control input-md" type="text">
          <?php if (form_error('last_name')) { ?>
                <div class="has-error">
                    <span class="help-block"><strong><?php echo form_error('last_name'); ?></strong></span>
                </div>
          <?php } ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-check">
              <label class="form-check-label">
                <input <?php echo (isset($post['show-address-checkbox'])) ? 'checked' : ''; ?> class="form-check-input" id="show-address-checkbox" name="show-address-checkbox" value="1" type="checkbox">
                Указать адресс доставки (можно указать позже, при заказе товара)
              </label>
            </div>
        </div>
      </div>

      <div class="show-on-chekbox" hidden>
        <div class="form-group">
          <label class="col-md-4 control-label" for="country">Страна</label>  
          <div class="col-md-4">
            <select id="country" class="form-control" name="country">
              <?php foreach ($countries as $each_country) { ?>
                <option value="<?php echo $each_country->id; ?>"><?php echo $each_country->name; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="region">Край или область</label>  
          <div class="col-md-4">
            <select id="region" class="form-control" name="region">
                <?php foreach ($regions as $each_region) { ?>
                    <option <?php echo (isset($post['region']) && $post['region'] == $each_region->id) ? 'selected' : ''; ?> value="<?php echo $each_region->id; ?>"><?php echo $each_region->name; ?></option>
                <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group <?php echo (!empty(form_error('city'))) ? 'has-error' : ''; ?>">
          <label class="col-md-4 control-label" for="city">Город</label>  
          <div class="col-md-4">
            <input id="city" name="city" value="<?php echo set_value('city'); ?>" placeholder="На пример: Ставрополь" class="form-control input-md" type="text">
            <?php if (form_error('city')) { ?>
                  <div class="has-error">
                      <span class="help-block"><strong><?php echo form_error('city'); ?></strong></span>
                  </div>
            <?php } ?>
          </div>
        </div>

        <div class="form-group <?php echo (!empty(form_error('street'))) ? 'has-error' : ''; ?>">
          <label class="col-md-4 control-label" for="street">Улица</label>  
          <div class="col-md-4">
            <input id="street" name="street" value="<?php echo set_value('street'); ?>" placeholder="На пример: улица Ставропольская" class="form-control input-md" type="text">
            <?php if (form_error('street')) { ?>
                  <div class="has-error">
                      <span class="help-block"><strong><?php echo form_error('street'); ?></strong></span>
                  </div>
            <?php } ?>
          </div>
        </div>

        <div class="form-group <?php echo (!empty(form_error('building'))) ? 'has-error' : ''; ?>">
          <label class="col-md-4 control-label" for="building">Номер дома</label>  
          <div class="col-md-4">
            <input id="building" name="building" value="<?php echo set_value('building'); ?>" placeholder="На пример: д 52" class="form-control input-md" type="text">
            <?php if (form_error('building')) { ?>
                  <div class="has-error">
                      <span class="help-block"><strong><?php echo form_error('building'); ?></strong></span>
                  </div>
            <?php } ?>
          </div>
        </div>

        <div class="form-group">
          <div class="text-center-margin-bottom">
              <span><strong>Если дом частный - оставьте пустое поле:</strong></span>
            </div>
          <label class="col-md-4 control-label" for="apartment">Квартира</label>  
          <div class="col-md-4">
            <input id="apartment" name="apartment" value="<?php echo set_value('apartment'); ?>" placeholder="На пример: кв 4" class="form-control input-md" type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-check">
              <label class="form-check-label" for="accept_checkbox">
                <input id="accept_checkbox" name="accept_checkbox" value="1" type="checkbox">
                Я согласен с условиями пользования магазином
                <?php if (form_error('accept_checkbox')) { ?>
                    <div class="has-error">
                        <span class="help-block"><strong><?php echo form_error('accept_checkbox'); ?></strong></span>
                    </div>
                <?php } ?>
              </label>
            </div>
        </div>
      </div>

    <div class="col-md-4 col-md-offset-4"> 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
    </div>

</form>


    


            