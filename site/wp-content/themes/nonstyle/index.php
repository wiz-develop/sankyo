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
<?php if ( in_category('news') ) : ?>
<h2 class="subtitle03">新着情報一覧<span class="sub">NEWS</span></h2>
<?php endif; ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="postbox clearfix">
<dl>
<dt><?php the_time('Y年 M j日'); ?>
<?php if (date('U') - get_the_time('U') <= 10 * 24 * 60 * 60): ?>
<span class="red">New</span>
<?php endif; ?></dt>
<dd><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></dd>
</dl>
</div><!--postbox -->

<?php endwhile; ?>

<div class="tablenav"><?php global $wp_rewrite;
$paginate_base = get_pagenum_link(1);
if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
	$paginate_format = '';
	$paginate_base = add_query_arg('paged', '%#%');
} else {
	$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
	user_trailingslashit('page/%#%/', 'paged');;
	$paginate_base .= '%_%';
}
echo paginate_links( array(
	'base' => $paginate_base,
	'format' => $paginate_format,
	'total' => $wp_query->max_num_pages,
	'mid_size' => 5,
	'current' => ($paged ? $paged : 1),
)); ?></div>
	<?php else : ?>
	

		<h2>ページが見つかりません。</h2>
		<p>申し訳ありません、ファイルが削除されたかURLが変更された可能性があります。</p>

	<?php endif; ?>

</div><!--main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
