<?php
/**
 * Blocksy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy
 */

if (version_compare(PHP_VERSION, '5.7.0', '<')) {
	require get_template_directory() . '/inc/php-fallback.php';
	return;
}

require get_template_directory() . '/inc/init.php';

/*-------------------------------------------*/
/*  ファイルの更新日時を取得
/*-------------------------------------------*/
function update_date($path) {
	return date("ymdHis", filemtime($path));
}

/*-------------------------------------------*/
/*  ヘッダー、フッターでの読み込み
/*-------------------------------------------*/
function add_wp_head_custom(){ ?>
	<?php date_default_timezone_set('Asia/Tokyo'); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.min.css?ver=<?php echo update_date( get_stylesheet_directory()."/assets/css/style.css"); ?>" media="all" />
<?php }
add_action( 'wp_head', 'add_wp_head_custom',99);
function add_wp_footer_custom(){ ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/common.js?ver=<?php echo update_date(get_stylesheet_directory()."/assets/js/common.js"); ?>"></script>
<?php }
add_action( 'wp_footer', 'add_wp_footer_custom', 99);

/*-------------------------------------------*/
/*  common.jsでサイトのURL・テーマURLを使えるようにする
/*-------------------------------------------*/
  $tmp_path_arr = array(
	  'temp_uri' => get_template_directory_uri(),
	  'home_url' => home_url()
  );
//   wp_enqueue_script( 'common', get_template_directory_uri() . '/assets/js/common.js', '', update_date((get_stylesheet_directory()."/assets/js/common.js")), true );
  wp_localize_script( 'common', 'tmp_path', $tmp_path_arr );
  
  // 記事の自動整形を無効化
  remove_filter('the_content', 'wpautop');

/**
 * FAQ カスタム投稿タイプ & タクソノミー
 */
add_action('init', function () {
    // CPT: faq
    register_post_type('faq', [
        'labels' => [
            'name'          => 'よくあるご質問',
            'singular_name' => 'FAQ',
            'add_new_item'  => '新しい質問を追加',
            'edit_item'     => '質問を編集',
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-editor-help',
        'supports'      => ['title', 'editor'],
        'rewrite'       => ['slug' => 'faq'],
        'show_in_rest'  => true,
    ]);

    // Tax: faq_category
    register_taxonomy('faq_category', 'faq', [
        'label'        => 'FAQカテゴリー',
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'faq-category'],
        'show_in_rest' => true,
    ]);
});

/**
 * ACF ローカル定義（FAQに「表示ページ指定」フィールドを自動作成）
 * ACF が有効な時のみ実行
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'                   => 'group_faq_display_pages',
        'title'                 => 'FAQ表示設定',
        'fields'                => [
            [
                'key'           => 'field_faq_display_pages',
                'label'         => '表示する固定ページ',
                'name'          => 'display_pages',
                'type'          => 'relationship', // or 'post_object' (multiple)
                'post_type'     => ['page'],
                'filters'       => ['search', 'post_type'],
                'return_format' => 'id',          // ★ID返却（重要）
                'multiple'      => 1,
                'instructions'  => 'このFAQを表示したい固定ページを選択してください（複数可）',
            ],
        ],
        'location' => [[
            [
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'faq',
            ],
        ]],
        'position'      => 'normal',
        'style'         => 'default',
        'active'        => true,
    ]);
});

/**
 * FAQ 取得用ヘルパー
 * - $args['page_id'] があれば ACF「display_pages」にそのページIDが含まれるFAQを抽出
 * - $args['group_by_category'] true でカテゴリごとに配列をグループ化
 */
