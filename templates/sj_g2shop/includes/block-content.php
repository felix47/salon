<?php
/*
 * ------------------------------------------------------------------------
 * Yt FrameWork for Joomla 3.x
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2012 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/

// no direct access
$option = JRequest::getVar('option', null);
$view = JRequest::getVar('view', null);
$task = JRequest::getVar('task', null);
$layout = JRequest::getVar('layout', null);
$controller = JRequest::getVar('controller', null);
//var_dump($controller);

defined( '_JEXEC' ) or die( 'Restricted access' );
if ($position['group'] == '') { // Position none group
	echo $yt->renPositionsContentNoGroup($position);	
	
} elseif ( ($position['group'] != 'left') && ($position['group'] != 'main') && ($position['group'] != 'right') ) { 	// Position has group's user created	
	if (!isset($countGSpe)) {
		$countGSpe = 0;
	}
	$countGSpe ++;
	
	if($countGSpe == 1) {
		echo '<div id="' . $position['group'] . ' "  ' . ($style != '' ? 'style="'.$style.'"' : '') .'>';	
		echo $yt->renPositionsGroup($position);	  
		$width = $height = $style = "";
		if($tagBD['count-'.$position['group']] == 1) {
			$countGSpe = null;
			echo '</div>';	
		}
	} elseif ( $countGSpe == $tagBD['count-'.$position['group']] && $tagBD['count-'.$position['group']] > 1 ) {
		echo $yt->renPositionsGroup($position);	  
		$countGSpe = null;
		echo '</div>';	
	} else {
		echo $yt->renPositionsGroup($position);	  
		
	}		
} elseif ( ($position['group'] == 'left')
	   ||($position['group'] == 'main')
	   ||($position['group'] == 'right') ) { // Position has group's framework fixed	- left, main, right
	  
	if($position['group'] == 'left') {
		$countL ++;
		 
		if($countL == 1) {
			
			$more_attr = '';
			$more_attr .= (isset($yt_render->arr_GI['left']['data-wide']))?' data-wide="'.$yt_render->arr_GI['left']['data-wide'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['left']['data-normal']))?' data-normal="'.$yt_render->arr_GI['left']['data-normal'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['left']['data-tablet']))?' data-tablet="'.$yt_render->arr_GI['left']['data-tablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['left']['data-stablet']))?' data-stablet="'.$yt_render->arr_GI['left']['data-stablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['left']['data-mobile']))?' data-mobile="'.$yt_render->arr_GI['left']['data-mobile'].'"':'';	     
			
			if( ($this->countModules('left') ) && !($option=='com_jshopping'  && $controller=='product') )   {   	
				echo '<aside id="content_left" class="'.$yt_render->arr_GI['left']['class'].'"'.$more_attr.'>';	
				echo $yt->renPositionsGroup($position, 'block-content');
				if($tagBD['count-group-left'] == 1) {
					echo '</aside>';
				}
			}
			
		} elseif ($tagBD['count-group-left'] == $countL && $tagBD['count-group-left'] > 1) {
			echo $yt->renPositionsGroup($position, 'block-content');
			echo '</div></div>';			
		} else {
			echo $yt->renPositionsGroup($position, 'block-content');
		}			
	} elseif ($position['group'] == 'main') {
		$countM++;
		if ($countM == 1) {
			$more_attr = '';
			$more_attr .= (isset($yt_render->arr_GI['main']['data-wide']))?' data-wide="'.$yt_render->arr_GI['main']['data-wide'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['main']['data-normal']))?' data-normal="'.$yt_render->arr_GI['main']['data-normal'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['main']['data-tablet']))?' data-tablet="'.$yt_render->arr_GI['main']['data-tablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['main']['data-stablet']))?' data-stablet="'.$yt_render->arr_GI['main']['data-stablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['main']['data-mobile']))?' data-mobile="'.$yt_render->arr_GI['main']['data-mobile'].'"':'';       	
			if(  !($option=='com_jshopping'  && $controller=='product') )   {   	
				echo '<div id="content_main" class="'.$yt_render->arr_GI['main']['class'].'"'.$more_attr.'>' ;
				echo $yt->renPositionsGroup($position, 'main');
				if($tagBD['count-group-main'] == 1 ) {
					echo '	</div>';
					echo '</div>';		
				}
			}else{
				echo '<div id="content_main" class="col-sm-12">' ;
				echo $yt->renPositionsGroup($position, 'main');
				if($tagBD['count-group-main'] == 1 ) {
					echo '	</div>';
					echo '</div>';		
				}
			}
		} elseif ( ($tagBD['count-group-main'] == $countM) && ($tagBD['count-group-main'] > 1) ){ 
			echo $yt->renPositionsGroup($position, 'main');		
			echo '</div>';		
		} else {
			echo $yt->renPositionsGroup($position, 'main');
		}
	} elseif ($position['group'] == 'right') {
		$countR ++;
		if($countR == 1) {		       
			$more_attr = '';
			$more_attr .= (isset($yt_render->arr_GI['right']['data-wide']))?' data-wide="'.$yt_render->arr_GI['right']['data-wide'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['right']['data-normal']))?' data-normal="'.$yt_render->arr_GI['right']['data-normal'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['right']['data-tablet']))?' data-tablet="'.$yt_render->arr_GI['right']['data-tablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['right']['data-stablet']))?' data-stablet="'.$yt_render->arr_GI['right']['data-stablet'].'"':'';
			$more_attr .= (isset($yt_render->arr_GI['right']['data-mobile']))?' data-mobile="'.$yt_render->arr_GI['right']['data-mobile'].'"':'';       	
			
			if( !($option=='com_jshopping'  && $controller=='product') )   {  
				echo '<aside id="content_right" class="'.$yt_render->arr_GI['right']['class'].'"'.$more_attr.'>';
				echo $yt->renPositionsGroup($position, 'block-content');
				if($tagBD['count-group-right'] == 1) {
					echo '</aside>';			
				}
			}
		} elseif ($countR == $tagBD['count-group-right'] && $tagBD['count-group-right'] > 1) {
			echo $yt->renPositionsGroup($position, 'block-content');
			echo '</div></div>';
		} else {
			echo $yt->renPositionsGroup($position, 'block-content');
		}				
	}
}		
?> 