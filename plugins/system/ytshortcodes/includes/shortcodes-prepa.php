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
JLoader::register('ImageHelper', dirname(__FILE__).'/helper_image.php');

# Accordion Block
add_ytshortcode('accordion', 'accordionShortcode');
function accordionShortcode($atts, $content = null){
	$accordion = "<ul class='yt-accordion'>";
	$accordion = $accordion . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content));
	$accordion = $accordion . "</ul>";

	return $accordion;
}

add_ytshortcode('acc_item', 'accItemShortcode');
function accItemShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"title" => ''
	), $atts));

	$acc_item = "<li class='accordion-group'>";
	$acc_item = $acc_item . "<h3 class='accordion-heading'>";
	$acc_item = $acc_item . "<i class='fa fa-plus-circle'></i>";
	$acc_item = $acc_item . $title . "</h3>";
	$acc_item = $acc_item . "<div class='accordion-inner'>" . parse_shortcode($content) . "</div>";
	$acc_item = $acc_item . "</li>";

	return $acc_item;
}


# Block Quote Block
add_ytshortcode('quote', 'blockquoteShortcode');
function blockquoteShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"title" => '',
		"align" => 'none',
		'border'=>'#666',
		'color'=>'#666',
		'width'=>'auto',
	), $atts));
	$source_title = (($title != '') ? "<small>".$title. "</small>" : '');
	return '<blockquote class="yt-boxquote pull-'. $align.'" style="width:'.$width.';border-color:'.$border.';color:'.$color.'">' . parse_shortcode($content) . $source_title. '</blockquote>';
}


# Buttons Block
add_ytshortcode('button', 'buttonShortcode');
function buttonShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type"		=> '',
		"size" 		=> '',
		"full" 		=> '',
		"icon" 		=> '',
		"link" 		=> '#',
		"radius" 	=> '3',
		"target" 	=> '',
		"title"		=> '',
		"position"	=> ''
	), $atts));
	$btn_icon = '<i class="'.(($icon != '') ? 'fa fa-'. $icon : '').'"></i>';

	return '<a class="btn btn-default'.
			(($type != '') ? ' btn-' . $type : '').
			(($size != '') ? ' btn-' . $size : '') .
			(($full != '') ? ' btn-' . $full : '') .
			'" style="border-radius:'.$radius.'px;" href="'.$link.'" target="'.$target.'" data-placement="'.$position.'" title="'.$title.'">'.$btn_icon. $content.'</a>';
}


# Columns Block
add_ytshortcode('columns', 'columnsShortcode');
function columnsShortcode($atts, $content = null ){
	extract(ytshortcode_atts(array(
		"grid" => 'no'
	), $atts));
	
	$show_grid = ($grid =='yes')? 'show-grid':'';
	return '<div class="yt-show-grid row '.$show_grid.' ">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
}

# Column Block
add_ytshortcode('column_item', 'columnItemShortcode');
function columnItemShortcode($atts, $content = null ){
	extract(ytshortcode_atts(array(
		"col" => 4,
		"offset" => '',
	), $atts));
	
	return '<div  class="col-sm-'. $col . (($offset != '') ? ' col-md-offset-' . $offset : '') .'">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
}


# Dropcap Block
add_ytshortcode('dropcap', 'dropcapShortcode');
function dropcapShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" 			=> 'none',
		"color" 		=> '#333',
		"background"	=> 'none'
	), $atts));

	return '<div class="yt-dropcap ' . $type . '" style="color:'. $color .'; background-color:' . $background . ';">' . $content . '</div>';
}


# Gallery Block
$gwidth  = 100;
$gheight = 100;

