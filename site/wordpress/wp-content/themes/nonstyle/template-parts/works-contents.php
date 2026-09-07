<?php if (have_posts()) : ?>
<div class="works_list_wrap">
<div class="works_unit01">
<?php while (have_posts()) : the_post(); ?>
<?php if(is_tax('works_cat', 'reinforced_earth') || is_tax('works_cat', 'protection_from_falling_rocks') || is_tax('works_cat', 'civil_engineering')): ?>
<div class="works_unit01_in">
<h3 class="subtitle04_01 pdf_title"><span class="main"><?php the_title(); ?></span>
<?php if( get_field('pdf01')): ?>
<span class="btn">
<a href="<?php the_field('pdf01'); ?>" target="_blank">
<?php if( get_field('pdf_title01')): ?><?php the_field('pdf_title01'); ?><?php else : ?>PDF<?php endif; ?>
</a>
<?php if( get_field('pdf02')): ?>
<a href="<?php the_field('pdf02'); ?>" target="_blank">
<?php if( get_field('pdf_title02')): ?><?php the_field('pdf_title02'); ?><?php else : ?>PDF<?php endif; ?>
</a>
<?php endif; ?>
</span>
<?php endif; ?>
</h3>
<div class="flex01">
<div class="img_box img100">
<div class="img01">
<?php if( get_field('メイン画像')): ?>
<a href="<?php $image_url = wp_get_attachment_image_src(get_field('メイン画像'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('メイン画像');
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
<dt>発注者</dt>
<dd><?php the_field('発注者'); ?></dd>
</dl>
<dl>
<dt>現場名</dt>
<dd><?php the_field('現場名'); ?></dd>
</dl>
<dl>
<dt>詳細</dt>
<dd class="o_scroll"><?php the_field('詳細'); ?></dd>
</dl>
</div>
</div>
</div>
<?php elseif(is_tax('works_cat', 'reinforced_earth_material')): ?>
<div class="works_unit05_in">
<h3 class="subtitle04_01 pdf_title"><span class="main"><?php the_title(); ?></span>
<?php if( get_field('pdf01')): ?>
<span class="btn">
<a href="<?php the_field('pdf01'); ?>" target="_blank">
<?php if( get_field('pdf_title01')): ?><?php the_field('pdf_title01'); ?><?php else : ?>PDF<?php endif; ?>
</a>
<?php if( get_field('pdf02')): ?>
<a href="<?php the_field('pdf02'); ?>" target="_blank">
<?php if( get_field('pdf_title02')): ?><?php the_field('pdf_title02'); ?><?php else : ?>PDF<?php endif; ?>
</a>
<?php endif; ?>
</span>
<?php endif; ?>
</h3>
<div class="flex01">
<div class="img_box img100">
<div class="img01">
<?php if( get_field('メイン画像')): ?>
<a href="<?php $image_url = wp_get_attachment_image_src(get_field('メイン画像'), 'full'); ?><?php echo $image_url[0]; ?>">
<?php 
$image = get_field('メイン画像');
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
<li><a href="<?php
$image_url = wp_get_attachment_image_src(get_field('サブ画像3'), 'full'); ?><?php echo $image_url[0]; ?>">
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
</div>
</div>
</div>
<?php endif; ?>
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
