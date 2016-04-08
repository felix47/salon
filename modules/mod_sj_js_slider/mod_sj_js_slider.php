<?php
/**
 * @package Sj Slider for JoomShopping
 * @version 1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/core/helper.php';
if( $include_js =='com_jshopping' ){
	if( !defined('SMART_JQUERY') && $params->get('include_jquery_joom') == "1" && $params->get('include_jquery') == "1" ){
		JHtml::script('media/jsslider/js/jquery.min.js');
		JHtml::script('media/jsslider/js/jquery.noconflict.js');
		define('SMART_JQUERY', 1);
	}
}else{
	if( !defined('SMART_JQUERY') && $params->get('include_jquery') == "1" ){
		JHtml::script('media/jsslider/js/jquery.min.js');
		JHtml::script('media/jsslider/js/jquery.noconflict.js');
		define('SMART_JQUERY', 1);
	}
}
JsSlider::include_js('jsslider/slider.js');
JsSlider::include_css('jsslider/mod_sj_js_slider.css');
$idbase = $params->get('catids');

$cacheid = md5(serialize(array ($idbase, $module->module)));
$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'JsSlider';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;
$list = JModuleHelper::moduleCache($module, $params, $cacheparams);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_sj_js_slider', $params->get('layout', 'default'));?>
