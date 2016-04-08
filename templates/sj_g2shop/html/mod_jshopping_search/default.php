<script type = "text/javascript">
function isEmptyValue(value){
    var pattern = /\S/;
    return ret = (pattern.test(value)) ? (true) : (false);
}
</script>
<form name = "searchForm" method = "post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit = "return isEmptyValue(jQuery('#jshop_search').val())">

<input type="hidden" name="setsearchdata" value="1">
<input type = "hidden" name = "category_id" value = "<?php print $category_id?>" />
<input type = "hidden" name = "search_type" value = "<?php print $search_type;?>" />
<input type = "text" class = "inputbox" name = "search" id = "jshop_search" value = "<?php print $search?>" placeholder="Поиск ..." />
<button class = "button" type = "submit"><i class="fa fa-search"></i></button>
<?php if ($adv_search) {?>
<br /><a href = "<?php print $adv_search_link?>"><?php print _JSHOP_ADVANCED_SEARCH?></a>
<?php } ?>
</form>

<script type="text/javascript">
jQuery(document).ready(function($) {
	var ua = navigator.userAgent,

	_device = (ua.match(/iPad/i)||ua.match(/iPhone/i)||ua.match(/iPod/i)) ? "smartphone" : "desktop";
	
	if(_device == "desktop") {	
		function _animateDesktop () {
			$('.jshop-search').bind('click', function(){
				var $that = $(this);
					if(!$(this).hasClass('open')){
						$(this).addClass('open');
						$(this).css('width','auto');
						$('.jshop-search .modcontent').stop().slideDown(350);
					}
					else{
						$(this).removeClass('open');
						$('.jshop-search .modcontent').stop().slideUp( 350 , function () {
							$that.css('width','60px');
						});
					}
				
			});
		}
		if($(window).width() <= 767 ) {
			_animateDesktop () ;
		}
	}else{
		$('.jshop-search').bind('touchstart', function(){
			var $that = $(this);
			if(!$(this).hasClass('open')){
				$(this).addClass('open');
				$(this).css('width','auto');
				$('.jshop-search .modcontent').stop(true,true).slideDown(350);
			}
			else{
				$(this).removeClass('open');
				$('.jshop-search .modcontent').stop(true, true).slideUp( 350 , function () {
					$that.css('width','60px');
				});
			}

		});
	
	}
	
	$(window).resize(function () {
		if($(window).width() <= 767 ) {
			_animateDesktop ();
		}	
		else
		{
			$('.jshop-search').unbind('click');
			$('.jshop-search').removeClass('open');
			$('.jshop-search').removeAttr('style');
			$('.jshop-search .modcontent').removeAttr('style');
		}
	});
	
});
</script>