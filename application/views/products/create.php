<h1>Добавить товар</h1> 
 
<form action="<?php echo base_url(); ?>products/add" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-9">
          <div class="form-group <?php echo (!empty(form_error('title'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Название</label>
            <div class="col-sm-10">
              <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="name" placeholder="Название товара"><?php if (form_error('title')) { ?>
                <span class="help-block"><strong><?php echo form_error('title'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('description'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Описание</label>
            <div class="col-sm-10">
              <input type="text" name="description" value="<?php echo set_value('description'); ?>" class="form-control" id="name" placeholder="Описание товара"><?php if (form_error('description')) { ?>
                <span class="help-block"><strong><?php echo form_error('description'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('short_description'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Краткое описание</label>
            <div class="col-sm-10">
              <input type="text" name="short_description" value="<?php echo set_value('short_description'); ?>" class="form-control" id="name" placeholder="Краткое описание для превью товара"><?php if (form_error('short_description')) { ?>
                <span class="help-block"><strong><?php echo form_error('short_description'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('price'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Цена</label>
            <div class="col-sm-10">
              <input type="number" name="price" value="<?php echo set_value('price'); ?>" class="form-control price" id="name" placeholder="Цена в рублях, целое число. Без копеек, точек и нулей после точки"><?php if (form_error('price')) { ?>
                <span class="help-block"><strong><?php echo form_error('price'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Скидка</label>
            <div class="col-sm-10">
                <input type="number" name="sale_percent" value="<?php echo set_value('sale_percent'); ?>" class="form-control sale_percent" id="name" placeholder="Скидка в процентах, знак % ставить не нужно, только цифры">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Цена по скидке</label>
            <div class="col-sm-10">
              <input type="number" name="sale_price" value="" class="form-control sale_price" id="name" placeholder="Здесь отобразиться цена с учетом скидки" readonly>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('vendor_code'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Артикул</label>
            <div class="col-sm-10">
              <input type="text" name="vendor_code" value="<?php echo set_value('vendor_code'); ?>" class="form-control article" id="name" placeholder="Русские буквы и цифры, на пример КРП890276 или ПРЗ59973"><?php if (form_error('vendor_code')) { ?>
                <span class="help-block"><strong><?php echo form_error('vendor_code'); ?></strong></span>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-sm-3">
            <div class="categories-checkboxes">
                <?php if (!empty($cat_error)) { ?>
                    <div class="has-error">
                        <span class="help-block"><strong><?php echo $cat_error; ?></strong></span>
                    </div>
                <?php } ?>
                <?php echo $html ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Наличие на складе</label>
        <div class="col-sm-10">
            <label class="checkbox-inline" for="is-avalible">
                <input id="is-avalible" name="is_available" type="checkbox" value="1" checked><strong> В наличии</strong>
            </label>
        </div>
    </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-3">
      <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
    <div class="pull-right has-error">
      <span class=""><strong>Загрузить изображение</strong></span>
      <input type="file" name="userfile[]" value="<?php echo set_value('userfile'); ?>" size="20" multiple>
      <?php if (isset($upload_error)) { ?>
        <span class="help-block"><strong><?php echo $upload_error; ?></strong></span>
      <?php } ?>
    </div>
  </div>
</form>