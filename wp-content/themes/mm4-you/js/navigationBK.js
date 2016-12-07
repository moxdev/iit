jQuery(window).load(function(e) {
	//console.log('Ready to go!');
	
	// MENU TOGGLING
	jQuery('.menu-toggle').on('click', function () {
		if(jQuery(this).hasClass('open')) {
			var t = setTimeout(function() {
				jQuery('.main-navigation').toggleClass('open');
			}, 1000);
			
			jQuery(this).toggleClass('open');
    		jQuery('#masthead').toggleClass('open');
			jQuery('#smooth-scroll-wrap').toggleClass('open');
		} else {
			jQuery(this).toggleClass('open');
    		jQuery('#masthead').toggleClass('open');
			jQuery('#smooth-scroll-wrap').toggleClass('open');
			jQuery('.main-navigation').toggleClass('open');
		}
	});
	
	jQuery('#smooth-scroll-wrap').click(function () {
		if(jQuery(this).hasClass('open')) {
			jQuery(this).toggleClass('open');
			jQuery('#masthead').toggleClass('open');
			jQuery('.menu-toggle').toggleClass('open');
			var t = setTimeout(function() {
        		jQuery('.main-navigation').toggleClass('open');
    		}, 1000);
		}
	});
	
	// CLONE OUR SOCIAL MEDIA LINKS
	var socialMediaWrap = jQuery('<div>', {id: 'social-media-flyout'});
	var socialMediaUl = jQuery('<ul>', {class: 'social'});
	jQuery('#site-navigation').prepend(socialMediaWrap);
	jQuery(socialMediaWrap).prepend(socialMediaUl);
	
	var socialContent = jQuery('#masthead .social').html();
	jQuery(socialMediaUl).append(socialContent);
	
	// CLONE OUR AUX NAV
	var auxNavUl = jQuery('<ul>', {class: 'aux'});
	jQuery('#site-navigation').append(auxNavUl);
	
	var auxNavContent = jQuery('#menu-aux-menu').html();
	jQuery(auxNavUl).append(auxNavContent);
	
	// TOGGLE  JOB OPENINGS
	jQuery('.page-id-2018 #job-toggle').on('click', function () {
		var text = jQuery(this).text();
    	jQuery('#job-listing').toggleClass('open');
		jQuery(this).toggleClass('open');
	});
	
	// HOME PORTFOLIO
	if( jQuery( '#home-portfolio-list li' ).first().hasClass('active') && jQuery("#home-portfolio-list li").length > 1) {
		jQuery('#scr-right').addClass('active');
	}
	
	jQuery('#scr-right').click(function() {
		var classItem = jQuery( '#home-portfolio-list li.active');
		jQuery(classItem).removeClass('active');
		jQuery(classItem).next('li').addClass('active');
		
		if( jQuery( '#home-portfolio-list li' ).last().hasClass('active') ) {
			jQuery(this).removeClass('active');
			jQuery('#scr-left').addClass('active');
		} else if( jQuery( '#home-portfolio-list li' ).first().hasClass('active') ) {
			jQuery(this).addClass('active');
			jQuery('#scr-left').removeClass('active');
		} else {
			jQuery(this).addClass('active');
			jQuery('#scr-left').addClass('active');
		}
	})
	
	jQuery('#scr-left').click(function() {
		var classItem = jQuery( '#home-portfolio-list li.active');
		jQuery(classItem).removeClass('active');
		jQuery(classItem).prev('li').addClass('active');
		
		if( jQuery( '#home-portfolio-list li' ).last().hasClass('active') ) {
			jQuery(this).addClass('active');
			jQuery('#scr-right').removeClass('active');
		} else if( jQuery( '#home-portfolio-list li' ).first().hasClass('active') ) {
			jQuery(this).removeClass('active');
			jQuery('#scr-right').addClass('active');
		} else {
			jQuery(this).addClass('active');
			jQuery('#scr-right').addClass('active');
		}
	})
})