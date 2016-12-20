function gallery() {
	var firstSlide = jQuery('#gallery-main ul li:first');
	var lastSlide = jQuery('#gallery-main ul li:last');
	var firstNav = jQuery('#gallery-thumbs ul li:first');
	var lastNav = jQuery('#gallery-thumbs ul li:last');
	
	/*function cycleSlides() {
		var nextSlide, selectedSlide = jQuery('#gallery-main ul li.active');
    	next = selectedSlide.next('li').length ? selectedSlide.next('li') : firstSlide;
		selectedSlide.removeClass('active');
    	next.addClass('active');
	}
	
	function cycleNav() {
		var nextNav, selectedNav = jQuery('#gallery-thumbs ul li.active');
    	next = selectedNav.next('li').length ? selectedNav.next('li') : firstNav;
		selectedNav.removeClass('active');
    	next.addClass('active');
	}
	
	var timerSlides = setInterval(cycleSlides, 8000);
	var timerNav = setInterval(cycleNav, 8000);*/
	
	function nextImage() {
		var nextSlide, selectedSlide = jQuery('#gallery-main ul li.active');
		var nextNav, selectedNav = jQuery('#gallery-thumbs ul li.active');
		nextSlide = selectedSlide.next('li').length ? selectedSlide.next('li') : firstSlide;
		nextNav = selectedNav.next('li').length ? selectedNav.next('li') : firstNav;
		selectedSlide.removeClass('active');
		nextSlide.addClass('active');
		selectedNav.removeClass('active');
		nextNav.addClass('active');
		/*clearInterval(timerSlides);
		clearInterval(timerNav);
		timerSlides = setInterval(cycleSlides, 8000);
		timerNav = setInterval(cycleNav, 8000);*/
		return false;
	}
	
	function prevImage() {
		var prevSlide, selectedSlide = jQuery('#gallery-main ul li.active');
		var prevNav, selectedNav = jQuery('#gallery-thumbs ul li.active');
		prevSlide= selectedSlide.prev('li').length ? selectedSlide.prev('li') : lastSlide;
		prevNav= selectedNav.prev('li').length ? selectedNav.prev('li') : lastNav;
		selectedSlide.removeClass('active');
		prevSlide.addClass('active');
		selectedNav.removeClass('active');
		prevNav.addClass('active');
		/*clearInterval(timerSlides);
		clearInterval(timerNav);
		timerSlides = setInterval(cycleSlides, 8000);
		timerNav = setInterval(cycleNav, 8000);*/
		return false;
	}
	
	jQuery('#gallery-thumbs ul li a').click(function() {
		var position = jQuery( '#gallery-thumbs ul li a' ).index(this);
		jQuery( '#gallery-main ul li' ).removeClass('active');
		jQuery( '#gallery-main ul li' ).eq(position).addClass('active');
		jQuery('#gallery-thumbs ul li').removeClass('active');
		jQuery(this).parent().addClass('active');
		/*clearInterval(timerSlides);
		clearInterval(timerNav);
		timerSlides = setInterval(cycleSlides, 8000);
		timerNav = setInterval(cycleNav, 8000);*/
		return false;
	});
	
	jQuery('#gallery-main #next').bind('click', nextImage);
	jQuery('#gallery-main #prev').bind('click', prevImage);
	
	// TOUCHSWIPE FUNCTIONALITY
	jQuery("#gallery-main ul li").swipe( {
		//Generic swipe handler for all directions
		swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
			//alert("You swiped " + direction );	
			if(direction === 'left') {
				nextImage();
			} else if(direction === 'right') {
				prevImage();
			} /*else if(direction === 'up' || direction === 'down') {
				return false;
			}*/
		},
		//Default is 75px, set to 0 for demo so any distance triggers swipe
	   threshold:0,
	   triggerOnTouchEnd: true,
	   allowPageScroll:"vertical"
	});
}

jQuery(window).load(function() {
	jQuery('#gallery-main').imagefill();
	jQuery('#gallery-main ul li').first().addClass('active');
	jQuery('#gallery-thumbs').addClass('active');
	jQuery('#gallery-thumbs ul li').first().addClass('active');
	gallery();
})