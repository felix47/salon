<?php
/*------------------------------------------------------------------------
 # Sj Dynamic Slideshow
 * @version 1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 */
defined('_JEXEC') or die;

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

$layout = $params->get('layout', 'default');
require JModuleHelper::getLayoutPath($module->module, $layout);
