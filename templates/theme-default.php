<div class"page-row">
  <div class="jumbotron jumbotron-color"style="<?php if ( $background_defualt = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' ) ) : ?>
    background: url('<?php echo $background_defualt[0]; ?>');
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
      <div class="row" style="
      margin-top: 50px;
      margin-bottom: 50px;
      ">
        <div class="col-xs-12">
          <?php use Roots\Sage\Titles; ?>
          <h1><?= Titles\title(); ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
