<div id="access">
<div class="map_area">
<div class="gmap">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d820.2094456839943!2d135.49258582845323!3d34.68404337909004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e6fc15ae1fc5%3A0x6d4f4ab16f9e65df!2z5LiJ5YWx44K544OB44O844Or77yI5qCq77yJ!5e0!3m2!1sja!2sjp!4v1563195886925!5m2!1sja!2sjp" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
<div class="address">
<dl>
<dt>ACCESS</dt>
<dd><h4>三共スチール株式会社</h4>
大阪市西区靱本町1丁目20番13号<br>
なにわ筋ビル3階
</dd>
</dl>
<dl>
<dt>CONTACT</dt>
<dd class="font01"><span class="in_bl">TEL：<a class="tel_link" href="tel:06-6447-0101">06-6447-0101</a></span><br>
<span class="in_bl">FAX：<a class="tel_link" href="tel:06-6447-0120">06-6447-0120</a></span></dd>
</dl>
</div>
<?php
$banner = array(
     'posts_per_page' => 10,
     'post_type' => 'banner'
); ?>
<?php $my_query = new WP_Query( $banner ); ?>
<?php if ( $my_query->have_posts() ): ?>
<ul>
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<li><a href="<?php the_field('url'); ?>">
<?php 
$image = get_field('bnr_img');
$size = 'full';
if( $image ) {
    echo wp_get_attachment_image( $image, $size );
}
?></a></li>
<?php endwhile; ?>
</ul>
<?php endif; wp_reset_postdata(); ?>
</div>
<p id="copyright">Copyright &copy; <?php echo date('Y'); ?> SANKYO STEEL All Rights Reserved.</p>