add_ytshortcode('gallery', 'galleryShortcode');
function galleryShortcode($atts, $content = null){
	global $gwidth, $gheight, $gcolumns;

	extract(ytshortcode_atts(array(
		"title" 	=> '',
		"width"		=> 100,
		"height"	=> 100,
		"columns"	=> 3
	), $atts));

	$gwidth  = $width;
	$gheight = $height;
	$gcolumns = $columns;
	
	$gallery = '';
	$gallery .= '<div class="yt-gallery clearfix">';
	$gallery .= ($title !='')? '<h3 class="gallery-title">' . $title . '</h3>' : '' ;
	$gallery .= '<ul class="gallery-list clearfix">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</ul>';
	$gallery .= '</div>';

	return $gallery;
}

add_ytshortcode('gallery_item', 'galleryItemShortcode');
function galleryItemShortcode($atts, $content = null){
	global $gwidth, $gheight, $gcolumns;
	
	extract(ytshortcode_atts(array(
		"title" => '',
		"src"	=> '',
		"video_addr" => ''
	), $atts));

	if(strpos($video_addr, 'youtube.com')){
		$src_pop = $video_addr;
		if($src=="" || !is_file($src)) $src = 'plugins/system/ytshortcodes/assets/images/youtube.png';
	}elseif(strpos($video_addr, 'vimeo.com')){
		$src_pop = $video_addr;
		if($src=="" || !is_file($src)) $src = 'plugins/system/ytshortcodes/assets/images/vimeo.jpg';
	}else{
		$src_pop = "";
	}
	$src = (is_file($src))?$src:'plugins/system/ytshortcodes/assets/images/nophoto.png';
	//$src = (strpos($src, "http://") === false) ? JURI::base() . $src : $src;
	
	if($src_pop ==""){$src_pop = JURI::base(true).'/'.$src;}
	$small_image = array(
		'width' => $gwidth,
		'height' => $gheight,
		'function' => 'resize',
		'function_mode' => 'fill'
	);
	//var_dump($src);die();
	if($gwidth > 0 && $gwidth!='auto' && $gheight > 0 && $gheight!='auto'){
		$simage = JURI::base().ImageHelper::init($src, $small_image)->src();
	}else{
		$simage = JURI::base().$src;
	}

	$gallery_item = "<li class='masonry-brick'";
	if($gcolumns>0){
		$gallery_item .=" style='width:".  floor(100/$gcolumns)."%;'";
	}
	$gallery_item .=">";
	$gallery_item .="<div class='item-gallery'>";
	$gallery_item .= "<div class='item-gallery-hover'></div>";
	$gallery_item .= "<a title='" . $title . "' href='" . $src_pop . "' data-rel='prettyPhoto[bkpGallery]'>";
	$gallery_item .= "<h3 class='item-gallery-title'>". $title ."</h3><div class='image-overlay'></div>";
	$gallery_item .= "<img src='" .$simage."' title='" . $title . "' alt='" . $title . "' />";
	$gallery_item .= "</a>";
	$gallery_item .= "</div>";
	$gallery_item .= "</li>";

	return str_replace("<br/>", " ", $gallery_item);
}


# Lightbox Block
add_ytshortcode('lightbox', 'lightboxShortcode');
function lightboxShortcode($atts){
	global $index_lightbox;
	extract(ytshortcode_atts(array(
		"src"		=> '#',
		"width"		=> 'auto',
		"height"	=> 'auto',
		"title"		=> '',
		'align'		=> 'none',
		'lightbox'	=> 'on',
		'style'	=> ''
	), $atts));

	$small_image = array(
		'width' => $width,
		'height' => $height,
		'function' => 'resize',
		'function_mode' => 'fill'
	);
	
	if(strpos($src,'http://')!== false){
		$src_thumb = $src; 
	}else if( is_file($src) && strpos($src,'http://')!== true){
		
		$src_thumb = JURI::base().ImageHelper::init($src, $small_image)->src();
		$src = JURI::base().$src;
		
	}/*else if (!is_file($src) && strpos($src,'http://')!== true){
		$src_nophoto ='plugins/system/ytshortcodes/assets/images/nophoto.png';
		$src = JURI::base().ImageHelper::init($src_nophoto, $small_image)->src();
	}*/
	
	$frame = "<img src='". $src_thumb . "' alt='" . $title . "' />";
	$titles = ($title != '') ? "<h3 class='img-title'>". $title ."</h3>" : '';
	$borderinner  = ($style == "borderInner" || $style == "borderinner") ? "<div class='transparent-border'> </div>" : " " ;
	
	if($lightbox == 'On' || $lightbox == 'on') {
		$frame = "<a href='". $src . "' data-rel='prettyPhoto' title='" . $title . "' >" . $frame . $titles. $borderinner. "</a>";
	}
	
	$frame = "<div id='yt-lightbox".$index_lightbox."' class='yt-lightbox curved  image-". $align." ".$style."'>" . $frame . "</div>";
	$index_lightbox ++;
	
	return $frame;
}


