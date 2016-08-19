jQuery(function ($) {

  // Hack to auto select the comments filter
	$(document).ready(function(){
		$("#activity-filter-by").val("new_blog_comment").trigger("change");

		$("div.cosmo-comment-quote>p").each(function(){
		  var text = $(this).text();

		  if(text.length> 750){
		    var firstPart = text.substring(0, 750);
				var secondPart = text.substring(750, text.length - 1);
		    $(this).html(firstPart +"<a class='more-link' href='#'> Read More ...</a> <span class='second-part'>"+ secondPart +"<a class='less-link' href='#'> ... Read Less</a> </span>");
		  }

			$("a.more-link").live("click", function(e){
				e.preventDefault();
				$(this).next(".second-part").slideDown();
				$(this).hide();
			});

			$("a.less-link").live("click", function(e){
				e.preventDefault();
				var secondPart = $(this).parent();
				secondPart.slideUp();
				secondPart.prev(".more-link").show();
			});

		});
	});

	// Hack to auto register user to ACGF conference
	var userId = $("img.avatar").length ? parseInt($("img.avatar").attr("class").match(/\d+/)[0]) : null;
	if(userId){
			meta.save_data('conference' , 'guests' , 42 , [ { 'name' : 'guests[idrecord][]' , 'value' : userId }] , '.--' );
	}

});