function get_faq_items($args = []) {
    $defaults = [
        'page_id'           => 0,       // 指定があればページ紐づけで絞り込み
        'posts_per_page'    => -1,
        'order'             => 'ASC',
        'orderby'           => 'menu_order title',
        'category__in'      => [],      // 指定カテゴリで絞り込み（必要なら）
        'group_by_category' => false,
    ];
    $args = wp_parse_args($args, $defaults);

    $query_args = [
        'post_type'      => 'faq',
        'posts_per_page' => $args['posts_per_page'],
        'order'          => $args['order'],
        'orderby'        => $args['orderby'],
        'tax_query'      => [],
        'meta_query'     => [],
        'no_found_rows'  => true,
    ];

    // ページ指定（ACF relationship は serialized IDs なので "LIKE" 検索）
    if (!empty($args['page_id'])) {
        $page_id = (int) $args['page_id'];
        $query_args['meta_query'][] = [
            'key'     => 'display_pages',
            'value'   => '"' . $page_id . '"',
            'compare' => 'LIKE',
        ];
    }

    // カテゴリで絞る（任意）
    if (!empty($args['category__in'])) {
        $query_args['tax_query'][] = [
            'taxonomy' => 'faq_category',
            'field'    => 'term_id',
            'terms'    => array_map('intval', (array)$args['category__in']),
        ];
    }

    $q = new WP_Query($query_args);

    if (!$args['group_by_category']) return $q;

    // カテゴリごとにグルーピングして返す
    $grouped = [];
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            $terms = get_the_terms(get_the_ID(), 'faq_category') ?: [];
            if (!$terms) {
                $grouped[0]['term'] = null;
                $grouped[0]['posts'][] = get_post();
            } else {
                foreach ($terms as $t) {
                    $tid = $t->term_id;
                    if (!isset($grouped[$tid])) {
                        $grouped[$tid] = ['term' => $t, 'posts' => []];
                    }
                    $grouped[$tid]['posts'][] = get_post();
                }
            }
        }
        wp_reset_postdata();
    }
    return $grouped;
}

/**
 * 表示ショートコード
 * [faq_list] … 現在の固定ページに紐づいたFAQを一括表示（トップや事業詳細で使う）
 * [faq_all]  … 全FAQをカテゴリ分けなしで表示（トップ用など）
 * [faq_archive_like] … カテゴリごとにまとめて表示（一覧ページ用）
 */
add_shortcode('faq_list', function ($atts) {
    $atts = shortcode_atts([
        'page_id'        => get_the_ID(),
        'posts_per_page' => -1,
        'accordion'      => '1',
        'more_link'      => '0',      // ← 追加
        'archive_url'    => '/faq/',  // ← 追加
        'more_label'     => '一覧へ',  // ← 追加
    ], $atts, 'faq_list');

    $q = get_faq_items([
        'page_id'           => (int) $atts['page_id'],
        'posts_per_page'    => (int) $atts['posts_per_page'],
        'group_by_category' => false,
    ]);

    ob_start();
    if ($q->have_posts()) {
        // 先にカテゴリ収集
        $cat_terms = [];
        while ($q->have_posts()) { $q->the_post();
            $terms = get_the_terms(get_the_ID(), 'faq_category') ?: [];
            foreach ($terms as $t) { $cat_terms[$t->slug] = $t; }
        }
        wp_reset_postdata();

        echo '<div class="faq-list" data-accordion="'.esc_attr($atts['accordion']).'">';
        while ($q->have_posts()) { $q->the_post(); ?>
            <div class="faq-item">
                <div class="faq-item__question acor-menu mb-0"><?php echo esc_html(get_the_title()); ?></div>
                <div class="faq-item__answer acor-menu-child w-100 px-3 pb-3 pt-1">
                    <div class="d-flex bg-white px-2 py-2 faq-content__answer__txt"><?php the_content(); ?></div>
                </div>
            </div>
        <?php }
        echo '</div>';
        wp_reset_postdata();

        // 「一覧へ」リンク（該当カテゴリへジャンプ）
        if ($atts['more_link'] === '1' && !empty($cat_terms)) {
            echo '<div class="faq-more-links" style="margin-top:16px;">';
            foreach ($cat_terms as $t) {
                $href = trailingslashit($atts['archive_url']).'#faq-cat-'.rawurlencode($t->slug);
                echo '<a class="btn btn-outline-primary me-2" href="'.esc_url($href).'">'.esc_html($t->name).'の'.$atts['more_label'].'</a>';
            }
            echo '</div>';
        }
    }
    return ob_get_clean();
});

