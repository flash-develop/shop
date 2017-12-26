<div class="row">
		<div class="margin-bottom-15 card mt-4 col-md-5">
            <a class="text-center img-a-style" data-lightbox="product-image" href="<?php echo base_url(); ?>/admin/images/<?php echo $product->images[0]->img_name; ?>">
            		<img data-lightbox="product-image" class="img-top img-fluid" src="<?php echo base_url(); ?>/admin/images/<?php echo $product->images[0]->img_name; ?>" alt="">
            	</a>
            <div class="row padding-0-15">
        		<?php foreach ($product->images as $key => $each_image) { ?>
        			<?php if ($key == 0) { 
        				continue;
        			}?>
        			<div class="col-sm-2 img-a-style margin-5">
            			<a data-lightbox="product-image" href="<?php echo base_url(); ?>/admin/images/<?php echo $each_image->img_name; ?>">
            				<img data-lightbox="product-image" class="img-bottom img-fluid " src="<?php echo base_url(); ?>/admin/images/<?php echo $each_image->img_name; ?>" alt="">
            			</a>
            		</div>
            	<?php } ?>
	        </div>
            <div class="card-body">
              	<h4 class="card-title"><?php echo $product->title; ?></h4>

              	<?php if (!empty($product->sale_percent)) { ?>
              		<h5><strike><?php echo $product->price; ?> руб.</strike></h5>
              		<div style="color: red;"><strong>Скидка <?php echo $product->sale_percent; ?>%!</strong></div>
					Цена со скидкой:
              		<h4><u><?php echo $product->sale_price; ?> руб.</u></h4>
              	<?php } else { ?>
              		<h4><u><?php echo $product->price; ?> руб.</u></h4>
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