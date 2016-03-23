<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
      <div class="col-xs-12">
        <div class="meta-class">
          <div class="content-single-author"><?php echo get_avatar( get_the_author_meta('ID'), 40); ?></div>
          <?php get_template_part('templates/entry-meta'); ?>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
          <div class="about-author-description">

<div class="container-fluid">
<div class="row">
<div class="col-xs-2">
<div class="about-author-description-img">
<?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
</div>
</div>
<div class="col-xs-10">
  <h3>About This Author</h3>
  <p><?php the_author_meta('description'); ?></p>
  <ul>
    <li class="comment-content-pipe">
    <?php the_author_posts_link(); ?>
    </li>
    <li>
      <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a> 

    </li>
  </ul>
  <ul class="icons">
  <?php 
    $rss_url = get_the_author_meta( 'rss_url' );
    if ( $rss_url && $rss_url != '' ) {
      echo '<li class="comment-content-pipe"><a class="fa fa-rss" href="' . esc_url($rss_url) . '"></a></li>';
    }
            
    $google_profile = get_the_author_meta( 'google_profile' );
    if ( $google_profile && $google_profile != '' ) {
      echo '<li class="comment-content-pipe"><a class="fa fa-google-plus " href="' . esc_url($google_profile) . '" rel="author"></a></li>';
    }
            
    $twitter_profile = get_the_author_meta( 'twitter_profile' );
    if ( $twitter_profile && $twitter_profile != '' ) {
      echo '<li class="comment-content-pipe"><a class="fa fa-twitter " href="' . esc_url($twitter_profile) . '"></a></li>';
    }
            
    $facebook_profile = get_the_author_meta( 'facebook_profile' );
    if ( $facebook_profile && $facebook_profile != '' ) {
      echo '<li class="comment-content-pipe"><a class="fa fa-facebook" href="' . esc_url($facebook_profile) . '"></a></li>';
    }
            
    $linkedin_profile = get_the_author_meta( 'linkedin_profile' );
    if ( $linkedin_profile && $linkedin_profile != '' ) {
           echo '<li class="comment-content-pipe"><a class="fa fa-linkedin" href="' . esc_url($linkedin_profile) . '"></a></li>';
    }
  ?>
</ul>
</div>
</div>
</div>
</div>


        <footer>
          <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
        </footer>
      </div>
      <div class="col-xs-12">
        <?php comments_template('/templates/comments.php'); ?>
      </div>
    </div>

  </div>
  
</article>
<?php endwhile; ?>
