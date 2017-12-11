<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="<?php echo base_url(); ?>"><img class="margin-10" src="<?php echo base_url(); ?>images/logo.png" width="100"></a>
    </div>
    <div class = "menu-items-style">
      <ul class="nav navbar-nav">
        <li class="<?php echo ($page == 'products/index') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>products">ТОВАРЫ</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li class="<?php echo ($page == 'categories/index') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>categories">КАТЕГОРИИ</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url(); ?>users/logout"><span class="glyphicon glyphicon-log-in"></span> Выход</a></li>
      </ul>
    </div>
  </div>
</nav>