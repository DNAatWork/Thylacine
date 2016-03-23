<?php
/**
 * Template Name: sidebar
 */
?>

<!-- jumbotron 1 -->
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
<!-- jumbotron 2 -->
