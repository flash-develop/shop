<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Магазин всякого-разного</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo ($page == 'content/home') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Главная</a>
                </li>
                <li class="nav-item <?php echo ($page == 'content/about') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>pages/about">О магазине</a>
                </li>
                <li class="nav-item <?php echo ($page == 'content/contacts') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>pages/contacts">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>