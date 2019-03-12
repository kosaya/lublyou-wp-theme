<header class="SiteHeader--root">
  <div class="SiteHeader--container">
    <h2 class="SiteHeader--logo">
      <a href="<?php echo home_url(); ?>">
        <div class="SiteHeader--title">Lublyou</div>
        <div class="SiteHeader--subtitle">life & cuisine</div>
      </a>
    </h2>
  </div>
  <nav class="SiteHeader--nav Nav--root">
    <a class="Nav--mobile-toggle" href="#">Menu</a>
    <?php wp_nav_menu( array('theme_location' => 'top_menu', 'menu_class' => 'menu' ) ); ?>
  </nav>
</header>