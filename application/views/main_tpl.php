<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>StavSklad.ru</title>

    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="<?php echo base_url(); ?>css/shop-homepage.css" rel="stylesheet">-->
    <link href="<?php echo base_url(); ?>css/main_css.css" rel="stylesheet">

    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>plugins/jquery-ui/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.bundle.min.js"></script>

  </head>

  <body>
    <div>
        <?php  $this->load->view('menu'); ?>
    </div>
    
    <div class="container">

      <div class="row">
        <!-- /.col-lg-3 LEFT CATEGORIES BLOCK -->
        <?php  $this->load->view('categories'); ?>
        
        <!-- /.col-lg-3 CENTER CONTENT -->
        <div class="col-lg-9">
            <div style="min-height: 1000px;">
                <div class="scrolling-center">
                    <?php  $this->load->view('content'); ?>
                </div>
            </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

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
