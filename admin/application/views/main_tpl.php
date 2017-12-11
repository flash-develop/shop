<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Магазин</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/main_css.css" rel="stylesheet">

    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <?php if(!empty($js_file)) { ?>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/pages/<?php echo $js_file; ?>.js"></script>
    <?php } ?>
  </head>

  <body>
    <?php if (!isset($do_not_display_menu)) {
      $this->load->view('menu');
      } ?>
    <div class="container">
        <?php $this->load->view($page); ?>
    </div>

    <div class="preloader"></div>
    
  </body>

</html>