# List Block
add_ytshortcode('list', 'listShortcode');
function listShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" => 'check',
		"color" => ''
	), $atts));
	if($color != '') {
		global $list_color;
		$list_color = $color;
	}
	$color =(($color != '')? 'color:'.$color : "");
	return '<ul class="yt-list type-' . $type . '" style="'.$color.'">'. parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</ul>';
}

add_ytshortcode('list_item', 'listItemShortcode');
function listItemShortcode($atts, $content = null ){
	global $list_color;
	extract(ytshortcode_atts(array(
		"offset" => ''
	), $atts));
	if($list_color!=''){
		return '<li ><span>' . $content . '</span></li>';
	}else{
		return '<li >' . $content . '</li>';
	}
}

# List Icons
add_ytshortcode('icon', 'iconShortcode');
function iconShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" => 'fa',
		"name" => 'twitter',
		"size" => '',
		"color" => '',
		"align"=> ''
	), $atts));
	
	$icon_size  =(($size != '')? "font-size:".$size."px;" : "");
	$icon_color =(($color != '')? "color:".$color : "");
	$type_font  =(($type== 'gly')? "glyphicon glyphicon-": "fa fa-");
	return '<i class="'.$type_font.$name." pull-".$align.' " style="'.$icon_size.' ' .$icon_color.'"></i>';
}

# Message Block
add_ytshortcode('message_box', 'messageBoxShortcode');
function messageBoxShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"title" =>'',
		"type" =>'error',
		"close" => "Yes",

	), $atts));

	$message_box = '<div class="alert alert-'.$type.' fade in">';
	$message_box .= ($close == "Yes" || $close == "yes")
				  ? '<button data-dismiss="alert" class="close" type="button"><i class="fa fa-times"></i></button>'
				  : "";
	$message_title=(($title != '')? '<h3 class="alert-heading">' . $title . '</h3>' : "");

	$message_box = $message_box . $message_title;
	$message_box = $message_box . '<div class="alert-content">' . parse_shortcode($content) . '</div>';
	$message_box = $message_box . '</div>';

	return $message_box;
}


# Social Block
add_ytshortcode('social', 'socialShortcode');
function socialShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" 	=> 'facebook',
		"title"	=> '',
		"size"	=> 'default',
		"style"	=> '',
		"color"	=> ''
	), $atts));
	
	
	$social_color=(($color == "Yes" || $color == "yes")? 'color' : "");

	$social = '<div class="yt-socialbt"><a data-placement="top" target="_blank" class="sb '.$type." ". $size."  ".$style." ".$social_color.'" title="' . $title . '" href="' . $content . '">';
	$social = $social . '<i class="fa fa-'.$type.'"></i></a></div>';

	return $social;
}


