<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

            <?php foreach ($products as $each_product) { ?>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <div href="#" class="text-center">
                        <img class="card-img-top height-145 width-auto" height="145" width="auto" src="<?php echo base_url(); ?>images/<?php echo $each_product->img_name; ?>" alt="">
                    </div>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="<?php echo base_url(); ?>product/<?php echo $each_product->id; ?>"><?php echo $each_product->title; ?></a>
                      </h4>
                      <?php if (!empty($each_product->sale_percent)) { ?>
                        <h5><strike><?php echo $each_product->price; ?> руб.</strike></h5>
                        <div style="color: red;"><strong>Скидка <?php echo $each_product->sale_percent; ?>%!</strong></div>
                            Цена со скидкой:
                        <h4><?php echo $each_product->sale_price; ?> руб.</h4>
                      <?php } else { ?>
                        <h4><?php echo $each_product->price; ?> руб.</h4>
                      <?php } ?>
                      <p class="card-text"><?php echo $each_product->short_description; ?></p>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                  </div>
                </div>
            <?php } ?>

          </div>
          <!-- /.row -->

          <div class="pagination-center">
                <ul class="pagination">
                    <?php foreach ($links as $link) {
                        echo $link;
                    } ?>
                </ul>
            </div>
          
          