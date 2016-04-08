<div id = "jshop_module_cart">
	<a class="gotocart" href = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><i class="fa fa-shopping-cart"></i><?php //print JText::_('GO_TO_CART')?></a>
	<span id = "jshop_quantity_products"><?php print _JSHOP_ITEMS ?>&nbsp;(<?php print $cart->count_product?>)</span>
</div>