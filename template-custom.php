<?php
/**
 * Template Name: Custom Default
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
