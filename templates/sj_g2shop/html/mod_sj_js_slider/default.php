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

ImageHelper::setDefault($params);
$options = $params->toObject();
$uniqued ='container_slider_'.rand().time();

if(!empty($list)){?>
	<?php if(!empty($options->pretext)) { ?>
		<div class="pre-text"><?php echo $options->pretext; ?></div>
	<?php } ?>
	<div id="<?php echo $uniqued; ?>" class="container-slider" style="<?php if( $options->anchor == "bottom" ){ echo "margin-bottom:40px;"; }?>">
			<div class="page-title"><?php echo $options->slider_title_text;?></div>
			<?php if($options->anchor =="top"){?>
			<?php if($options->button_display == 1){?>
			<div class="page-button <?php echo $options->anchor;?> <?php echo $options->control;?>">
				<ul class="control-button">
					<li class="preview">Prev</li>
					<li class="next">Next</li>
				</ul>		
			</div>
			<?php }}?>
	
		<div class="slider not-js cols-6 <?php echo $options->deviceclass_sfx; ?>">
			<div class="vpo-wrap">
				<div class="vp">
					<div class="vpi-wrap">
					<?php foreach($list as $item){?>
						<div class="item">
							<div class="item-wrap">
								<div class="item-img item-height">
									<div class="item-img-info">
										<a href="<?php echo $item->link;?>" <?php echo JsSlider::parseTarget($params->get('target'));?>>
											<?php $img = JsSlider::getAImage($item, $params);
	    										echo JsSlider::imageTag($img);?>
										</a>
									</div>
									<div class="bg_hover"></div>
									<?php if( $options->show_read_more == 1 ){?>
										<div class="item-read">
											<a href="<?php echo $item->link;?>" <?php echo JsSlider::parseTarget($params->get('target'));?>>
												<?php echo $options->read_more_text; ?>
											</a>
										</div>	
									<?php }?>
								</div>
								<div class="item-info <?php if( $options->theme == "theme2" ){ echo "item-spotlight"; }?> ">
									<div class="item-inner">
									<?php if( $options->show_title == 1 ){?>
										<div class="item-title">
											<a href="<?php echo $item->link;?>" <?php echo JsSlider::parseTarget($params->get('target'));?>>
												<?php echo $item->title;?>
											</a>
										</div>
									<?php }?>
										<div class="item-content">
										<?php if( $options->show_desc == 1 ){?>
											<div class="item-des">
												<?php echo $item->short_description;?>									
											</div>
										<?php }?>
												
										<?php if( $item->_display_price && (int)$params->get('show_price', 1) ){ ?>
											<div class="item-price">
								                <?php if ($item->show_price_from) echo _JSHOP_FROM." ";?>
								                <?php if($options->theme == 'theme1'){
								                	$color_price = 'color:#333333';
								                }else{
								                	$color_price = 'color:#FFFFFF';
								                }?>
								                <span><?php echo formatprice($item->product_price);?></span>
											</div>
										<?php }?>
										<?php if( $params->get('show_review') ){?>
								        	<div class="review_mark"><?php echo showMarkStar($item->average_rating);?></div>
								        <?php }	?>
										<div class="buttons">
												<?php if ($item->link){?>
												<a class="button_buy" title="Add to Cart" href="<?php echo $item->buy_link;?>"><?php echo JText::_('ADD_TO_CART'); ?></a> 
												<?php }?>
												
												<?php print $product->_tmp_var_buttons;?>
											</div>
										<?php //var_dump($item);die; ?>
											
										</div>	
										<?php if( $options->theme == "theme2" ){
											if( $options->show_title == 1 || $options->show_desc == 1 || $options->show_read_more == 1 || $options->show_price == 1 || $options->show_review == 1 ){?>
											<div class="item-bg"></div>				
										<?php }}?>		
									</div>
								</div>						
							</div>
						</div>
					<?php }?>
					</div>
				</div>
			</div>
		</div>
		
		<?php if($options->anchor !="top"){?>
			<?php if($options->button_display == 1){?>
			<div class="page-button <?php echo $options->anchor;?> <?php echo $options->control;?>">
				<ul class="control-button">
					<li class="preview"><i class="fa fa-angle-left"></i></li>
					<li class="next"><i class="fa fa-angle-right"></i></li>
				</ul>		
			</div>
		<?php }}?>
		
	</div>
	<?php if(!empty($options->posttext)) {  ?>
		<div class="post-text"><?php echo $options->posttext; ?></div>
	<?php } ?>
<?php }else {echo JText::_('Has no content to show!');}?>

<script type="text/javascript">
//<![CDATA[
    jQuery(document).ready(function($){
        $('#<?php echo $uniqued;?> .slider').responsiver({
            interval: <?php echo $options->delay;?>,
            speed: <?php echo $options->duration;?>,
            start: <?php echo $options->start -1;?>,
            step: <?php echo $options->scroll;?>,
            circular: true,
            preload: true,
			fx: 'slide',
            pause: 'hover',
            control:{
				prev: '#<?php echo $uniqued;?> .control-button li[class="preview"]',
				next: '#<?php echo $uniqued;?> .control-button li[class="next"]'
            },
			getColumns: function(element){
				var match = $(element).attr('class').match(/cols-(\d+)/);
				if (match[1]){
					var column = parseInt(match[1]);
				} else {
					var column = 1;
				}
				if (!column) column = 1;
				return column;
			}          
        });
    });
//]]>
</script>



