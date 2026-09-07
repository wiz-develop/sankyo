<?php if (have_posts()) : ?>
<div class="works_list_wrap">
<div class="works_unit02">
<div class="works_unit02_in">
<?php while (have_posts()) : the_post(); ?>
<div class="w_box">
<h3 class="txtH"><?php the_title(); ?></h3>
<div class="w_box_in">
<div class="img_box movie_area"><a href="<?php the_field('動画'); ?>" data-lity="data-lity"><?php the_post_thumbnail('laser-img'); ?></a></div>
<dl>
<dt>製品名</dt>
<dd><?php the_field('製品名'); ?></dd>
<dt>価格</dt>
<dd><?php the_field('価格'); ?></dd>
</dl>
</div>
</div>
<?php endwhile; ?>
</div>

</div>
</div>
<?php else : ?>
<div class="works_list_wrap no_list">
<p>現在公開準備中です。</p>
</div>
<?php endif; ?>
