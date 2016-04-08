<?php
/**
 * @package Sj Super Categories for JoomShopping
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */

defined('_JEXEC') or die;
$jshopConfig = JSFactory::getConfig();
$small_image_config = array(
	'type' => $params->get('imgcfg_type'),
	'width' => $params->get('imgcfg_width'),
	'height' => $params->get('imgcfg_height'),
	'quality' => 90,
	'function' => ($params->get('imgcfg_function') == 'none') ? null : 'resize',
	'function_mode' => ($params->get('imgcfg_function') == 'none') ? null : substr($params->get('imgcfg_function'), 7),
	'transparency' => $params->get('imgcfg_transparency', 1) ? true : false,
	'background' => $params->get('imgcfg_background'));
if (!empty($child_items)) {
	$app = JFactory::getApplication();
	$k = $app->input->getInt('ajax_reslisting_start', 0);
	foreach ($child_items as $item) {
		$k++; ?>
		<div class="spcat-item new-spcat-item">
			<div class="item-inner">
				<?php
				$img0 = SjJSSuperCategoriesHelper::getJSAImage($item, $params);
				if ($img0 && (@GetImageSize($img0['src']) || file_exists($img0['src']))) {
					?>
					<div class="item-image">
						<a class="rspl-image" data-src="<?php echo SjJSSuperCategoriesHelper::imageSrc($img0, $params); ?>"
						   href="<?php echo $item->product_link ?>" <?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('link_target', '_self')) ?>
						   title="<?php echo $item->name ?>">
							<?php echo SjJSSuperCategoriesHelper::imageTag($img0, $small_image_config); ?>
						</a>
						<div class="bg_hover"></div>
						<a data-rel="prettyPhoto" class="zoom" href="<?php echo SjJSSuperCategoriesHelper::imageSrc($img0, $params);?>" title="<?php echo $item->name ?>"><i class="fa fa-search"></i></a>
					</div>
				<?php } ?>

				<?php if ($params->get('item_title_display', 1) == 1) { ?>
					<div class="item-title ">
						<a href="<?php echo $item->product_link ?>" <?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('link_target', '_self')) ?>
						   title="<?php echo $item->name ?>">
							<?php echo SjJSSuperCategoriesHelper::truncate($item->name, $params->get('item_title_max_characters', 25)); ?>
						</a>
					</div>
				<?php } ?>

				<?php if ($params->get('item_description_display', 1) == 1) { ?>
					<div class="item-introtext">
						<?php echo SjJSSuperCategoriesHelper::truncate($item->description, $params->get('item_des_maxlength', 200)); ?>
					</div>
				<?php } ?>

                <?php if ($params->get('item_price_display') == 1) { ?>
                    <div class="item-prices">
                        <?php if ($item->_display_price) { ?>
                            <div class="jshop_price">
                                <?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_PRICE . ": "; ?>
                                <?php if ($item->show_price_from) print _JSHOP_FROM . " "; ?>
                                <span><?php print formatprice($item->product_price); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

				<?php if ($params->get('item_allow_review_display', 1)) { ?>
					<div class="item-review">
                        <?php print showMarkStar($item->average_rating); ?>
					</div>
				<?php } ?>

				<?php if ($params->get('item_comment_display', 1)) { ?>
					<div class="item-comment">
						<?php print sprintf(_JSHOP_X_COMENTAR, $item->reviews_count); ?>
					</div>
				<?php } ?>

				<?php if ($params->get('item_buy_display') && !$item->hide_buy) { ?>
					<div class="buttons">
						<a class="addtocart" href="<?php echo $item->buy_link; ?>">
							<?php print _JSHOP_ADD_TO_CART ;?>
						</a>
						<?php print $item->_tmp_product_html_buttons; ?>
					</div>
				<?php } ?>

				<?php if ($params->get('item_created_display', 1) == 1) { ?>
					<div class="item-date ">
						<?php
						echo JHTML::_('date', $item->product_date_added, JText::_('DATE_FORMAT_LC3'));
						?>
					</div>
				<?php } ?>

				<?php if ((int)$params->get('item_readmore_display', 1)) { ?>
					<div class="item-readmore">
						<a href="<?php echo $item->product_link; ?>"
						   title="<?php echo $item->title ?>" <?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('link_target', '_self')); ?> >
							<?php echo JText::_($params->get('item_readmore_text', 'Detail')); ?>
						</a>
					</div>
				<?php } ?>

				<div class="other-infor">
					<?php if ($params->get('item_hits_display', 1) == 1) { ?>
						<div class="hits">
							<?php echo JText::_('READ', true); ?> <?php if ($item->hits > 1) {
								echo $item->hits . ' ';
								echo JText::_('TIMES', true);
							} else {
								echo $item->hits . ' ';
								echo JText::_('TIME', true);
							}?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php $clear = 'clr1';
		if ($k % 2 == 0) $clear .= ' clr2';
		if ($k % 3 == 0) $clear .= ' clr3';
		if ($k % 4 == 0) $clear .= ' clr4';
		if ($k % 5 == 0) $clear .= ' clr5';
		if ($k % 6 == 0) $clear .= ' clr6';
		?>
		<div class="<?php echo $clear; ?>"></div>
	<?php
	} ?>
<?php
}else{ echo 'Has no content to show';}?>


