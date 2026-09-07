$(function() {

	$('a[href=#]').click(function(e){
		e.preventDefault();
	})

	// biggerlink
	$('.top_works_in').biggerlink();
	
	// matchHeight
	$('.top_works_in dt').matchHeight();

    //mainimage
	$('.flexslider').flexslider({
		animation: "fade",
    	slideshowSpeed: 5000,
    	animationDuration: 600,
    	animationSpeed: 1800,
		controlNav:false,
		directionNav:false
	});

	// sp_menu
    var $body = $('body');
	$('#sp_btn a').click(function(event){
		event.preventDefault();
        $body.toggleClass('open');
		$('#panel-btn-icon').toggleClass('close');
		return false;
	});

	// fullPage
	init();
	
	function init(){
		$('#fullpage').fullpage({
			navigation: true,
			navigationPosition: 'left',
			scrollingSpeed: 1000,
			scrollOverflow: true,
			verticalCentered: false
		});
	}
	
	$(window).on('resize', function () {
		$.fn.fullpage.destroy('all');
		
		init();
	});

});