add_shortcode('faq_all', function ($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => -1,
        'accordion'      => '1',
        'more_link'      => '0',      // ← 追加: 一覧リンクを出すか
        'archive_url'    => '/faq/',  // ← 追加: 一覧ページのURL（必要なら変更）
        'more_label'     => '一覧へ',  // ← 追加: ボタン文言
    ], $atts, 'faq_all');

    $q = get_faq_items([
        'posts_per_page' => (int) $atts['posts_per_page'],
        'group_by_category' => false,
    ]);

    ob_start();
    if ($q->have_posts()) {

        // 表示中FAQが属するカテゴリを収集（ユニーク）
        $cat_terms = [];
        while ($q->have_posts()) { $q->the_post();
            $terms = get_the_terms(get_the_ID(), 'faq_category') ?: [];
            foreach ($terms as $t) { $cat_terms[$t->slug] = $t; }
        }
        wp_reset_postdata();

        echo '<div class="faq-list" data-accordion="'.esc_attr($atts['accordion']).'">';
        while ($q->have_posts()) { $q->the_post(); ?>
            <div class="faq-item">
                <div class="faq-item__question acor-menu mb-0"><?php echo esc_html(get_the_title()); ?></div>
                <div class="faq-item__answer acor-menu-child w-100 px-3 pb-3 pt-1">
                    <div class="d-flex bg-white px-2 py-2 faq-content__answer__txt"><?php the_content(); ?></div>
                </div>
            </div>
        <?php }
        echo '</div>';
        wp_reset_postdata();

        // カテゴリ別の「一覧へ」リンク（任意）
        if ($atts['more_link'] === '1' && !empty($cat_terms)) {
            echo '<div class="faq-more-links" style="margin-top:16px;">';
            foreach ($cat_terms as $t) {
                $href = trailingslashit($atts['archive_url']).'#faq-cat-'.rawurlencode($t->slug);
                echo '<a class="btn btn-outline-primary me-2" href="'.esc_url($href).'">'.esc_html($t->name).'の'.$atts['more_label'].'</a>';
            }
            echo '</div>';
        }
    }
    return ob_get_clean();
});

add_shortcode('faq_archive_like', function ($atts) {
    $atts = shortcode_atts([
        'accordion' => '1',
    ], $atts, 'faq_archive_like');

    $terms = get_terms(['taxonomy' => 'faq_category', 'hide_empty' => true]);
    ob_start();
    if (!is_wp_error($terms) && $terms) {
        foreach ($terms as $term) {
            $q = new WP_Query([
                'post_type' => 'faq',
                'posts_per_page' => -1,
                'tax_query' => [[
                    'taxonomy' => 'faq_category',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ]],
                'no_found_rows' => true,
            ]);
            if ($q->have_posts()) {
                echo '<section class="faq-category" id="faq-cat-'.esc_attr($term->slug).'">';
                echo '<h2 class="faq-category__title">'.esc_html($term->name).'</h2>';
                echo '<div class="faq-list" data-accordion="'.esc_attr($atts['accordion']).'">';
                while ($q->have_posts()) {
                    $q->the_post();
                    ?>
                    <div class="faq-item">
						<div class="faq-item__question acor-menu mb-0">
							<?php echo esc_html(get_the_title()); ?>
						</div>
						<div class="faq-item__answer acor-menu-child w-100 px-3 pb-3 pt-1">
							<div class="d-flex bg-white px-2 py-2 faq-content__answer__txt">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
                    <?php
                }
                echo '</div></section>';
                wp_reset_postdata();
            }
        }
    }
    return ob_get_clean();
});

