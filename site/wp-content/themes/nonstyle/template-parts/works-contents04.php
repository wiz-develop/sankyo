<?php if (have_posts()) : ?>
<div class="works_list_wrap">
<div class="works_unit01">
<?php while (have_posts()) : the_post(); ?>
<div class="works_unit01_in">
<h3 class="subtitle04_01"><?php the_title(); ?></h3>
<div class="flex01">
<div class="img_box img100">
<div class="img01">
<?php if( get_field('画像')): ?>
<a href="<?php $image_url = wp_get_attachment_image_src(get_field('画像'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('画像');
$size = 'results-main';
if( $image ) {
    echo wp_get_attachment_image( $image, $size );
}
?></a>
<?php else : ?>
<img src="<?php echo get_template_directory_uri() ?>/images/works/noimage02.jpg">
<?php endif; ?>
</div>
<?php if( get_field('サブ画像1') || get_field('サブ画像2') || get_field('サブ画像3') || get_field('サブ画像4') || get_field('動画') ): ?>
<ul class="img02">
<?php if( get_field('サブ画像1')): ?>
<li><a href="<?php $image_url = wp_get_attachment_image_src(get_field('サブ画像1'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('サブ画像1');
$size = 'results-thum';
if( $image ) {
    echo wp_get_attachment_image( $image, $size );
}
?></a></li>
<?php endif; ?>
<?php if( get_field('サブ画像2')): ?>
<li><a href="<?php
$image_url = wp_get_attachment_image_src(get_field('サブ画像2'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('サブ画像2');
$size = 'results-thum';
if( $image ) {
    echo wp_get_attachment_image( $image, $size );
}
?></a></li>
<?php endif; ?>
<?php if( get_field('サブ画像3')): ?>
<li><a href="<?php $image_url = wp_get_attachment_image_src(get_field('サブ画像3'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('サブ画像3');
$size = 'results-thum';
if( $image ) {
    echo wp_get_attachment_image( $image, $size );
}
?></a></li>
<?php endif; ?>
<?php if( get_field('動画')): ?>
<li class="movie_area">
<a href="<?php the_field('動画'); ?>" data-lity="data-lity"><?php the_post_thumbnail('results-thum'); ?></a>
</li>
<?php endif; ?>
</ul>
<?php endif; ?>
</div>
<div class="text_box">
<dl>
<dt>詳細</dt>
<dd><?php the_field('詳細'); ?></dd>
</dl>
<dl>
<dt>価格</dt>
<dd><?php the_field('価格'); ?></dd>
</dl>
</div>
</div>
</div>
<?php endwhile; ?>
</div>
</div>

<?php if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
} ?>

<?php else : ?>
<div class="works_list_wrap no_list">
<p>現在公開準備中です。</p>
</div>
<?php endif; ?>
