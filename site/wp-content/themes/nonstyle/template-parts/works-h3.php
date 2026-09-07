<p id="pan">
<a title="鋼材、重仮設資材、落石防護柵なら、大阪の三共スチール株式会社" href="<?php echo home_url(); ?>">ホーム</a> &gt;
<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="事業内容" href="<?php echo home_url(); ?>/works"><span property="name">事業内容</span></a><meta property="position" content="2"></span> &gt;
<span property="itemListElement" typeof="ListItem"><span property="name">
<?php if(is_tax('works_cat', 'reinforced_earth') ||is_tax('works_cat', 'reinforced_earth_movie')): ?>
補強土事業
<?php elseif(is_tax('works_cat', 'drone') ||is_tax('works_cat', 'drone_laser')): ?>
ドローン事業
<?php elseif(is_tax('works_cat', 'civil_engineering') ||is_tax('works_cat', 'civil_engineering_movie')): ?>
その他土木事業
<?php elseif(is_tax('works_cat', 'protection_from_falling_rocks') ||is_tax('works_cat', 'protection_from_falling_rocks_movie')): ?>
落石・防災対策事業
<?php elseif(is_tax('works_cat', 'reinforced_earth_material')): ?>
補強土関連資材事業
<?php endif; ?></span><meta property="position" content="3"></span></p>
<?php if(is_tax('works_cat', 'protection_from_falling_rocks') ||is_tax('works_cat', 'protection_from_falling_rocks_movie')): ?>
<h2 class="subtitle03_01"><img src="<?php echo get_template_directory_uri() ?>/images/works/05.jpg" alt="落石・防災対策事業"></h2>
<?php elseif(is_tax('works_cat', 'reinforced_earth') ||is_tax('works_cat', 'reinforced_earth_movie')): ?>
<h2 class="subtitle03_img"><img src="<?php echo get_template_directory_uri() ?>/images/works/04.jpg" alt="補強土事業"></h2>
<?php elseif(is_tax('works_cat', 'drone') ||is_tax('works_cat', 'drone_laser')): ?>
<h2 class="subtitle03_img"><img src="<?php echo get_template_directory_uri() ?>/images/works/07.jpg" alt="ドローン事業"></h2>
<?php elseif(is_tax('works_cat', 'reinforced_earth_material')): ?>
<h2 class="subtitle03_img"><img src="<?php echo get_template_directory_uri() ?>/images/works/08.jpg" alt="補強土関連資材事業"></h2>
<?php elseif(is_tax('works_cat', 'civil_engineering') ||is_tax('works_cat', 'civil_engineering_movie')): ?>
<h2 class="subtitle03_img"><img src="<?php echo get_template_directory_uri() ?>/images/works/09.jpg" alt="その他土木事業"></h2>
<?php endif; ?>
