<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<!-- before header -->
<?php get_template_part('templates/head'); ?>
<?php
do_action('get_header');
?>
<!-- before templatse header -->
<?php
get_template_part('templates/header');
?>
<!-- before page-row page-row exapnded -->


<?php
if (is_page_template('template-custom.php') ) {
  get_template_part('templates/theme-custom');
}
elseif (is_page_template('template-sidebar.php') ) {
  get_template_part('templates/theme-sidebar');
}
elseif (is_page_template('template-home.php') ) {
  get_template_part('templates/theme-home');
}
else {
  get_template_part('templates/theme-default');
}
?>

<!-- before body -->
<body <?php body_class(); ?>>
  <!--[if IE]>
  <div class="alert alert-warning">
  <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
</div>
<![endif]-->
<!-- before call func get header -->
<!-- before container -->
<div class="page-row page-row-expanded">
  <div class="container container-page" >
    <div class="row" id="navbar-main" >
      <div class="col-xs-12 col-sm-9">
        <?php include Wrapper\template_path(); ?>
        <!--/row-->
      </div><!--/.col-xs-12.col-sm-9-->

      <div class="col-xs-6 col-sm-3" id="sidebar">
        <?php if (Setup\display_sidebar()) : ?>
          <div class="no-class">
          <style>
          @media only screen and (min-width : 320px) {}
            @media only screen and (min-width : 480px) {}
              @media only screen and (min-width : 768px) {.col-xs-12.col-sm-9 {width: 75%;}}
              @media only screen and (min-width : 992px) {.col-xs-12.col-sm-9 {width: 75%;}}
              @media only screen and (min-width : 1200px){.col-xs-12.col-sm-9 {width: 75%;}}
              </style>
              <?php include Wrapper\sidebar_path(); ?>
            </div><!-- /.sidebar -->
          <?php endif; ?>

        </div><!--/.sidebar-->
      </div><!--/row-->
    </div><!--/.container-->
    <?php
    if (is_page_template('template-home.php') ) {
      get_template_part('templates/theme-home-bottom');
    }
    else {
      get_template_part('');
    }
    ?>
  </div>
</body>

<?php
do_action('get_footer');
get_template_part('templates/footer');
wp_footer();
?>
</html>
