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
<div class="postArea clearfix">
<p id="date"><?php the_time('Y年 M j日'); ?>
<?php if (date('U') - get_the_time('U') <= 10 * 24 * 60 * 60): ?>
<span class="red">New</span>
<?php endif; ?></p>
<h2 id="detail"><?php the_title(); ?></h2>
<?php the_content(); ?>
</div><!-- postArea clearfix -->

<?php endwhile; else: ?>
<p>申し訳ありません、ファイルが見つかりません。</p>
<?php endif; ?>

<div class="list-back">
<?php if(in_category('news')): ?>
<a href="<?php bloginfo('url'); ?>/category/news/"><img src="<?php bloginfo('template_url'); ?>/images/back.gif" alt="一覧へ戻る" width="120" height="40"></a>
<?php endif; ?>
</div>


</div><!--main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>