# Tabs Block
$tab_array = array();
add_ytshortcode('tabs', 'tabShortcode');
function tabShortcode($atts, $content = null){
	global $tab_array;
	global $index_tab;
	extract(ytshortcode_atts(array(
		"style"	=> '',
		"type"	=> ''
	), $atts));

	parse_shortcode($content);
	$tabs_style =(($style != '')? "style-".$style : "");
	$num = count($tab_array);
	$tab = "<div class='yt-tabs ".$tabs_style." ".$type."'><ul class='nav-tabs clearfix'>";

	for($i = 0; $i < $num; $i ++) {
		$active = ($i == 0) ? 'active' : '';
		$tab_id = str_replace(' ', '-', $tab_array[$i]["title"]);

		$tab = $tab . '<li><a href="#' . $tab_id  . $index_tab . '" class="';
		$tab = $tab . $active .'" >' . $tab_array[$i]["title"] . '</a></li>';
	}

	$tab = $tab . "</ul>";
	$tab = $tab . "<div class='tab-content'>";

	for($i = 0; $i < $num; $i ++) {
		$active = ($i == 0) ? 'active' : '';
		$tab_id = str_replace(' ', '-', $tab_array[$i]["title"]);

		$tab = $tab . '<div id="' . $tab_id . $index_tab . '" class="clearfix ';
		$tab = $tab . $active . '" >' . $tab_array[$i]["content"] . '</div>';
	}
	$index_tab ++;
	$tab = $tab . "</div></div>";
	$tab_array= array();
	return $tab;
}
add_ytshortcode('tab_item', 'tabItemShortcode');
function tabItemShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"title" => '',

	), $atts));

	global $tab_array;

	$tab_array[] = array("title" => $title , "content" => parse_shortcode($content));
}


# Testimonial Block
add_ytshortcode('testimonial', 'testimonialShortcode');
function testimonialShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"author" => '',
		"position" => '',
		"avatar" => '',
		"style" => ''
	), $atts));
	
	$testimonial_avatar = '<div class="testimonial-avatar">' ;
	if($avatar != '') {$testimonial_avatar .='<img src="' . $avatar . '"/> ';}
	$testimonial_avatar .= '<small class="testimonial-author">';
	$testimonial_avatar .= '<i class="icon-user"></i>' . $author . ', ';
	$testimonial_avatar .= '<cite class="testimonial-author-position">' . $position . '</cite>';
	$testimonial_avatar .= '</small>';
	$testimonial_avatar .= '</div>';
	$testimonial = '<blockquote class="yt-testimonial '.(($avatar != '')? 'tm-avatar '.$style : " ").'">';
	$testimonial .= '<p>' .$content. '</p>';
	$testimonial .= $testimonial_avatar;
	$testimonial .= '</blockquote>';
	
	return $testimonial;
}


# Toggle Block
add_ytshortcode('toggle_box', 'toggleBoxShortcode');
function toggleBoxShortcode($atts, $content = null){
	$toggle_box = "<ul class='yt-toggle-box'>";
	$toggle_box = $toggle_box . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content));
	$toggle_box = $toggle_box . "</ul>";

	return $toggle_box;
}
add_ytshortcode('toggle_item', 'toggleItemShortcode');
function toggleItemShortcode($atts, $content = null)
{
	extract(ytshortcode_atts(array(
		"title"  => '',
		"icon"  => '',
		"active"  => ''
	), $atts));
	$toggle_active=((strtoupper($active) == 'YES') ? 'active' : '');
	$icon_active=(($icon !='')? '<i class="fa fa-'.$icon.'"></i>' :'');
	
	$toggle_item = "<li class='yt-divider'>";
	$toggle_item = $toggle_item . "<h3 class='toggle-box-head ".$toggle_active."'>";
	$toggle_item = $toggle_item . $icon_active;
	$toggle_item = $toggle_item . "<span></span>"; 
	$toggle_item = $toggle_item . $title . "</h3>";
	$toggle_item = $toggle_item . "<div class='toggle-box-content ".$toggle_active."'>" . parse_shortcode($content) . "</div>";
	$toggle_item = $toggle_item . "</li>";

	return $toggle_item;
}


