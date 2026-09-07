<?php
$terms = get_the_terms('', 'works_cat');
foreach ((array)$terms as $term){  
$cat_name = $term->name;
$cat_slug = $term->slug;
$cat_id = $term->term_taxonomy_id;
}
?>
<?php if (have_posts()) : ?>
<div class="works_list_wrap">
<div class="works_unit03">
<?php
$args = array(
     'posts_per_page' => -1,
     'no_found_rows' => true,
     'tax_query' => array(
          array(
               'taxonomy' => 'works_cat',
               'field' => 'slug',
               'terms' => $cat_slug,
          )
     ),
     'meta_key' => '分類',
     'meta_value' => '実験',
     'meta_compare' => 'LIKE',
); ?>
<?php $my_query = new WP_Query( $args ); ?>
<?php if ( $my_query->have_posts() ): ?>
<h3 class="subtitle04_03">実験</h3>
<ul class="works_unit03_in">
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<li class="movie_area"><h5 class="txtH"><?php the_title(); ?></h5>
<div class="txt_c"><a href="<?php the_field('動画'); ?>" data-lity="data-lity"><?php the_post_thumbnail('laser-img'); ?></a></div></li>
<?php endwhile; ?>
<li class="flex_empty">&nbsp;</li>
<li class="flex_empty">&nbsp;</li>
</ul>
<?php endif; wp_reset_postdata(); ?>

<?php
$args = array(
     'posts_per_page' => -1,
     'no_found_rows' => true,
     'tax_query' => array(
          array(
               'taxonomy' => 'works_cat',
               'field' => 'slug',
               'terms' => $cat_slug,
          )
     ),
     'meta_key' => '分類',
     'meta_value' => '施工',
     'meta_compare' => 'LIKE',
); ?>
<?php $my_query = new WP_Query( $args ); ?>
<?php if ( $my_query->have_posts() ): ?>
<h3 class="subtitle04_03">施工</h3>
<ul class="works_unit03_in">
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<li class="movie_area"><h5 class="txtH"><?php the_title(); ?></h5>
<div class="txt_c"><a href="<?php the_field('動画'); ?>" data-lity="data-lity"><?php the_post_thumbnail('laser-img'); ?></a></div></li>
<?php endwhile; ?>
<li class="flex_empty">&nbsp;</li>
<li class="flex_empty">&nbsp;</li>
</ul>
<?php endif; wp_reset_postdata(); ?>

<?php
$args = array(
     'posts_per_page' => -1,
     'no_found_rows' => true,
     'tax_query' => array(
          array(
               'taxonomy' => 'works_cat',
               'field' => 'slug',
               'terms' => $cat_slug,
          )
     ),
     'meta_key' => '分類',
     'meta_value' => '全景',
     'meta_compare' => 'LIKE',
); ?>
<?php $my_query = new WP_Query( $args ); ?>
<?php if ( $my_query->have_posts() ): ?>
<h3 class="subtitle04_03">全景</h3>
<ul class="works_unit03_in">
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<li class="movie_area"><h5 class="txtH"><?php the_title(); ?></h5>
<div class="txt_c"><a href="<?php the_field('動画'); ?>" data-lity="data-lity"><?php the_post_thumbnail('laser-img'); ?></a></div></li>
<?php endwhile; ?>
<li class="flex_empty">&nbsp;</li>
<li class="flex_empty">&nbsp;</li>
</ul>
<?php endif; wp_reset_postdata(); ?>
</div>
</div>
<?php else : ?>
<div class="works_list_wrap no_list">
<p>現在公開準備中です。</p>
</div>
<?php endif; ?>
