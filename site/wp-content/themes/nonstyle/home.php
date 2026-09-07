<?php get_header('2'); ?>
<div id="fullpage">
<div class="section section01 spFullpage">
<div class="section-inner">
<div class="slide fullpage-slide1">
<div class="flexslider">
<ul class="slides">
<li id="mainimage01" class="main_img"></li>
<li id="mainimage05" class="main_img"></li>
<li id="mainimage06" class="main_img"></li>
<li id="mainimage02" class="main_img"></li>
<li id="mainimage03" class="main_img"></li>
<li id="mainimage04" class="main_img"></li>
</ul>
</div>
<h2 class="toptitle02">「スチール」あるところに、<br>
我々の新鮮な技術や情熱があります。</h2>
<dl id="pickup_news">
<dt>ニュース<span class="sub">NEWS</span></dt>
<dd>
<?php
$news = array(
     'posts_per_page' => 1,
     'category_name' => 'news'
); ?>
<?php $my_query = new WP_Query( $news ); ?>
<?php if ( $my_query->have_posts() ): while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<span class="news_date"><?php echo date("Y.m.d", strtotime($post->post_date)); ?></span>
<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
<?php endwhile; else: ?>
<span>現在お知らせはありません。</span>
<?php endif; wp_reset_postdata(); ?>
</dd>
</dl>
</div>
</div>
</div>
<div class="section section02 spFullpage">
<div class="section-inner">
<div class="slide fullpage-slide2">
<div id="top_works">
<div class="top_works_in title">
<h3 class="toptitle03_01"><span class="main">事業内容</span><span class="sub">WORKS</span></h3>
</div>
<div class="top_works_in">
<dl>
<dt>一般鋼材・鉄筋事業</dt>
<dd><a href="<?php echo home_url(); ?>/works/common_steel_material"><img src="<?php echo get_template_directory_uri() ?>/images/home/top_works01.jpg" alt="一般鋼材・鉄筋事業<"></a></dd>
</dl>
</div>
<div class="top_works_in">
<dl>
<dt>重仮設資材・工事事業</dt>
<dd><a href="<?php echo home_url(); ?>/works/heavy_temporary_construction"><img src="<?php echo get_template_directory_uri() ?>/images/home/top_works02.jpg" alt="重仮設資材・工事事業<"></a></dd>
</dl>
</div>
<div class="top_works_in">
<dl>
<dt>補強土事業</dt>
<dd><a href="<?php echo home_url(); ?>/works/reinforced_earth"><img src="<?php echo get_template_directory_uri() ?>/images/home/top_works03.jpg" alt="補強土事業<"></a></dd>
</dl>
</div>
<div class="top_works_in">
<dl>
<dt>落石・防災対策事業</dt>
<dd><a href="<?php echo home_url(); ?>/works/protection_from_falling_rocks"><img src="<?php echo get_template_directory_uri() ?>/images/home/top_works05.jpg" alt="落石・防災対策事業"></a></dd>
</dl>
</div>
<div class="top_works_in">
<dl>
<dt>その他土木事業</dt>
<dd><a href="<?php echo home_url(); ?>/works/civil_engineering"><img src="<?php echo get_template_directory_uri() ?>/images/home/top_works07.jpg" alt="その他土木事業"></a></dd>
</dl>
</div>
<div class="top_works_in flex-empty"></div>
</div>
</div>
</div>
</div>
<div class="section section03 spFullpage">
<div class="section-inner">
<div class="slide fullpage-slide3">
<div id="top_media">
<h3 class="toptitle03_02">ニュース<span class="sub">NEWS</span></h3>
<div class="top_area_in">
<div id="top_news">
<?php
$news = array(
     'posts_per_page' => 3,
     'category_name' => 'news'
); ?>
<?php $my_query = new WP_Query( $news ); ?>
<?php if ( $my_query->have_posts() ): ?>
<ul>
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<li><span class="news_date"><?php echo date("Y.m.d", strtotime($post->post_date)); ?></span>
<a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
<?php else: ?>
<p>現在お知らせはありません。</p>
<?php endif; wp_reset_postdata(); ?>
</div>
</div>
<?php get_template_part('template-parts/access'); ?>
</div>
</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