# Vimeo Block
add_ytshortcode('vimeo', 'vimeoShortcode');
function vimeoShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"height" => '300',
		"width"  => '400',
		"align"  => 'none',
	), $atts));

	preg_match('/http:\/\/vimeo.com\/(\d+)$/', $content, $id);

	$vimeo = '<div class="yt-vimeo pull-'.$align.'" style="max-width:' . $width . 'px;" >';
	$vimeo = $vimeo . '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" frameborder="0" width="' . $width . '" height="' . $height . '" ></iframe>';
	$vimeo = $vimeo . '</div>';

	return $vimeo;
}

# Youtube
add_ytshortcode('youtube', 'youtubeShortcode');
function youtubeShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"height" => '400',
		"width"  => '300',
		"align"  => 'none'
	), $atts));

	preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $content, $id);

	$youtube = '<div class="yt-youtube pull-'.$align.'" style="max-width:' . $width . 'px;" >';
	$youtube = $youtube . '<iframe src="http://www.youtube.com/embed/' . $id[1] . '?rel=0&autohide=1&showinfo=0" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen></iframe>';
	$youtube = $youtube . '</div>';

	return $youtube;
}

# Divider
add_ytshortcode('divider', 'dividerShortcode');
function dividerShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" => '',
		"margin" => '',
	), $atts));

	$divider = '<div class="yt-divider '.$type.'" style="margin:'.$margin.'"></div>';

	return $divider;
}


# Space
add_ytshortcode('space', 'spaceShortcode');
function spaceShortcode($atts){
	extract(ytshortcode_atts(array(
		"height" => '20'
	), $atts));

	return "<div style='clear:both; height:" . $height . "px;' ></div>";
}

# Clear Floated 
add_ytshortcode('clear', 'clearShortcode');
function clearShortcode($atts){
	extract(ytshortcode_atts(array(
		"height" => '20'
	), $atts));

	return "<div class='clearfix' ></div>";
}

# Line Break
add_ytshortcode('br', 'brShortcode');
function brShortcode($atts){
	extract(ytshortcode_atts(array(
		"height" => '20'
	), $atts));

	return "</br>";
}

# Google fonts
add_ytshortcode('googlefont', 'googlefontShortcode');
function googlefontShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"font" => '',
		"size" => '',
		"color" => '',
		"align" => '',
		"font_weight" => '',
		"margin" => '',
	), $atts));
	
	$style = " style='";
	if($font!="")
		$style .= "font-family:{$font};";

	if($size!="")
		$style .= "font-size:{$size}px;";
	if($color!="")
		$style .= "color:{$color};";
	if($font_weight!="")
		$style .="font-weight:{$font_weight};";
	if($align!="")
		$style .="text-align:{$align};";
	if($margin!="")
		$style .="margin:{$margin};";

	$style .="'";
	$googlefont ="<link href='http://fonts.googleapis.com/css?family={$font}' rel='stylesheet' type='text/css'>";
	$googlefont .= '<h3 class="googlefont"'.$style.'>'.$content.'</h3>';

	return $googlefont;
}


# SyntaxHighlighter
add_ytshortcode('highlighter', 'highlighterShortcode');
function highlighterShortcode($atts, $content){
	$text    = '';
	$script  = '';

	extract(ytshortcode_atts(array(
			"label"		=> '',
			"linenums" 	=> 'Yes',
			"startnums" => 0
			
	), $atts));
	$highli_lang=(($label != '') ? '' . $label : '');
	$highlighter = '<pre title="'.$highli_lang.'"class="highlighter prettyprint'.(($linenums == 'Yes' || $linenums == 'yes' ) ? ' linenums' : '')
		  . (($startnums && $linenums == 'Yes' || $startnums && $linenums == 'yes') ? ':' . $startnums : '').'">'
		  . $content
		  . '</pre>'
		  . $script;

	return $highlighter;
}


