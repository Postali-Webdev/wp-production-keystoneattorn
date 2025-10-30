// These are the scripts that run sliders on Interior pages
	var $j = jQuery.noConflict();
	(function($) {
 	$(function() {
	$(document).ready(function() {		

//Makes our pretty slider work
jQuery(document).ready(function(){
    jQuery('.practice_area_tabs .practice_area_tabs_nav a').on('click', function(e){
    	var currentAttrValue = jQuery(this).attr('href');

        $('.practice_area_tabs ' + currentAttrValue).show();
    		$('.practice_area_tabs ' + currentAttrValue).animate({opacity:1}, 0).addClass('active'); 
    		$('.practice_area_tabs ' + currentAttrValue).siblings().css({opacity:0}).hide().removeClass('active');	
    		
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
    		
    	e.preventDefault();
    });
});
		
// Smooth Scroll button 
smoothScroll.init({
	selector: '[data-scroll]',
	selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
	speed: 800, // Integer. How fast to complete the scroll in milliseconds
	easing: 'easeInOutCubic', // Easing pattern to use
	offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
});
	
		
	});
	});
	})(jQuery);