<?php get_header(); ?>
<div id="contents">
<div id="works_main">
<?php if(is_tax('works_cat', 'common_steel_material') || is_tax('works_cat', 'heavy_temporary_construction')): ?>

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

<?php else : ?>
<?php get_template_part('template-parts/works-h3'); ?>

<?php get_template_part('template-parts/works-tab'); ?>

<?php if(is_tax('works_cat', 'reinforced_earth') || is_tax('works_cat', 'protection_from_falling_rocks') || is_tax('works_cat', 'reinforced_earth_material') || is_tax('works_cat', 'civil_engineering')): ?>
<?php get_template_part('template-parts/works-contents'); ?>
<?php elseif(is_tax('works_cat', 'drone_laser')): ?>
<?php get_template_part('template-parts/works-contents02'); ?>
<?php elseif(is_tax('works_cat', 'reinforced_earth_movie') || is_tax('works_cat', 'protection_from_falling_rocks_movie') || is_tax('works_cat', 'civil_engineering_movie')): ?>
<?php get_template_part('template-parts/works-contents03'); ?>
<?php elseif(is_tax('works_cat', 'drone')): ?>
<?php get_template_part('template-parts/works-contents04'); ?>
<?php endif; ?>

<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