# Pricing Tables
$pcolumns = 3;
add_ytshortcode('pricing', 'pricingShortcode');
function pricingShortcode($atts, $content = null ){
	global $pcolumns;

	extract(ytshortcode_atts(array(
		"columns" 			=> '3',
		"width" 		=> '',
		"style" 		=> ''
	), $atts));

	$pcolumns	= $columns;
	$class 		= 'yt-pricing block col-' . $columns.' pricing-'.$style;

	return '<div class="'.$class.'"  style="width:'.$width.';" >' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
}


# Pricing Tables
add_ytshortcode('plan', 'planLineShortcode');
function planLineShortcode($atts, $content = null ){
	global $pcolumns;

	extract(ytshortcode_atts(array(
		"title" 		=> '',
		"button_link" 	=> '',
		"button_label" 	=> '',
		"price" 		=> '',
		"featured" 		=> '',

		"per"			=> 'month',
	), $atts));

	return  '<div class="column span' . round(12/$pcolumns) . (('true' == strtolower($featured)) ? ' featured' : '') .'">' .
				'<div class="pricing-basic"><span>' . $title . '</span></div>' .
				'<div class="pricing-money block"><h2>' . $price . '</h2><h4 >per ' . $per . '</h4></div>' .
				parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) .
				'<div class="pricing-bottom"><a class="signup" href="' . $button_link . '">' . $button_label . '</a></div>' .
			 '</div>';
}

# Slideshow
add_ytshortcode('slideshow', 'slideshowShortcode');
function slideshowShortcode($atts, $content = null){
	global $swidth, $sheight, $scaption;
	global $index_slider,$slideitem_count;

	extract(ytshortcode_atts(array(
		"width"		=> 600,
		"height"	=> 300,
		"align"		=> '',
		"caption"	=> 'yes',
		"count"		=> ''
	), $atts));

	$swidth  = $width;
	$sheight = $height;
	$scaption	= $caption;
	
	$slideshow = '';
	$slideshow .= '<div id="yt-slider-carousel'.$index_slider.'" class="yt-slider-carousel carousel slide pull-'. $align.'" data-ride="carousel">';
	$slideshow .= '<div class="carousel-inner">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
	$slideshow .= '<a class="carousel-control left" href="#yt-slider-carousel'.$index_slider.'" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
	$slideshow .= '<a class="carousel-control right" href="#yt-slider-carousel'.$index_slider.'" data-slide="next"><i class="fa fa-angle-right"></i></a>';
	if($count!=null && !empty($count) ){
		$slideshow .= '<ol class="carousel-indicators" >';
		for($i = 0; $i < $count; $i ++) {
			$slideshow .='<li data-slide-to="'.$i.'" data-target="#yt-slider-carousel'.$index_slider.'"></li>';	
		}
		$slideshow .= '</ol>';
	}
	
	$slideshow .= '</div>';
	$index_slider ++;
	
	return $slideshow;
}


add_ytshortcode('slider_item', 'SliderItemShortcode');
function SliderItemShortcode($atts, $content = null){
	global $swidth, $sheight,$scaption;
	global $slideitem_count ;
	 
	extract(ytshortcode_atts(array(
		"title" => '',
		"src"	=> ''
	), $atts));
	$src = (is_file($src))?$src:'plugins/system/ytshortcodes/assets/images/nophoto.png';
	
	$small_image = array(
		'width' => $swidth,
		'height' => $sheight,
		'function' => 'resize',
		'function_mode' => 'fill'
	);
	
	if($swidth > 0 && $swidth!='' && $swidth!='auto' && $sheight > 0 && $sheight!='' && $sheight!='auto'){
		$images = ImageHelper::init($src, $small_image)->src();
		$simage = $images;
	}else{
		$simage = $src;
	}
	
	$Slider_title = ($title !='') ? "<h4>". 
	
$title ."</h4>" : ''  ;
	$Slider_content = ($content !='') ? "<p>". $content ."</p>" : ''  ;
	$Slider_caption =(($scaption == "Yes" || $scaption == "yes")? '<div class="carousel-caption">' .$Slider_title. $Slider_content.'</div>': " ");

	$slider_item  = "<div class='item'>";
	$slider_item .= "<img src='" .JURI::base()."/". $simage . "' title='" . $title . "' alt='" . $title . "' />";
	$slider_item .= $Slider_caption;
	$slider_item .= "</div>";
	$slideitem_count ++;
	
	return str_replace("<br/>", " ", $slider_item);
}

