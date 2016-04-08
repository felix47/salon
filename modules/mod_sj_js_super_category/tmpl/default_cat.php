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

$big_image_config = array(
	'type' => $params->get('imgcfgcat_type'),
	'width' => $params->get('imgcfgcat_width'),
	'height' => $params->get('imgcfgcat_height'),
	'quality' => 90,
	'function' => ($params->get('imgcfgcat_function') == 'none') ? null : 'resize',
	'function_mode' => ($params->get('imgcfgcat_function') == 'none') ? null : substr($params->get('imgcfgcat_function'), 7),
	'transparency' => $params->get('imgcfgcat_transparency', 1) ? true : false,
	'background' => $params->get('imgcfgcat_background'));

//effect
$center = $options->center == 1 ? 'true' : 'false';
$nav = $options->nav == 1 ? 'true' : 'false';
$loop = $options->loop == 1 ? 'true' : 'false';
$margin = $options->margin >= 0 ? $options->margin : 5;
$slideBy = $options->slideBy > 0 ? $options->slideBy : 1;
$autoplay = $options->autoplay == 1 ? 'true' : 'false';
$autoplayTimeout = $options->autoplayTimeout >= 0 ? $options->autoplayTimeout : 5000;
$autoplayHoverPause = $options->autoplayHoverPause == 1 ? 'true' : 'false';
$autoplaySpeed = $options->autoplaySpeed >= 0 ? $options->autoplaySpeed : 5000;
$navSpeed = $options->navSpeed >= 0 ? $options->navSpeed : 5000;
$smartSpeed = $options->smartSpeed >= 0 ? $options->smartSpeed : 5000;
$startPosition = $options->startPosition > 0 ? $options->startPosition : 1;
$mouseDrag = $options->mouseDrag == 1 ? 'true' : 'false';
$touchDrag = $options->touchDrag == 1 ? 'true' : 'false';
$pullDrag = $options->pullDrag == 1 ? 'true' : 'false';
$freeDrag = $options->freeDrag == 1 ? 'true' : 'false';

?>

<div class="category-wrap-cat">
	<?php
	if (!empty($list['category_parent'])) {
			?>
			<div class="title-imageslider  sp-cat-title-parent" data-catids="<?php echo $list['category_parent']->_cat_array; ?>">
				<a title="<?php echo $list['category_parent']->name;?>" href="<?php echo $list['category_parent']->cat_link;?>"
					<?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('target')); ?>
					>
					<?php echo $list['category_parent']->name;?>
				</a>
			</div>
		<?php 
	} ?>

	<?php $tag = 'cat_slider_' . rand() . time() ?>
	<div id="<?php echo $tag ?>" class="slider"  >
		<div class="cat_slider_inner">
			<?php
			if (!empty($list['category_tree'])) {
				foreach ($list['category_tree'] as $cat_tree) {
					?>
					<div class="item">
						<div class="item-inner">

							<div class="cat_slider_image">
								<a href="<?php echo $cat_tree->cat_link; ?>"
								   title="<?php echo $cat_tree->name; ?>" <?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('target')); ?>>
									<?php $img = SjJSSuperCategoriesHelper::getJSCImage($cat_tree, $params, 'imgcfgcat');
									echo SjJSSuperCategoriesHelper::imageTag($img, $big_image_config);?>
								</a>
							</div>

							<div class="cat_slider_title">
								<a href="<?php echo $cat_tree->cat_link; ?>"
								   title="<?php echo $cat_tree->name; ?>" <?php echo SjJSSuperCategoriesHelper::parseTarget($params->get('target')); ?>>
									<?php echo SjJSSuperCategoriesHelper::truncate($cat_tree->name, $params->get('category_title_max_characs', 25)); ?>
								</a>
							</div>

						</div>
					</div>
				<?php
				}
			} ?>
		</div>
	</div>

</div>
