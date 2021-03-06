jQuery(document).ready(function(){
	

	/* initialize tabs */
	jQuery('.cosmo-tabs').each(function(){
		// Set default active classes
		jQuery(this).find('.tabs-container').not(':first').css('display','none');
		jQuery(this).find('ul li:first').addClass('tabs-selected');

		jQuery(this).find('ul li a').click(function(){
				if( jQuery(this).parent().hasClass('tabs-selected') ){
				return false;
			}
			var tabId = jQuery(this).attr('href');

			// We clear all active clasees
			jQuery(this).parent().parent().find('.tabs-selected').removeClass('tabs-selected');


			jQuery(this).parent().addClass('tabs-selected');
			jQuery(this).parents('.cosmo-tabs').find('.tabs-container').not(tabId).css('display','none');
			jQuery(this).parents('.cosmo-tabs').find(tabId).css('display','block');
			return false;
		})

	});


  	/*toogle*/
  	/*Case when by default the toggle is closed */
	jQuery('.open_title').click(function(){
		if (jQuery(this).find('a').hasClass('show')) {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close'); 
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		} else {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});
  
  	/*Case when by default the toggle is oppened */
	jQuery('.close_title').click(function(){
		if (jQuery(this).find('a').hasClass('hide')) {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		} else {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close');
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});
	
	/*Accordion*/
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	});
	
	
	//Fixed social media sharing
	jQuery(function () {
		var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
		if (!msie6 && jQuery('.share_buttons_single_page').length != 0) {
			var top = jQuery('#share_buttons_single_page').offset().top - parseFloat(jQuery('#share_buttons_single_page').css('margin-top').replace(/auto/, 0));
			jQuery(window).scroll(function (event) {
				// what the y position of the scroll is
				var y = jQuery(this).scrollTop();
				// whether that's below the form
				if (y >= top-90) {
					// if so, ad the fixed class
					jQuery('#share_buttons_single_page').addClass('fixed');
				} else {
					// otherwise remove it
					jQuery('#share_buttons_single_page').removeClass('fixed');
				}
			});
		}
	});

	//Comment form
	jQuery('#toggle_link').click(function(event){
		jQuery("#commentform").slideToggle("fast");
		event.preventDefault();
	});

	jQuery('.comment-reply-link').click(function() {
		jQuery("#commentform").show("fast");
	});
	
	/*scrol the window to make the entire reply visible*/
	var offset = jQuery('#toggle_link').offset();

	jQuery('#toggle_link').click(function() {
		jQuery('body,html').animate({scrollTop:offset.top},300);
	});
	
	function getInternetExplorerVersion()
	// Returns the version of Internet Explorer or a -1
	// (indicating the use of another browser).
	{
	  var rv = -1; // Return value assumes failure.
	  if (navigator.appName == 'Microsoft Internet Explorer')
	  {
		var ua = navigator.userAgent;
		var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null)
		  rv = parseFloat( RegExp.$1 );
	  }
	  return rv;
	}
	
	var ver = getInternetExplorerVersion();
	
	if(ver == -1 || ver > 8.0){
		//Fade menu
		jQuery(function() {
			jQuery(".cosmo-social a").css("opacity","0.5");
			jQuery(".cosmo-social a").hover(function () {
				jQuery(this).stop().animate({
				opacity: 1.0
				}, 300 );
			},
			function () {
				jQuery(this).stop().animate({
					opacity: 0.5
				}, 300 );
			});
		});

		jQuery(function() {
			jQuery(".hover, ul.cosmo-menu li a").css("opacity","1");
			jQuery(".hover, ul.cosmo-menu li a").hover(function () {
				jQuery(this).stop().animate({
				opacity: 0.7
				}, 300);
			},
			function () {
				jQuery(this).stop().animate({
					opacity: 1
				}, 300);
			});
		});
	}	

	//Mosaic fade
	jQuery('.readmore, .circle, .gallery-icon').mosaic({
		opacity:	0.7
	});
	jQuery('.fade').mosaic({
		animation:	'slide'		//fade or slide
	});

	//Back to top
	jQuery('.backtotop').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
	});

	//Superfish menu
	jQuery("ul.sf-menu").supersubs({
			minWidth:    12,
			maxWidth:    32,
			extraWidth:  1
		}).superfish({
			delay: 200,
			speed: 250
		});

	//Cosmo-sharing
	jQuery(function(){
		jQuery('.cosmo-sharing').mobilyblocks({
			trigger: 'click',
			direction: 'clockwise',
			duration:500,
			zIndex:50,
			widthMultiplier:1.7
		});
		
	});

	//Tooltips
	jQuery(function() {
        jQuery('.tooltip').tipsy({gravity: jQuery.fn.tipsy.autoNS});
      });
	
	//twitter widget
	if (jQuery().slides) { 
		jQuery(".dynamic .cosmo_twitter").slides({
			play: 5000,
			effect: 'fade',
			generatePagination: false,
			autoHeight: true
		});	
		
	}

	
	/*adjust width for post image that contains caption*/
	jQuery('[id^="attachment_"]').each(function(index) {
	    var div_width = jQuery(this).css('width').split('px');
	    var new_div_width = eval(parseInt(div_width[0]) + parseInt(10)); 
	    jQuery(this).css('width',new_div_width + 'px');
	});
});