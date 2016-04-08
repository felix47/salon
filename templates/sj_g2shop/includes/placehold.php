<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
global $is_placehold;
global $placehold_size;
// Array param for cookie

$placehold_size = array (
	'article' => '800x474',
	'listing' => '390x230',
	'slideshow' => '1150x450',
	'shipping_blog' => '84x84',
	'related_items' => '84x84'

);

$is_placehold = 1;

if (!function_exists ('yt_placehold') ) {
	function yt_placehold ($size = '100x100',$icon='0xe942', $alt = '', $title = '' ) {
		return '<img src="http://placehold.it/'.$size.'" alt = "'. $alt .'" title = "'. $title .'"/>';
		//return '<img src="http://placehold.net/'.$size.'" alt = "'. $alt .'" title = "'. $title .'"/>';
		
		
	}
}
?>