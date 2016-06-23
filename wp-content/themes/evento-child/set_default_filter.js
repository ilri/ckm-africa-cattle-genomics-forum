jQuery(function ($) {

  // Hack to auto select the comments filter
	$(document).ready(function(){
		$("#activity-filter-by").val("new_blog_comment").trigger("change");
	});

});
