(function(){

	$(function(){
		$('a[href=#]').click(function(e){
			e.preventDefault();
		})
	});

	//2回タップ
	$(function(){
		var $w = $(window), $target = $('a');
		$target.on('touchstart', function(){
			var $this = $(this), isScrolling = false;
			$w.on('scroll', function(){
				isScrolling = true;
			});
			$this.on('touchend', function(){
				if(!isScrolling){
					var url = $this.find('a').attr('href');
					if(url){
						window.location.href = url;
					}
				}
				isScrolling = false;
				$this.off('touchend');
			});
		});
	});

	//スマホ用メニュー
	$(function(){
		$('#gnav_btn').on('click',function(){
			if($(this).hasClass('is-opened')){
				$(this).removeClass('is-opened');
				$(this).addClass('is-closed');
			}else{
				$(this).addClass('is-opened');
				$(this).removeClass('is-closed');
			}
			if($('body').hasClass('open')){
				$('body').removeClass('open');
			}else{
				$('body').addClass('open');
			}
		});
	});

	// PC用サイド固定
	$(function(){

		$(window).on('load scroll', function(){
		    var fixed = $('.side-fixed-area').offset().top;
		    var footer = $('#footer').offset().top-600;
		    var windowScrollTop = $(window).scrollTop();
		    var footerArea = windowScrollTop > footer;
		    var beforeFixedArea = windowScrollTop < fixed;
		    var fixedArea = windowScrollTop > fixed;
		    
		    if( footerArea || beforeFixedArea ) {
		      $('.side_in').removeClass('side-fixed-content');
		    } else if ( fixedArea ) {
		      $('.side_in').addClass('side-fixed-content');
		    }
		});
		
		$(window).on('load resize', function(){
		    var win = $(window).width();
		 	if(win < 1200){
		      $('.side_in').removeClass('side-fixed-content');
		 	}
		});
	});

	function detectSticky() {
	  const div = document.createElement('div');
	  div.style.position = 'sticky';
	  return div.style.position.indexOf('sticky') !== -1;
	}

	function callStickyState() {
	  return new StickyState(document.querySelectorAll('.side_in'));
	}

	if (!detectSticky()) {
	  callStickyState();
	}

})(jQuery);