# Carousel
add_ytshortcode('carousel', 'carouselShortcode');
function carouselShortcode($atts, $content = null){
	global $index_carousel,$carousel_count;

	extract(ytshortcode_atts(array(
		"width"		=> '',
		"height"	=> '',
		"align"		=> 'none',
		"count"		=> '',
		"control"	=> 'no'
	), $atts));

	$carousel = '';
	$carousel .= '<div id="yt-extra-carousel'.$index_carousel.'" style="width:'.$width.'; height:'.$height.'" class="yt-extra-carousel carousel slide pull-'. $align.'" data-ride="carousel">';
	$carousel .= '<div class="carousel-inner">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . '</div>';
	
	if($control!=null && $control == 'yes'){
		$carousel .= '<a class="carousel-control left" href="#yt-extra-carousel'.$index_carousel.'" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
		$carousel .= '<a class="carousel-control right" href="#yt-extra-carousel'.$index_carousel.'" data-slide="next"><i class="fa fa-angle-right"></i></a>';
	}
	if($count!=null && !empty($count) ){
		$carousel .= '<ol class="carousel-indicators" >';
		for($i = 0; $i < $count; $i ++) {
			$carousel .='<li data-slide-to="'.$i.'" data-target="#yt-extra-carousel'.$index_carousel.'"></li>';	
		}
		$carousel .= '</ol>';
	}
	
	$carousel .= '</div>';
	$index_carousel ++;
	
	return $carousel;
}


add_ytshortcode('carousel_item', 'carouselitemShortcode');
function carouselitemShortcode($atts, $content = null){
	global $carousel_count ;
	extract(ytshortcode_atts(array(
		
	), $atts));
	
	$carousel_item  = "<div class='item'>";
	$carousel_item .=  parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content));
	$carousel_item .= "</div>";
	$carousel_count ++;
	
	return $carousel_item;
}


# Tooltip
add_ytshortcode('tooltip', 'tooltipShortcode');
function tooltipShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"link" 		=> '#',
		"title" 	=> '',
		"position"	=> ''
	), $atts));

	$divider = '<a data-placement="'.$position.'" href="'.$link.'" title="'.$title.'">'.$content. '</a>';

	return $divider;
}

# Modals 
add_ytshortcode('modal', 'modalShortcode');
function modalShortcode($atts, $content = null){
	global $index_modal;
	extract(ytshortcode_atts(array(
		"title"		=> 'default',
		"header"	=> '',
		"type"		=> '',
		"icon" 		=> '',
	), $atts));
	$btn_icon = '<i class="'.(($icon != '') ? 'fa fa-' . $icon : '').'"></i>';
	
	$modal = '<a class="btn btn-default '.(($type != '') ? ' btn-' . $type : '').'" href="#myModal'.$index_modal.'" data-toggle="modal">'.$btn_icon.$title.'</a>';
	$modal .= '<div id="myModal'.$index_modal.'" class="modal yt-modal fade" tabindex="-1">';
	$modal .= '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"> <button style="background:none;" class="close" type="button" data-dismiss="modal"><i class="fa fa-times"></i></button>';
	$modal .= '<h3 id="myModalLabel">'.$header.'</h3> </div>';
	$modal .= '<div class="modal-body">'.$content.'</div>';
	$modal .= '</div></div></div>';
	$index_modal ++;
	
	return $modal;
}

?>