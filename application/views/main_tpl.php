<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>StavSklad.ru</title>

    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/product_css.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/main_css.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/lightbox2/css/lightbox.css">

    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>plugins/jquery-ui/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/lightbox2/js/lightbox.js"></script>

  </head>

  <body>
    <?php  $this->load->view('menu'); ?>

    
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php  $this->load->view('categories'); ?>
            </div>
        <div class="col-lg-9">
            <?php  $this->load->view($page); ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; StavSklad</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->


  </body>

</html>
