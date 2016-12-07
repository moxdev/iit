jQuery(window).load(function(e) {
	//console.log('Ready to go!');
	var x = 0;
	
	// CREATE A PLACE FOR OUR MOBILE MENU
	var mobileMenu = jQuery('<div>', {id: 'mobile-menu'});
	jQuery(mobileMenu).css('visibility', 'hidden');
	jQuery(mobileMenu).css('display', 'none');
	jQuery('body').append(mobileMenu);
	
	// CLONE OUR MAIN NAV AND ADD TO MOBILE MENU
	var mainNavUl = jQuery('<ul>', {id: 'mobile-main-nav'});
	jQuery(mobileMenu).append(mainNavUl);
	
	var mainNavContent = jQuery('#primary-menu').html();
	jQuery(mainNavUl).append(mainNavContent);
	
	// CLONE OUR AUX NAV AND ADD TO MOBILE MENU
	var auxNavUl = jQuery('<ul>', {id: 'mobile-aux-nav'});
	jQuery(mobileMenu).append(auxNavUl);
	
	var auxNavContent = jQuery('#aux-menu').html();
	jQuery(auxNavUl).append(auxNavContent);
	
	// CLONE OUR FOOTER NAV AND ADD TO MOBILE MENU
	var footerNavUl = jQuery('<ul>', {id: 'mobile-footer-nav'});
	jQuery(mobileMenu).append(footerNavUl);
	
	var footerNavContent = jQuery('#footer-menu').html();
	jQuery(footerNavUl).append(footerNavContent);
	
	// ADD ARIA CONTROLS TO MENU TOGGLE (This is untested with screen readers)
	jQuery('.menu-toggle').attr('aria-controls','mobile-menu');
	
	// MENU TOGGLING
	jQuery('.menu-toggle').on('click', function () {
		if( jQuery(this).hasClass('open') ) {
			jQuery(this).toggleClass('open');
    		jQuery('#page').toggleClass('open');
			jQuery(mobileMenu).toggleClass('open');
			setTimeout(function() {
				jQuery(mobileMenu).css('visibility', 'hidden');
				jQuery(mobileMenu).css('display', 'none');
				jQuery(mobileMenu).css('z-index', '-1');
			}, 500);
		} else {
			jQuery(this).toggleClass('open');
    		jQuery('#page').toggleClass('open');
			jQuery(mobileMenu).toggleClass('open');
			jQuery(mobileMenu).css('visibility', 'visible');
			jQuery(mobileMenu).css('display', 'block');
			jQuery(mobileMenu).css('z-index', '1');
		}
	});
	
	/*jQuery('#smooth-scroll-wrap').click(function () {
		if(jQuery(this).hasClass('open')) {
			jQuery(this).toggleClass('open');
			jQuery('#masthead').toggleClass('open');
			jQuery('.menu-toggle').toggleClass('open');
			var t = setTimeout(function() {
        		jQuery('.main-navigation').toggleClass('open');
    		}, 1000);
		}
	});*/
})