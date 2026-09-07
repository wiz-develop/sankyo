jQuery(function($){ 

  /*-------------------------------------------*/
  /* jsでサイトのURL・テーマのパスを使えるようにする
  /*-------------------------------------------*/
  // var wp_temp_uri = tmp_path.temp_uri;
  // var wp_home_url = tmp_path.home_url;

  /*-------------------------------------------*/
  /* スムーススクロール
  /*-------------------------------------------*/
  // Header の高さを取得
 // 設定
  var SPEED = 300; // スクロールアニメーション時間（ms）
  var SESSION_KEY = 'wp_anchor_hash';
  var HEADER_SELECTORS = ['#header'];
  var DEFAULT_EXTRA_OFFSET = 10; // ヘッダーにさらに上乗せで余白が欲しい場合の既定値（px）

  // CSS.escape フォールバック
  function escapeId(id){
    if (window.CSS && CSS.escape) return '#' + CSS.escape(id);
    return '#' + id.replace(/([!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~])/g, '\\$1');
  }

  // ヘッダー高さを取得（候補の中から大きいものを採用）＋ wpadminbar を加算
  function getHeaderHeight(){
    var h = 0;
    for (var i = 0; i < HEADER_SELECTORS.length; i++){
      var sel = HEADER_SELECTORS[i];
      var $el = $(sel);
      if ($el.length) {
        // outerHeight が null の場合を考慮
        var oh = $el.first().outerHeight() || 0;
        if (oh > h) h = oh;
      }
    }
    // 管理バーがあれば加算（管理バーが上に固定されているときの補正）
    var $admin = $('#wpadminbar');
    if ($admin.length && $admin.is(':visible')) {
      h += ($admin.outerHeight() || 0);
    }
    return Math.round(h);
  }

  function isPC(){
    return window.innerWidth > 999;
  }

  function isIpad(){
    return /iPad/.test(navigator.userAgent) || (navigator.userAgent.includes('Macintosh') && 'ontouchend' in document);
  }

  // スクロール位置計算。anchor または target に data-offset 属性があれば優先
  function computeScrollTop($target, extraOffsetFromAttr){
    var headerH = getHeaderHeight();
    var targetTop = ($target && $target.length) ? $target.offset().top : 0;

    var pc = isPC();
    var ipad = isIpad();

    // 基本ベース（サイトごとに調整してください）
    var offsetBase = pc ? 100 : 40;

    // data-offset が数値で与えられていればそれを優先
    var extra = (typeof extraOffsetFromAttr === 'number' && !isNaN(extraOffsetFromAttr)) ? extraOffsetFromAttr : DEFAULT_EXTRA_OFFSET;

    var pos = targetTop - headerH - offsetBase + extra;

    // 元サンプルに近づける微調整（必要なら数値を変えてください）
    if (pc) {
      pos += 40;
    } else if (ipad) {
      pos += 0;
    } else {
      pos += 0;
    }

    // 範囲 clamp
    pos = Math.max(0, Math.round(pos));
    var max = Math.max(0, $(document).height() - $(window).height());
    pos = Math.min(pos, max);

    return pos;
  }

  // 実際にスクロールする
  function scrollToTarget($target, hrefForHistory, extraOffsetFromAttr){
    if (!$target || !$target.length) return;
    var pos = computeScrollTop($target, extraOffsetFromAttr);
    $('html,body').stop(true).animate({ scrollTop: pos }, SPEED, 'swing', function(){
      if (hrefForHistory && history.replaceState) {
        try { history.replaceState(null, null, hrefForHistory); } catch(e){ /* ignore */ }
      }
    });
  }

  // クリックハンドラ（ページ内 or 別ページハッシュを判定）
  $(document).on('click', 'a[href*="#"]', function(e){
    var href = $(this).attr('href') || '';
    if (href.indexOf('#') === -1) return; // 念のため

    // URL を解釈。相対パスにも対応
    var url;
    try {
      url = new URL(href, location.href);
    } catch(err) {
      // URL が使えない環境は簡易分解
      var parts = href.split('#');
      url = {
        pathname: parts[0] || location.pathname,
        hash: parts[1] ? ('#' + parts[1]) : ''
      };
    }

    var hash = url.hash ? url.hash.replace(/^#/, '') : '';
    if (!hash) return; // 空ハッシュなら何もしない

    // 同ページかどうか判定（origin + pathname が同じか、href が #xxx のみ）
    var samePage = false;
    try {
      samePage = (new URL(href, location.href)).origin === location.origin && (new URL(href, location.href)).pathname === location.pathname;
    } catch(e){
      // fallback: href がハッシュのみの場合は同ページ
      samePage = href.indexOf('#') === 0 || (url.pathname === location.pathname || url.pathname === '');
    }

    if (samePage) {
      e.preventDefault();

      var selector = escapeId(hash);
      var $target = $(selector);

      // data-offset 読み取り（優先順位: clicked anchor の data-offset → target の data-offset → default）
      var anchorOffset = $(this).data('offset');
      if (typeof anchorOffset !== 'number') {
        // jQuery may return string, try parseInt
        if (anchorOffset !== undefined) anchorOffset = parseInt(anchorOffset, 10);
      }
      var targetOffset = $target.length ? $target.data('offset') : undefined;
      if (typeof targetOffset !== 'number') {
        if (targetOffset !== undefined) targetOffset = parseInt(targetOffset, 10);
      }
      var extra = (typeof anchorOffset === 'number' && !isNaN(anchorOffset)) ? anchorOffset : (typeof targetOffset === 'number' && !isNaN(targetOffset) ? targetOffset : undefined);

      if ($target.length) {
        scrollToTarget($target, '#' + hash, extra);
      } else {
        // ターゲットが見つからなければデフォルトの挙動に（または何もしない）
        // ここでは何もしない（必要なら location.hash = '#' + hash にしても良い）
      }
    } else {
      // 別ページへのハッシュリンク、sessionStorage に保存してハッシュ無しで遷移
      try {
        sessionStorage.setItem(SESSION_KEY, JSON.stringify({ path: url.pathname || '/', hash: hash, search: url.search || '' }));
      } catch(e) {
        // storage が使えない場合は通常遷移（ハッシュ付き）させる
      }
      // ハッシュは除いた URL に遷移して、遷移先で sessionStorage を読んでスクロールさせる
      var dest = (url.pathname || '/') + (url.search || '');
      window.location.href = dest;
    }
  });

  // ページ読み込み時の処理：sessionStorage（別ページからの遷移）優先、次に location.hash
  $(function(){
    // 1) sessionStorage 経由
    var sessionRaw = null;
    try { sessionRaw = sessionStorage.getItem(SESSION_KEY); } catch(e) { sessionRaw = null; }
    if (sessionRaw) {
      try {
        var obj = JSON.parse(sessionRaw);
        if (obj && obj.path && obj.path === location.pathname && obj.hash) {
          var sel = escapeId(obj.hash);
          var $t = $(sel);
          if ($t.length) {
            setTimeout(function(){ scrollToTarget($t, '#' + obj.hash); }, 80);
          }
        }
      } catch(e){
        // ignore parse error
      }
      try { sessionStorage.removeItem(SESSION_KEY); } catch(e) { /* ignore */ }
      return;
    }

    // 2) location.hash があれば処理（直接リンクやリロード時）
    if (location.hash) {
      var h = location.hash.replace(/^#/, '');
      if (h) {
        var selector = escapeId(h);
        var $target = $(selector);
        if ($target.length) {
          setTimeout(function(){ scrollToTarget($target, '#' + h); }, 80);
        }
      }
    }
  });

  // ページ読み込み時にハッシュがあれば同様にスクロール
  $(document).ready(function(){
    var urlHash = location.hash;
    if (urlHash) {
      var $target = $(urlHash);
      var targetTop = $target.length ? $target.offset().top : 0;
      var hashposi = Math.max(0, targetTop - HeaderHeight - extraOffset);
      setTimeout(function () {
        $('html, body').animate({ scrollTop: hashposi }, speed, 'swing');
      }, 100);
    }
  });

  /*-------------------------------------------*/
  /* アニメーション
  /*-------------------------------------------*/
  $(function () {
    if ($('.anime').length) {
        scrollAnimation();
    }
    function scrollAnimation() {
        $(window).scroll(function () {
            $(".anime").each(function () {
                let position = $(this).offset().top,
                    scroll = $(window).scrollTop(),
                    windowHeight = $(window).height();

                if (scroll > position - windowHeight + 200) {
                    $(this).addClass('is-animated');
                }
            });
        });
    }
    $(window).trigger('scroll');
  });

  $('.leftAnime').each(function(){ 
    var elemPos = $(this).offset().top-50;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight){
      $(this).addClass("slideAnimeLeftRight");
      $(this).children(".leftAnimeInner").addClass("slideAnimeRightLeft");
    }else{
      $(this).removeClass("slideAnimeLeftRight");
      $(this).children(".leftAnimeInner").removeClass("slideAnimeRightLeft");
      
    }
  });

  $(function() {
    const targets = $('.anime_zoom_merit');
    if(!targets.length) return;

    $(window).scroll(function () {
        const slideBorder = $(this).scrollTop() + ($(this).outerHeight() * 0.7);
        targets.each(function() {
            if(slideBorder > $(this).offset().top) {
                $(this).addClass('active');
            }
        });
    });
  });

  /*-------------------------------------------*/
  /* ポップアップ
  /*-------------------------------------------*/
  // デフォルト
  $(document).on('click','.modal_trigger', function(){
    var modal_box = $(this).next('.modal_box');
    modal_box.fadeIn(); // モーダルを表示する
    $('body').addClass('overflow-hidden');
  });

  // ポップアップを閉じる
  $(document).on('click','.modal_close , .modal_bg', function(){
    $('.modal_box').fadeOut(); // モーダルを非表示にする
    $('body').removeClass('overflow-hidden');
  });
  $(document).on('click','.js-modal_trigger', function(){
    var modal_box = $(this).next('.js-modal_box');
    modal_box.fadeIn(); // モーダルを表示する
    $('body').addClass('overflow-hidden');
  });
  $(document).on('click','.js-modal_close , .js-modal_bg', function(){
    $('.js-modal_box').fadeOut(); // モーダルを非表示にする
    $('body').removeClass('overflow-hidden');
  });

  // メニュー用
  $(document).on('click','#js-sitemap_trigger', function(){
    $('#js-sitemap_modal').fadeIn();
    $('body').addClass('overflow-hidden');
  });
  $(document).on('click','#js-search_trigger', function(){
    $('#js-search_modal').fadeIn();
    $('body').addClass('overflow-hidden');
  });
  $(document).on('click','#js-search_trigger_pc', function(){
    $('#js-search_modal_pc').fadeIn();
    $('body').addClass('overflow-hidden');
  });

  /*-------------------------------------------*/
  /* アコーディオン
  /*-------------------------------------------*/
  // 上から下へ表示
  $('.acor-menu').on('click', function() {
    $(this).toggleClass('open');
    $(this).next('.acor-menu-child').slideToggle();
  });

  /*-------------------------------------------*/
  /* アーカイブ ページネーション
  /*-------------------------------------------*/
  if ($('.pnavi').length) {
    $("a.page-numbers").each( function(index, element) {
        var pageNumbers = $(element).attr('href');
        if (pageNumbers == '') {
          $(element).attr('href', location.pathname);
        }
    });
  }

  /*-------------------------------------------*/
  /* SPメニュー
  /*-------------------------------------------*/
  $('.js-menu_child_open').on('click', function(event) {
    event.preventDefault();
    $(this).toggleClass('js-open');
    $(this).next('.js-menu_child').toggleClass('js-open');
  });
  $('.js-ac-parent-left').on('click', function() {
    $(this).parent().toggleClass('js-open');
    $(this).toggleClass('js-open');
    $(this).next('.js-ac-child-left').toggleClass('js-open');
  });

  if (window.matchMedia('(min-width:768px)').matches) {
    $('.nav-page_link').addClass('open');
    $('.nav-page_link__btn').addClass('open');
    $('.nav-page_link__btn').next('.ac-child-left').addClass('open');
  }  
  $(window).scroll(function () {
    var scrollAmount = $(window).scrollTop();
    if (scrollAmount > 0) {
      $('body').addClass('scrolled');
      $('.nav-page_link').removeClass('open');
      $('.nav-page_link__btn').removeClass('open');
      $('.nav-page_link__btn').next('.ac-child-left').removeClass('open');
    } else {
      $('body').removeClass('scrolled');
    }
  });
  $('.ac-parent-left').on('click', function() {
    $(this).parent().toggleClass('open');
    $(this).toggleClass('open');
    $(this).next('.ac-child-left').toggleClass('open');
  });

  // アニメーション
  document.addEventListener('DOMContentLoaded', () => {
    const ioTargets = document.querySelectorAll('.ms-lines[data-io]');

    if (!('IntersectionObserver' in window)) {
      document.querySelectorAll('.ms-lines, .slideup-fade').forEach(el => el.classList.add('is-in'));
      return;
    }

    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          const container = e.target;
          container.classList.add('is-in');

          const delays = [...container.querySelectorAll('.ms-line')].map(line => {
            return parseInt(getComputedStyle(line).getPropertyValue('--d') || '0', 10);
          });
          const maxDelay = delays.length ? Math.max(...delays) : 0;
          const extra = 1000;

          const ctas = container.parentElement.querySelectorAll('.slideup-fade');
          setTimeout(() => {
            ctas.forEach((cta, i) => {
              setTimeout(() => {
                cta.classList.add('is-in');
              }, i * 120);
            });
          }, maxDelay + extra);

          io.unobserve(container);
        }
      });
    }, { threshold: .3 });

    ioTargets.forEach(el => io.observe(el));
  });

});
