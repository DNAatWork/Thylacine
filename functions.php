<?php
/**
* Sage includes
*
* The $sage_includes array determines the code library included in your theme.
* Add or remove files to the array as needed. Supports child theme overrides.
*
* Please note that missing files will produce a fatal error.
*
* @link https://github.com/roots/sage/pull/1042
*/

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
require_once( get_template_directory() . '/functions-customizer.php' );
add_filter('show_admin_bar', '__return_false');
add_theme_support( 'html5', array( 'widgets' ) );
add_theme_support( 'post-thumbnails' );

$sage_includes = [
'lib/assets.php',    // Scripts and stylesheets
'lib/extras.php',    // Custom functions
'lib/setup.php',     // Theme setup
'lib/titles.php',    // Page titles
'lib/wrapper.php',   // Theme wrapper class
'lib/customizer.php' // Theme customizer
];
//----------------------------Custom---------------------------
//----------------------------Custom---------------------------
//----------------------------Custom---------------------------

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
function mytheme_comment($comment, $args, $depth) {
  if ( 'div' === $args['style'] ) {
    $tag       = 'div';
    $add_below = 'comment';
  } else {
    $tag       = 'li';
    $add_below = 'div-comment';
  }
  ?>
  <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-2">
          <div class="comment-author vcard">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size']); ?>
          </div>
        </div>
        <div class="col-xs-10">
        <?php comment_text(); ?>
        <div class="comment-content">
          <ul>
            <li class="comment-content-pipe">
              <?php printf( __( '%s' ), get_comment_author_link() ); ?>
            </li>
            <li class="comment-content-pipe"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                /* translators: 1: date, 2: time */
                printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '<li class="comment-content-pipe">Edit</li>' ), '', '' );
                ?>
            </li>
            <li>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </li>
              <?php if ( $comment->comment_approved == '0' ) : ?>
              <div class=""><?php _e( '<hr/><li><div class="alert alert-info" role="alert">Your comment is awaiting moderation. </div></li>' ); ?></div>
              <br />
            <?php endif; ?>
          </ul>
          </div>
      </div>
    </div>
  </div>
</div>
<?php if ( 'div' != $args['style'] ) : ?>

  <?php endif; ?>
  <?php
}
