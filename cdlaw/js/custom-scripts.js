// These are the scripts that make the Site work
	var $ = jQuery.noConflict();
	(function($) {
 	$(function() {
	$(document).ready(function() {
				
// Add additional class for sidebar links
    jQuery(document).ready(function($){
        // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
        var url = window.location.href;
        $('.widget_recent_entries a[href="'+url+'"]').closest('li').addClass('current-menu-item');
    });		
		
		
// Sticky Mobile Contact bar on initial scroll
$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y >= 100) {
     $("#mobile_contact_bar").css("opacity", "1"),
	 $("#mobile_contact_bar").css("bottom", "-1px"); 
  } else {
     $("#mobile_contact_bar").css("opacity", "0"),
	 $("#mobile_contact_bar").css("bottom", "-100px"); 
  }
});		
		
		
// Remove Mobile Sticky Contact bar when user hits bottom
window.onscroll = function() {
    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
        $("#mobile_contact_bar").css("opacity", "0");
    }
};


// updated mobile navigation
	$("#menu-icon").bind("click", function(e) {
  var body = $("html");
  e.preventDefault();
  if (body.hasClass("nav-open")) {
    body.removeClass("nav-open");
    $("#mobile-nav li.menu-item-has-children > a, .sub-menu").removeClass("open");
  } else {
    e.stopPropagation();
    body.one("click", function() {
      body.removeClass("nav-open");
      $("#mobile-nav, #menu-icon").removeClass("active");
      $("#mobile-nav li.menu-item-has-children > a, #mobile-nav li.menu-item-has-children > .sub-menu").removeClass("open");
    }).addClass("nav-open");
  }
});
$("#mobile-nav").bind("click", function() {
  event.stopPropagation();
});
$("#menu-icon").on("click", function() {
  $("#mobile-nav, #menu-icon").toggleClass("active");
  event.preventDefault();
});

$(".icon-icon-close").on("click", function() {
    $(".contact-us-popup").addClass("closed");
    event.preventDefault();
  });

$('#mobile-nav li.menu-item-has-children > a').click(function(e){
  e.preventDefault();
  $(this).toggleClass('open');
  $(this).siblings('.sub-menu').toggleClass('open');
});

// $('#mobile-nav li.menu-item-has-children > a').one('click', function(event) {
//     event.preventDefault();
//     $(this).next('.sub-menu').addClass('open');
// });

    // open submenu when user tabs into it
    $('.menu-item-has-children').on('focusin', function() {
      var subMenu = $(this).find('.second');
      subMenu.css({'display' : 'block', 'opacity' : '1', 'height' : 'auto', 'visibility' : 'visible'});
      // removes dropdown when tabbed away from last element in submenu
      $(this).find('.second li:last-child').on('focusout', function() {
          subMenu.removeAttr('style') 
      });
      // removes dropdown on reverse tabbing
      $(this).on('focusout', function(e) {
          $(this).on('keydown', function(e) {
              if( e.shiftKey && $(e.target).siblings().hasClass('second') ) {
                  subMenu.removeAttr('style')
              }
          });
      })
    })
    //keep third level menu open on tab
    $('.menu-item-has-children .second .menu-item-has-children').on('focusin', function() {
      var subMenu = $(this).find('> ul');
      subMenu.css({'display' : 'block', 'opacity' : '1', 'height' : 'auto', 'visibility' : 'visible'});
      // removes dropdown when tabbed away from last element in submenu
      $(this).find('li:last-child').on('focusout', function() {
          subMenu.removeAttr('style') 
      });
      // removes dropdown on reverse tabbing
      $(this).on('focusout', function(e) {
          $(this).on('keydown', function(e) {
              if( e.shiftKey && $(e.target).siblings().is('ul') ) {
                  subMenu.removeAttr('style')
              }
          });
      })
    });
	
	});
	});
	})(jQuery);