function load_top_news_list() {
    ob_start();
    get_template_part('template-parts/top-news_list');
    return ob_get_clean();
}
add_shortcode('top_news_list', 'load_top_news_list');

function load_latest_news() {
    ob_start();
    get_template_part('template-parts/latest-news-ticker');
    return ob_get_clean();
}
add_shortcode('latest_news', 'load_latest_news');

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_year()) {
        $title = get_query_var('year') . '年';
    } elseif (is_month()) {
        $title = get_the_date('Y年n月');
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_home()) {
        $title = single_post_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    }
    return $title;
});
add_filter('blocksy:breadcrumbs:output', function ($output) {
    // 詳細ページ、カテゴリー、アーカイブページが対象
    if ( (is_single() || is_category() || is_archive()) && !is_home() ) {
        
        $news_page_id = get_option('page_for_posts');
        $news_url = get_permalink($news_page_id);
        $news_title = get_the_title($news_page_id) ?: '新着情報';

        // 「ホーム」の直後に「新着情報」を挿入する
        // </a> と次の項目の間に「新着情報」のリンクを差し込む処理
        $search = '</a>'; // 最初のホームの閉じタグ
        $replace = '</a><span class="delimiter"></span><a href="' . $news_url . '">' . $news_title . '</a>';
        
        // 最初の1回だけ置換（Homeの直後）
        $output = preg_replace('/' . preg_quote($search, '/') . '/', $replace, $output, 1);
        
        // もし「採用情報（カテゴリー名）」を消して「Home > 新着情報 > タイトル」にしたい場合は、
        // さらにCSSで調整するのが最も安全です。
    }
    return $output;
}, 9999);
add_action('wp_footer', function() {
    if ( is_single() || is_category() || is_archive() ) {
        $news_page_id = get_option('page_for_posts');
        $news_url = get_permalink($news_page_id);
        $news_title = get_the_title($news_page_id) ?: '新着情報';
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const breadcrumbs = document.querySelector('.ct-breadcrumbs');
            if (!breadcrumbs) return;

            const firstLink = breadcrumbs.querySelector('a');
            if (firstLink && (firstLink.innerText.includes('ホーム') || firstLink.innerText.includes('Home'))) {
                
                // テーマ標準のSVGコード
                const svgIcon = '<svg class="ct-separator" fill="currentColor" width="8" height="8" viewBox="0 0 8 8" aria-hidden="true" focusable="false"><path d="M2,6.9L4.8,4L2,1.1L2.6,0l4,4l-4,4L2,6.9z"></path></svg>';
                
                // 「新着情報」のリンクHTML
                const newsLinkHtml = '<a href="<?php echo $news_url; ?>"><?php echo $news_title; ?></a>';

                // ホームリンクの直後に「SVG + 新着情報」を挿入
                firstLink.insertAdjacentHTML('afterend', svgIcon + newsLinkHtml);

                // もともと表示されていたカテゴリー（採用情報など）を非表示にする
                // ホーム(0) > SVG(1) > 新着(2) > SVG(3) > カテゴリ(4) > SVG(5) > 現在地 のうち 4と5を隠す
                const allElements = Array.from(breadcrumbs.childNodes);
                // aタグの数を数えて、4つ以上ある場合は途中のカテゴリーを隠す
                const links = breadcrumbs.querySelectorAll('a');
                if (links.length >= 4) {
                    // 「新着情報」より後のリンク（本来のカテゴリー）と、その直前のSVGを隠す
                    links[2].style.display = 'none';
                    if (links[2].previousElementSibling && links[2].previousElementSibling.tagName === 'svg') {
                        links[2].previousElementSibling.style.display = 'none';
                    }
                }
            }
        });
        </script>
        <?php
    }
}, 999);
