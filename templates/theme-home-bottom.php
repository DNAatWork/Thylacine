<div>
  <div class="jumbotron jumbotron-color" id="bckimgcust"  style="
background-image: url('<?php if( get_theme_mod( 'wpt_custom_home_image') != "" ): ?><?php echo get_theme_mod( 'wpt_custom_home_image' ); ?><?php endif; ?>');
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
          <?php echo get_theme_mod('wpt_custom_home_secondary_html'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
