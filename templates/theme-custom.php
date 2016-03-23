<div class"page-row">
  <div class="jumbotron jumbotron-color"style="<?php if ( $background_custom = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' ) ) : ?>
    background: url('<?php echo $background_custom[0]; ?>');
  <?php endif; ?>;
  max-width: 100%;
  background-size: cover;
  background-origin: padding-box;
  background-position-y: center;
  background-position-x: center;
  background-repeat: no-repeat;
  color: #fff;
  text-align: center;
  ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <?php echo get_theme_mod('wpt_custom_page_html'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
