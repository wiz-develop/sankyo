<?php
// #more-$id を削除する。
function custom_content_more_link( $output ) {
    $output = preg_replace('/#more-[\d]+/i', '', $output );
    return $output;
}
add_filter( 'the_content_more_link', 'custom_content_more_link' );

// excerpt使用時に続きを読むを表示する。
function new_excerpt_more($post) {
	return '<p><a href="'. get_permalink($post->ID) . '" class="excerpt_more"><img src="' . get_bloginfo('template_url') . '/images/tm-more.gif" width="70" height="20" alt="続きを読む" /></a></p>';	
}	
add_filter('excerpt_more', 'new_excerpt_more');

// Pタグの調整用
remove_filter('the_excerpt', 'wpautop');

// ウィジェット
// register_sidebar();

// ショートコード
function printurl() {
return home_url();
}
add_shortcode('home_url', 'printurl');

function printtempurl() {
return get_template_directory_uri();
}
add_shortcode('template_directory_uri', 'printtempurl');

//jQuery設定
function load_cdn() {
	if ( !is_admin() ) {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', array(), '1.11.2');
	}
}
add_action('init', 'load_cdn');

// アイキャッチ画像を有効
add_theme_support('post-thumbnails');

// メディアサイズの追加
add_image_size( 'results-main', 214, 200, true );
add_image_size( 'results-thum', 100, 95, true );
add_image_size( 'lineup-img', 380, 250, true );
add_image_size( 'laser-img', 194, 194, true );

// 固定ページ編集で、ビジュアルとテキストを行き来すると、タグの属性が消える問題の対策 */
function pnd_allow_all_attr ($init) {
    $ext_elements = '';
 
    $target_elements = array(
        'p','a', 'b', 'base', 'big', 'blockquote', 'body', 'br', 'caption', 'dd', 'div', 'dl',
        'dt', 'em', 'embed', 'font', 'form', 'h', 'head',  'hr', 'html', 'i', 'img', 'input',
        'li', 'link', 'meta', 'nobr', 'noembed', 'object', 'ol', 'option', 'p', 'pre', 's',
        'script', 'select', 'small',  'span', 'strike', 'strong', 'sub', 'sup', 'table',
        'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'title', 'tr', 'tt', 'u', 'ul',
        'iframe'
    );
    $target_attr = array(
        '*'
    );
 
    foreach ($target_elements as $target_element) {
        $ext_elements .= ",".$target_element."[".implode('|',$target_attr)."]";
    }
 
    if ( !empty($ext_elements) ) {
        if ( !empty($init['extended_valid_elements']) )
            $init['extended_valid_elements'] .= $ext_elements;
        else
            $init['extended_valid_elements'] = trim($ext_elements, ',');
    }
 
    return $init;
}
add_filter( 'tiny_mce_before_init', 'pnd_allow_all_attr', 100 );

//head内の不要なタグを消去
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
function disable_emoji() {
     remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
     remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
     remove_action( 'wp_print_styles', 'print_emoji_styles' );
     remove_action( 'admin_print_styles', 'print_emoji_styles' );
     remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
     remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
     remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );

//セルフピンバック禁止
function no_self_pingst( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_pingst' );

// 管理画面メディアを一番下に
function push_menus () {
    global $menu;
    array_push($menu, $menu[10]);
    unset($menu[10]);//メディア
}
add_action('admin_menu', 'push_menus');

// is_mobile追加
function is_mobile(){
$useragents = array(
'iPhone', // iPhone
'iPod', // iPod touch
'Android.*Mobile', // 1.5+ Android *** Only mobile
'Windows.*Phone', // *** Windows Phone
'dream', // Pre 1.5 Android
'CUPCAKE', // 1.5+ Android
'blackberry9500', // Storm
'blackberry9530', // Storm
'blackberry9520', // Storm v2
'blackberry9550', // Storm v2
'blackberry9800', // Torch
'webOS', // Palm Pre Experimental
'incognito', // Other iPhone browser
'webmate' // Other iPhone browser
);
$pattern = '/'.implode('|', $useragents).'/i';
return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

// 動画の埋め込みコードを自動的にdivタグで囲む
function iframe_in_div($the_content) {
if ( is_singular() ) {
$the_content = preg_replace('/<iframe/i', '<div class="movie"><iframe', $the_content);
$the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);
}
return $the_content;
}
add_filter('the_content','iframe_in_div');


function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy){
    return str_replace('/'.$taxonomy.'/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set',11,3);

// ページネーション
function pagination($pages = '', $range = 1)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><div class=\"pagination-box\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>\n";
     }
}

// 管理画面にターム別ソート機能を追加
add_action('restrict_manage_posts', function() {
    global $post_type;
    if ( !in_array($post_type, ['works']) ) return;
    $taxonomy = 'works_cat';
    $terms = get_terms($taxonomy);
    if ( empty($terms) ) return;
    $selected = get_query_var($taxonomy);
    $options = '';
    foreach ($terms as $term) {
        $options .= sprintf('<option value="%s" %s>%s</option>'
                ,$term->slug
                ,($selected==$term->slug) ? 'selected="selected"' : ''
                ,$term->name
        );
    }
    $select = '<select name="%s"><option value="">指定なし</option>%s</select>';
    printf($select, $taxonomy, $options);
});

// Contact Form 7メールの再入力チェック
function wpcf7_main_validation_filter( $result, $tag ) {
  $type = $tag['type'];
  $name = $tag['name'];
  $_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
  if ( 'email' == $type || 'email*' == $type ) {
    if (preg_match('/(.*)_confirm$/', $name, $matches)){
      $target_name = $matches[1];
      if ($_POST[$name] != $_POST[$target_name]) {
        if (method_exists($result, 'invalidate')) {
          $result->invalidate( $tag,"確認用のメールアドレスが一致していません");
      } else {
          $result['valid'] = false;
          $result['reason'][$name] = '確認用のメールアドレスが一致していません';
        }
      }
    }
  }
  return $result;
}

add_filter( 'wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2 );

?>
