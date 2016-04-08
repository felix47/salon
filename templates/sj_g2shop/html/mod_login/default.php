<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>

<ul class="yt-loginform menu">
	<li class="yt-login">
		<a class="login-switch" data-toggle="modal" href="#myLogin" title="<?php JText::_('Login');?>">
		   <?php echo JText::_('Вход'); ?>
		</a>
		<div id="myLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
			
			<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline">
				<?php if ($params->get('pretext')): ?>
					<div class="pretext">
					<p><?php echo $params->get('pretext'); ?></p>
					</div>
				<?php endif; ?>
				<div class="userdata">
					<div id="form-login-username" class="control-group">
						<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
					</div>
					<div id="form-login-password" class="control-group">
						
						<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
					</div>
					
					<div id="form-login-remember" class="control-group ">
						<input id="modlgn-remember" type="checkbox" name="remember" value="1"/>
						<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label> 
					</div>
					
					
					
					<div id="form-login-submit" class="control-group">
						<div class="controls">
							<button type="submit" tabindex="3" name="Submit" class="button buttonLogin"><?php echo JText::_('JLOGIN') ?></button>
						</div>
					</div>
					
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" />
					<input type="hidden" name="return" value="<?php echo $return; ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</div>
				<ul class="listinline listlogin">
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
						<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
					</li>

					<li style="margin:0px;">
						<?php echo JText::_('MOD_LOGIN_DONT_HAVE_ACCOUNT'); ?>
						<a href="<?php echo JRoute::_("index.php?option=com_users&view=registration");?>" 
		onclick="showBox('yt_register_box','jform_name',this, window.event || event);return false;"><?php echo JText::_('JREGISTER_HERE');?> </a>
					</li>
					
				</ul>
				<?php if ($params->get('posttext')): ?>
					<div class="posttext">
						<p><?php echo $params->get('posttext'); ?></p>
					</div>
				<?php endif; ?>
				
			</form>
			<button type="button" class="btn btn-default btnClose" data-dismiss="modal"><i class="fa fa-times"></i></button>
		</div>
	</li>
	<li class="yt-register">
	<?php
	$usersConfig = JComponentHelper::getParams('com_users');
	if ($usersConfig->get('allowUserRegistration')) : ?>
	 
		<a class="register-switch text-font" href="<?php echo JRoute::_("index.php?option=com_users&view=registration");?>" 
		onclick="showBox('yt_register_box','jform_name',this, window.event || event);return false;">
			<span class="title-link"> <span><?php echo JText::_('JREGISTER');?></span></span>
		</a>
	<?php endif; ?>	
	</li>
	<!--
	<li class="jshop-checkout">
		<a href="index.php/shopping/shop-basket/view">Checkout</a>
	</li>
	-->
</ul>

