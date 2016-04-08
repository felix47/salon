jQuery(document).ready(function($){
	tiles = $("#bd img").fadeTo(0, 0);
	
	function fade_img(){
		tiles.each(function(i) {
			a = $(this).offset().top + $(this).height();
			b = $(window).scrollTop() + $(window).height();
			if (a < b) $(this).fadeTo('fast',1);
		});
	}
	
	$(window).load(function(d,h){
		fade_img();
	});
	
	$(window).scroll(function(d,h) {
		fade_img();
	});


});