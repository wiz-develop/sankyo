<?php
   // $cat = get_the_category();
   // $catslug2 = $cat[0]->category_nicename;
   // $catname = $cat[0]->cat_name;
   // $catid = $cat[0]->cat_ID;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
<title><?php if ( is_search() ) { ?>検索結果 | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_author() ) { ?>Author アーカイブ | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_single() ) { ?><?php wp_title(''); ?> | <?php single_cat_title(); ?> | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_page() ) { ?><?php wp_title(''); ?> | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_category() ) { ?><?php single_cat_title(); ?> | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_month() ) { ?><?php the_time('Y'); ?> | <?php the_time('F'); ?> | <?php bloginfo('name'); ?><?php } ?>
<?php if ( is_404() ) { ?>ページが見つかりません | <?php bloginfo('name'); ?><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?> | タグ | <?php  single_tag_title("", true); } } ?></title>
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/sticky-state.css">
<?php if ( is_page('contact') ) : ?>
<link rel="stylesheet" href="<?php bloginfo('url'); ?>/mailform/mfp.statics/mailformpro.css" type="text/css">
<?php endif ; ?>
<?php wp_head(); ?>
<?php if(!(is_tax('works_cat'))): ?>
<script src="<?php bloginfo('template_url'); ?>/js/thickbox.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/yuga.js"></script>
<?php endif; ?>
<?php if (!( wp_is_mobile() )) : ?>
<script src="<?php bloginfo('template_url'); ?>/js/smart-crossfade.js"></script>
<?php endif; ?>
<script src="<?php bloginfo('template_url'); ?>/js/sticky-state.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/common.js"></script>
<?php if(is_tax('works_cat')): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/lity.min.css" type="text/css">
<script src="<?php echo get_template_directory_uri() ?>/js/lity.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.matchHeight-min.js"></script>
<script><!-- 
jQuery(function(){
	$('.txtH').matchHeight();
});
 --></script>
<?php endif; ?>




</head>
<body <?php body_class(); ?>>
<header id="header">
<div id="header_in">
<h1 id="logo"><a href="<?php bloginfo('url'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="三共スチール株式会社"></a></h1>
<div id="gnav_btn">
<div id="gnav_btn_in"><span class="bar">&nbsp;</span><span class="bar">&nbsp;</span><span class="bar">&nbsp;</span></div>
</div>
<div id="globalnav">
<nav id="globalnav_in">
<ul id="nav">
<li><a href="<?php bloginfo('url'); ?>/">ホーム<span>HOME</span></a></li>
<li><a href="<?php bloginfo('url'); ?>/works/">事業内容<span>WORKS</span></a></li>
<li><a href="<?php bloginfo('url'); ?>/recruit/">採用情報<span>RECRUIT</span></a></li>
<li><a href="<?php bloginfo('url'); ?>/about/">会社概要<span>COMPANY</span></a></li>
<li><a href="<?php bloginfo('url'); ?>/news/">新着情報<span>NEWS</span></a></li>
<li class="contact_btn"><a href="<?php bloginfo('url'); ?>/contact/">お問合せはこちら</a></li>
</ul>
</nav>
</div>
</div>
</header>
