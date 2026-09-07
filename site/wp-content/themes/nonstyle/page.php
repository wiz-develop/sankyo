<?php get_header(); ?>
<div id="contents">
<div id="main">
<?php
if(function_exists('bcn_display'))
{
// Display the breadcrumb
echo '<p id="pan">';
bcn_display();
echo '</p>';
}
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<?php the_content(); ?>


<?php endwhile; endif; ?>
</div><!--main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
