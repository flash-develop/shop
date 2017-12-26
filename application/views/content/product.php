<div class="row">
		<div class="card mt-4 col-md-5">
            <img class="img-top img-fluid" src="<?php echo base_url(); ?>images/<?php echo $product->images[0]->img_name; ?>" alt="">
            <div class="row">
            	
            		<?php foreach ($product->images as $each_image) { ?>
            			<div class="col-md-4">
	            			<img class="img-bottom img-fluid" src="<?php echo base_url(); ?>images/<?php echo $each_image->img_name; ?>" alt="">
	            		</div>
	            	<?php } ?>
	            
	        </div>
            <div class="card-body">
              	<h3 class="card-title"><?php echo $product->title; ?></h3>

              	<?php if (!empty($product->sale_percent)) { ?>
              		<h5><strike><?php echo $product->price; ?> руб.</strike></h5>
              		<div style="color: red;"><strong>Скидка <?php echo $product->sale_percent; ?>%!</strong></div>
					Цена со скидкой:
              		<h4><?php echo $product->sale_price; ?> руб.</h4>
              	<?php } else { ?>
              		<h4><?php echo $product->price; ?> руб.</h4>
              	<?php } ?>
              	<p class="card-text"><?php echo $product->short_description; ?></p>
              	<div class="row">
	              	<a href="#" class="btn btn-primary margin-10">Купить</a>
	              	<a href="#" class="btn btn-success margin-10">В корзину</a>
	           	</div>
            </div>
          </div>
          <!-- /.card -->

          <div class="card-outline-secondary my-4 col-md-7">
            <div class="card-header card">
              Полное описание твара:
            </div>
            <div class="card-body">
              <?php echo $product->description; ?>
            </div>
          </div>
          <!-- /.card -->
        </div>
</div>