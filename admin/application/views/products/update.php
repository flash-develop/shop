<h1 class="text-center-margin-bottom">Редактировать товар</h1> 
 
<form action="<?php echo base_url(); ?>products/change" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-9">
          <input type="hidden" name="id" value="<?php echo $product->id; ?>" class="form-control">
          <div class="form-group <?php echo (!empty(form_error('title'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Название</label>
            <div class="col-sm-10">
              <input type="text" name="title" value="<?php echo (!isset($post['title'])) ? $product->title : $post['title']; ?>" class="form-control" id="name" placeholder="Название товара"><?php if (form_error('title')) { ?>
                <span class="help-block"><strong><?php echo form_error('title'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('description'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Описание</label>
            <div class="col-sm-10">
              <input type="text" name="description" value="<?php echo (!isset($post['description'])) ? $product->description : $post['description']; ?>" class="form-control" id="name" placeholder="Описание товара"><?php if (form_error('description')) { ?>
                <span class="help-block"><strong><?php echo form_error('description'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('short_description'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Краткое описание</label>
            <div class="col-sm-10">
              <input type="text" name="short_description" value="<?php echo (!isset($post['short_description'])) ? $product->short_description : $post['short_description']; ?>" class="form-control" id="name" placeholder="Краткое описание для превью товара"><?php if (form_error('short_description')) { ?>
                <span class="help-block"><strong><?php echo form_error('short_description'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('price'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Цена</label>
            <div class="col-sm-10">
              <input type="number" name="price" value="<?php echo (!isset($post['price'])) ? $product->price : $post['price']; ?>" class="form-control price" id="name" placeholder="Цена в рублях, целое число. Без копеек, точек и нулей после точки"><?php if (form_error('price')) { ?>
                <span class="help-block"><strong><?php echo form_error('price'); ?></strong></span>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Скидка</label>
            <div class="col-sm-10">
                <input type="number" name="sale_percent" value="<?php echo (!isset($post['sale_percent'])) ? $product->sale_percent : $post['sale_percent']; ?>" class="form-control sale_percent" id="name" placeholder="Скидка в процентах, знак % ставить не нужно, только цифры">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Цена по скидке</label>
            <div class="col-sm-10">
              <input type="number" name="sale_price" value="<?php echo (!isset($post['sale_price'])) ? $product->sale_price : $post['sale_price']; ?>" class="form-control sale_price" id="name" placeholder="Здесь отобразиться цена с учетом скидки" readonly>
            </div>
          </div>

          <div class="form-group <?php echo (!empty(form_error('vendor_code'))) ? 'has-error' : ''; ?>">
            <label class="control-label col-sm-2" for="name">Артикул</label>
            <div class="col-sm-10">
              <input type="text" name="vendor_code" value="<?php echo (!isset($post['vendor_code'])) ? $product->vendor_code : $post['vendor_code']; ?>" class="form-control article" id="name" placeholder="Русские буквы и цифры, на пример КРП890276 или ПРЗ59973"><?php if (form_error('vendor_code')) { ?>
                <span class="help-block"><strong><?php echo form_error('vendor_code'); ?></strong></span>
              <?php } ?>
            </div>
          </div>
        </div>
    
        <div class="col-sm-3">
            <div class="categories-checkboxes"><?php echo $html ?></div>
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
            <input type="file" name="userfile[]" value="345" size="20" multiple>
            <?php if (isset($upload_error)) { ?>
                <span class="help-block"><strong><?php echo $upload_error; ?></strong></span>
            <?php } ?>
        </div>
    </div>
</form>

<div class="row">
    <?php foreach ($product->images as $each_image) {?>
        <div class="col-sm-2 position-relative">
            <a data-lightbox="product-image" href="<?php echo base_url(); ?>images/<?php echo $each_image->img_name; ?>"><img class="position-relative img-size img-style" src="<?php echo base_url(); ?>images/<?php echo $each_image->img_name; ?>" style="height: 100px;" ></a>
            <img id="<?php echo $each_image->id; ?>" class="position-relative delete-img" data-toggle="modal" data-target="#myModal" src="<?php echo base_url(); ?>images/delete.png ?>" height="30">
        </div>
    <?php } ?>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Удалить картинку?</h4>
      </div>
      <div class="modal-body">
        Отменить это действие будет невозможно!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Не удалять</button>
        <a class='delete_image' href="#">
            <button type="button" class="btn btn-primary">Удалить</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('.delete-img').click(function() {  
            var id = $(this).attr('id');    
            var href = base_url + 'products/deleteimage/' + id;
            $('.delete_image').attr('href', href);
        });
    });
</script>

