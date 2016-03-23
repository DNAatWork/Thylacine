<header class="page-row" id="main">
<?php if( get_header_image() != "" ): ?>
    <img src="<?php header_image(); ?>" class="img-responsive header-image" alt="Header graphic" />
<?php endif ?>

<style>
.header-image {
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  width: 100%;
  background-size: cover;
}
</style>
</header><!-- .site-header -->

<nav class="navbar navbar-default navbar-static-top"  id="navbar-main" >
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-12" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="glyphicon glyphicon-menu-hamburger
"></span>
      </button>
      <a class="navbar-brand site-title" href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
      <?php if( get_theme_mod( 'wpt_logo') != "" ): ?>
      <a class="navbar-brand" style="padding: 0px;/* firefox bug fix */padding-left: 15px;" id="logo" href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo get_theme_mod( 'wpt_logo' ); ?>" alt="Dispute Bills"></a>
      <?php endif; ?>
      </a>

    </div>
    <?php
    wp_nav_menu( array(
      'menu'              => 'primary_navigation',
      'theme_location'    => 'primary_navigation',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse navbar-right',
      'container_id'      => 'bs-example-navbar-collapse-12',
      'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker())
    );
    ?><!-- /.nav-collapse -->
  </div><!-- /.container -->
</nav>
