<?php
/*------------------------------------------------------------------------
 # Sj Dynamic Slideshow
 * @version 1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 */
defined('_JEXEC') or die;

JHtml::stylesheet('modules/'.$module->module.'/assets/css/sj-dynamicslideshow.css');
JHtml::stylesheet('modules/'.$module->module.'/assets/css/sj-dynamicslideshow-settings.css');
if( !defined('SMART_JQUERY') && $params->get('include_jquery', 0) == "1" ){
	JHtml::script('modules/'.$module->module.'/assets/js/jquery-1.8.2.min.js');
	JHtml::script('modules/'.$module->module.'/assets/js/jquery-noconflict.js');
	define('SMART_JQUERY', 1);
}
JHtml::script('modules/'.$module->module.'/assets/js/jquery.themepunch.plugins.min.js');
JHtml::script('modules/'.$module->module.'/assets/js/jquery.themepunch.revolution.js');
$suffix = rand().time();
$tag_id = 'dynamicslideshow_'.$suffix;
if( $params->get('pause') == 1 ){
	$hover = 'on';
}else {
	$hover = 'off';
} ?>
<?php //var_dump($params->get('slider1'));die;?>
<link href='http://fonts.googleapis.com/css?family=Share' rel='stylesheet' type='text/css' />
	<?php if( $params->get('pretext') != "" ) { ?>
		<div class="pre-text"><?php echo $params->get('pretext'); ?></div>
	<?php } ?>
	<div class="dynamicslideshow-container" id="<?php echo $tag_id;?>">
		<div class="dynamicslideshow">
			<ul>
				<?php if( $params->get('slider1') !=""){
					echo $params->get('slider1');
				}
				if( $params->get('slider2') !=""){
					echo $params->get('slider2');
				}
				if( $params->get('slider3') !=""){
					echo $params->get('slider3');
				}
				if( $params->get('slider4') !=""){
					echo $params->get('slider4');
				}
				if( $params->get('slider5') !=""){
					echo $params->get('slider5');
				}
				if( $params->get('slider6') !=""){
					echo $params->get('slider6');
				}
				if( $params->get('slider7') !=""){
					echo $params->get('slider7');
				}
				if( $params->get('slider8') !=""){
					echo $params->get('slider8');
				}
				if( $params->get('slider9') !=""){
					echo $params->get('slider9');
				}
				if( $params->get('slider10') !=""){
					echo $params->get('slider10');
				}?>
			</ul>
			<div class="tp-bannertimer <?php if( $params->get('timer_position') == "under" ){ echo " tp-bottom";}?>"></div>
		</div>
	</div>
	<?php if( $params->get('posttext') != "" ) {  ?>
		<div class="post-text"><?php echo $params->get('posttext'); ?></div>
	<?php }?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	//jQuery(window).load(function() {
	if ($.fn.cssOriginal!=undefined)
		$.fn.css = $.fn.cssOriginal;
	$('#<?php echo $tag_id;?> > .dynamicslideshow').revolution(
		{
			delay:<?php echo $params->get('interval');?>,
			startheight:500,
			startwidth:960,
			hideThumbs:200,
			thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
			thumbHeight:50,
			thumbAmount:5,
			navigationType:"<?php echo $params->get('shownavigation');?>",				// bullet, thumb, none
			navigationArrows:"<?php echo $params->get('navigationArrows');?>",			// nexttobullets, solo (old name verticalcentered), none
			navigationStyle:"<?php echo $params->get('button_style');?>",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item),
			navigationHAlign:"<?php echo $params->get('navigationhalign');?>",				// Vertical Align top,center,bottom
			navigationVAlign:"<?php echo $params->get('navigationvalign');?>",					// Horizontal Align left,center,right
			navigationHOffset:0,
			navigationVOffset:20,
			soloArrowLeftHalign:"left",
			soloArrowLeftValign:"center",
			soloArrowLeftHOffset:20,
			soloArrowLeftVOffset:0,
			soloArrowRightHalign:"right",
			soloArrowRightValign:"center",
			soloArrowRightHOffset:20,
			soloArrowRightVOffset:0,
			touchenabled:"on",						// Enable Swipe Function : on/off
			onHoverStop:"<?php echo $hover;?>",						// Stop Banner Timet at Hover on Slide on/off
			stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
			stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
			hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
			hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
			hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value
			shadow:0,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
			fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus			
		});
});
</script>
