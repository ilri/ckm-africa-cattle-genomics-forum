jQuery(function ($) {

  // Hack to auto select the comments filter
	$(document).ready(function(){
		$("#activity-filter-by").val("new_blog_comment").trigger("change");
	});

	// Hack to auto register user to ACGF conference
	var userId = $("img.avatar").length ? parseInt($("img.avatar").attr("class").match(/\d+/)[0]) : null;
	if(userId){
			meta.save_data('conference' , 'guests' , 42 , [ { 'name' : 'guests[idrecord][]' , 'value' : userId }] , '.--' );
	}

});
