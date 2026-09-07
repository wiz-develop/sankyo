<?php
   $cat = get_the_category();
   $catslug2 = $cat[0]->category_nicename;
   $catname = $cat[0]->cat_name;
   $catid = $cat[0]->cat_ID;
?>
<!DOCTYPE html>
<html lang="ja" class="">
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
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/utility.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/fullpage.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/jquery.flexslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/top.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/top_tablet.css" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/top_smartphone.css" type="text/css">

<?php wp_head(); ?>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.biggerlink.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.matchHeight-min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/scrolloverflow.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.flexslider-min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.fullpage.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/home.js"></script>


</head>
<body id="home">
<div id="sp_btn">
<a href="#"><span id="panel-btn-icon"></span><span class="text">メニュー</span></a>
</div>
<header id="header">
<div id="logo">
<h1><a href="<?php echo home_url(); ?>/"><img src="<?php echo get_template_directory_uri() ?>/images/home/logo.jpg" alt="三共スチール株式会社"></a></h1>
</div>
<nav id="top_menu">
<div id="globalnav">
<ul class="gnav">
<li><a href="<?php echo home_url(); ?>/"><span class="main">ホーム</span><span class="sub">HOME</span></a></li>
<li><a href="<?php echo home_url(); ?>/about"><span class="main">会社概要</span><span class="sub">COMPANY</span></a></li>
<li><a href="<?php echo home_url(); ?>/works"><span class="main">事業内容</span><span class="sub">WORKS</span></a></li>
<li><a href="<?php echo home_url(); ?>/news"><span class="main">新着情報</span><span class="sub">NEWS</span></a></li>
<li><a href="<?php echo home_url(); ?>/recruit"><span class="main">採用情報</span><span class="sub">RECRUIT</span></a></li>
<li><a href="<?php echo home_url(); ?>/contact"><span class="main">お問合せ</span><span class="sub">CONTACT</span></a></li>
</ul>
</div>
<div id="subnav">
<div class="movie"><a href="https://www.youtube.com/channel/UCnyjDnolUuhZRuIbZXAL0tQ/videos" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/home/movie.png" alt="MOVIE"></a></div>
</div>
</nav>
<p id="copyright">Copyright &copy; <?php echo date('Y'); ?> SANKYO STEEL All Rights Reserved.</p>
</header>
