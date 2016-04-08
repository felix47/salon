<?php
/**
 * @package Sj Super Category for JoomShopping
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;

require_once dirname(__FILE__).'/helper_base.php';

class SjJSSuperCategoriesHelper extends SjJSSuperCategoriesBaseHelper {
	public static function getListProductFilter ($params){
		$catids = $params->get('catid');
		!is_array ( $catids ) && settype ( $catids , 'array' );
		if(empty($catids)) return ;
		$cat_table = JTable::getInstance('category', 'jshop');
		$pro_table = JTable::getInstance('product', 'jshop');
		$_catids = array ();
		$list = array ();
		foreach( $catids as $catid )
		{
			$cat_table->load( $catid );
			if($cat_table->category_publish > 0) {
				$_cat_parent = self::getCategoryInfo($cat_table->category_id);
				$list['category_parent'] = (is_array($_cat_parent) && isset($_cat_parent[0])) ? $_cat_parent[0] : null;
				$_catids[] = (int)$cat_table->category_id;
			}
		}
		if(empty($list['category_parent'])) return;
		$cat_order = $params->get('cat_orderby', 'name');
		$cat_ordering = $params->get('cat_ordering' , 'desc');
		
		$levels = $params->get('levels', 1) ? $params->get('levels', 1) : 9999;
		$show_child_category_products = $params->get('show_child_category_products',1);
		$source_limit_category = $params->get('source_limit_category',7);
		$_childcats = ( $levels > 0 ) ? self::_getChildenCategories($_catids, $levels ,$show_child_category_products ) : null;
		$list['category_tree'] = (!empty($_childcats) && $_childcats != null) ? self::getCategoryInfo($_childcats , $cat_order, $cat_ordering, 1 , 0 , $source_limit_category ) : null;
		
		$_catids = $show_child_category_products && $_childcats != null ? array_unique(array_merge($_catids, $_childcats)) :  $_catids;
		$lang = JSFactory::getLang();
		$orderby = $params->get('filter_order_by');
		$orderby_preload = $params->get('field_preload');
		
		if (!in_array($orderby_preload, $orderby)) {
				$orderby_preload = $orderby[0];
		}
       
		$orderdir = $params->get('product_ordering_direction');
		$limit_start = JRequest::getVar('limit_start',0);
		$limit = $params->get('count_products',5);
		$filters['categorys'] = $_catids;
		$list['category_parent']->_cat_array = implode (', ',$_catids);
		$product_filter = array();
		foreach ($orderby as $key => $_order) {
			$product = new stdClass();
			$product->count = $pro_table->getCountAllProducts($filters);
			$product->id = $_order;
			$product->_odering = $key;
			$product->title = self::getLabel($_order);
			array_push($product_filter, $product);
		}
		
		$_list = array();
		foreach ($product_filter as $_order) {
			if ($_order->count > 0) {
				if ($_order->id == $orderby_preload) {
					$_order->sel = 'sel';
                    $_order->child = self::_getAllProducts($filters, $orderby_preload, $orderdir, $limit_start, $limit);
				}
                $_list[$_order->id] = $_order;
			}

		}
		
		$list['tab'] = $_list;
		return $list;
	}
	
	public static function _getAllProducts($filters, $order = null, $orderby = null, $limitstart = 0, $limit = 0){
		$_db = JFactory::getDBO();
		$pro_table = JTable::getInstance('product', 'jshop');
        $jshopConfig = JSFactory::getConfig();
        $lang = JSFactory::getLang();
        $adv_query = ""; $adv_from = ""; $adv_result = $pro_table->getBuildQueryListProductDefaultResult();
        $pro_table->getBuildQueryListProduct("products", "list", $filters, $adv_query, $adv_from, $adv_result);
		if($order == 'best_seller') {
			$orderby = ' DESC ';
		}
		if( $order == 'name' ){
			$order = "prod.`".$lang->get('name')."`";
		}
        $order_query = $pro_table->getBuildQueryOrderListProduct($order, $orderby, $adv_from);
        JPluginHelper::importPlugin('jshoppingproducts');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeQueryGetProductList', array("all_products", &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters) );
        $query = "SELECT distinct prod.product_id , SUM(OI.product_quantity) as best_seller, $adv_result FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
				  LEFT JOIN `#__jshopping_order_item` AS OI  ON prod.product_id = OI.product_id
                  $adv_from
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' ".$adv_query."
                  GROUP BY prod.product_id ".$order_query;
        if ($limit){
            $_db->setQuery($query, $limitstart, $limit);
        }else{
            $_db->setQuery($query);
        }
        $products = $_db->loadObjectList();
        $products = listProductUpdateData($products);
		addLinkToProducts($products, 0, 1);
        return $products;
    }    
	
	private static function getCategoryTree($parentId=0, $level = 0, $onlyPublished = true ){
		$sortedCats = array();
		self::_rekurseCats($parentId,$level,$onlyPublished, $sortedCats);
		return $sortedCats;
	}
	
	private static function _rekurseCats($category_id, $level ,$onlyPublished , &$sortedCats){
		$level++;
		$cat_table = JTable::getInstance('category', 'jshop');
		$childCats = $cat_table->getSubCategories($category_id, null , null , $onlyPublished);
		if(!empty($childCats))
		{
			foreach ($childCats as $key => $category) 
			{
				$category->level = $level;
				$sortedCats[] = $category;
				self::_rekurseCats($category->category_id, $level, $onlyPublished,  $sortedCats);
			}
		}

	}
	
	private static function _getChildenCategories( $catids,  $levels  ) {
		!is_array ( $catids ) && settype ( $catids ,'array');
		if(!empty ( $catids )) {
			$additional_catids = array ();
			foreach($catids as $catid)
			{
				$items = self::getCategoryTree($catid);
				if(!empty($items)){
					foreach($items as $category)
					{
						$condition = $category->level <= $levels;
						if ($condition) {
							$additional_catids[] = (int)$category->category_id;
						}
					}
				}
			}
			
			$catids = array_unique($additional_catids);
		}
		
		return $catids;
	}
	
	
	private static  function getCategoryInfo($catid, $order = 'id', $ordering = 'asc', $publish = 1 , $limit_start = 0, $limit = 0) {
		$_db = JFactory::getDBO();
		$lang = JSFactory::getLang();
        $user = JFactory::getUser();
        $add_where = ($publish)?(" AND category_publish = '1' "):("");
        $groups = implode(',', $user->getAuthorisedViewLevels());
        $add_where .=' AND access IN ('.$groups.')';
        if ($order=="id") $orderby = "category_id";
        if ($order=="name") $orderby = "`".$lang->get('name')."`";
        if ($order=="ordering") $orderby = "ordering";
		if ($order=="rand")  {
			$orderby = "rand()";
			$ordering = '';
		}	
        if (!$orderby) $orderby = "ordering";
        !is_array($catid) && settype($catid, 'array');
		if ($catid){
            $_catid = implode(', ', $catid);
        }
        $query = "SELECT `".$lang->get('name')."` as name,`".$lang->get('description')."` as description,`".$lang->get('short_description')."` as short_description, category_id, category_parent_id, category_publish, ordering, category_image FROM `#__jshopping_categories`
                   WHERE category_id IN (".$_catid.") ".$add_where."
                   ORDER BY ".$orderby." ".$ordering;
        $_db->setQuery($query);
		 if ($limit){
            $_db->setQuery($query, $limit_start, $limit);
        }else{
            $_db->setQuery($query);
        }
        $categories = $_db->loadObjectList();
		$pro_table = JTable::getInstance('product', 'jshop');
        foreach($categories as $key => $value){
			$filters['categorys'] = array($value->category_id);
			$categories[$key]->_totalProduct =  $pro_table->getCountAllProducts ($filters);
            $categories[$key]->cat_link = SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id='.$categories[$key]->category_id, 1);
		}     
        return $categories;
    }


	private static function getLabel($_order)
	{
		switch ($_order) {
			case 'name' :
				return JText::_('NAME');
			case 'prod.product_price' :
				return JText::_('PRICE');
            case 'best_seller':
                return JTEXT::_('BEST_SELLER');
			case 'prod.reviews_count' :
				return JText::_('REVIEWS_COUNT');
            case 'prod.average_rating':
                return JText::_('AVERAGE_RATING');
			case 'prod.hits' :
				return JText::_('HITS');
			case 'prod.product_id':
				return JText::_('PRODUCT_ID');
			case 'prod.product_date_added':
				return JText::_('PRODUCT_DATE_ADDED');
			case 'prod.date_modify':
				return JText::_('DATE_MODIFY');
            case 'random':
                return JText::_('RANDOM');
		}
	}

    

}
