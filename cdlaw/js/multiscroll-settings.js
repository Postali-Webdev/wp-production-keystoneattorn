// Fullpage and Multipage JS
	var $j = jQuery.noConflict();
	(function($) {
 	$(function() {
	$(document).ready(function() {  

	
           $('#multiscroll').multiscroll({
				scrollingSpeed: 600,
            	anchors: ['first', 'second', 'third'],
           	menu: '#practice_area_menu',
            	navigation: true,
            	navigationTooltips: ['One', 'Two', 'Three'],
            	loopBottom: true,
            	loopTop: true,
				paddingTop: '120px',
				paddingBottom: '200px',
            });
		
    });
	});
	})(jQuery);		