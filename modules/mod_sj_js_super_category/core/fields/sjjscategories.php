<?php
/**
 * @package SJ Category Slider for JoomShopping
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 */

defined('_JEXEC') or die;

!defined('DS') && define('DS', DIRECTORY_SEPARATOR);

if ( !class_exists ( 'JFormFieldSJJSCategories' ) ) 
{
	class JFormFieldSJJSCategories extends JFormField  
	{
		protected $type = 'sjjscategories';
		
		protected function getInput () 
		{
			$_factory = JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'lib'.DS.'factory.php';
			$_functions = JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'lib'.DS.'functions.php';
			if ( file_exists ( $_factory ) && file_exists ( $_functions ) ) 
			{
				if(!class_exists ( 'JSFactory' )) 
				{
					require_once ($_factory); 
					require_once ($_functions);
				}
			}
			else
			{
				 echo JText::_('WARNING_LABEL');
			}
			
			$category = buildTreeCategory(0); 
		    $_ctrl  =  $this->name;
			$_value = empty($this->value) ? '' : $this->value;
			$_attr = $this->multiple?' multiple="multiple" ':'';
			return JHTML::_('select.genericlist', $category, $_ctrl, 'class="inputbox" "'.$_attr.'" ' ,'category_id','name', $_value );
		}
	}
}


