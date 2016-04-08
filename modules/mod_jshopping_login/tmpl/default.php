<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login">
<?php if ($params->get('greeting')) : ?>
   <!-- <br/> -->
	<div class="jshop_login_name">
	<?php if ($params->get('name')) : {
		echo sprintf( _JSHOP_HINAME, $user->get('name') );
		echo "!";
	} else : {
		echo sprintf( _JSHOP_HINAME, $user->get('username') );
		echo "!";
	} endif; ?>
	</div>
<?php endif; ?>
    <div class="jshop_login_link">
        <a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=myaccount', 1); ?>"><?php print JText::_('MY_ACCOUNT')?></a>
    </div>
  <!--  <br/> -->
	<div class="jshop_login_logout" align="center">
		<button type="submit" class="uk-button"><?php print JText::_('LOGOUT') ?></button>
		<!--<input type="submit" name="Submit" class="uk-button" value="<?php print JText::_('LOGOUT') ?>" /> -->
	</div>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php else : ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var modlogin = 1;';
		$document = JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif; ?>




	<div class="module  mod-login clearfix">
		<div class="modcontent clearfix">

			<ul class="yt-loginform menu">
				<li class="yt-login">
					<a class="login-switch" data-toggle="modal" href="#myLogin" title="">
						Вход		</a>
					<div id="myLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true" style="display: none;">

						<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" class="uk-form">
							<fieldset data-uk-margin>
							<?php echo $params->get('pretext'); ?>
							<div id="form-login-username">
								<!--<label for="modlgn_username"><?php echo JText::_('USERNAME') ?></label>-->
								<input id="modlgn_username" type="text" name="username" class="uk-margin-small-top" alt="username" size="18" placeholder="<?php echo JText::_('USERNAME') ?>" />
							</div>
							<div id="form-login-password">
								<!--<label for="modlgn_passwd"><?php echo JText::_('PASSWORD') ?></label>-->
								<input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="18" alt="password" placeholder="<?php echo JText::_('PASSWORD') ?>"/>
							</div>
							<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
								<div id="form-login-remember" class="control-group checkbox">
									<label class="control-label" for="modlgn-remember"><?php echo JText::_('REMEMBER_ME') ?></label>
									<input id="modlgn-remember" class="inputbox" type="checkbox" value="yes" name="remember">
								</div>
							<?php endif; ?>
							<div class="form-login-button"><button class="uk-button" type="submit" name="Submit"><?php echo JText::_('LOGIN') ?></button></div>
							<!--<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />-->

							<div class="form-login-reset">
								<a href="<?php echo JRoute::_( 'index.php?option=com_users&view=reset'); ?>"><?php print JText::_('LOST_PASSWORD') ?></a>
							</div>
							<?php /*<div>
	    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
    </div> */ ?>

							<?php echo $params->get('posttext'); ?>

							<input type="hidden" name="option" value="com_jshopping" />
							<input type="hidden" name="controller" value="user" />
							<input type="hidden" name="task" value="loginsave" />
							<input type="hidden" name="return" value="<?php echo $return; ?>" />
							<?php echo JHTML::_( 'form.token' ); ?>
							</fieldset>
						</form>
						<button type="button" class="btn btn-default btnClose" data-dismiss="modal"><i class="fa fa-times"></i></button>
					</div>
				</li>
				<li class="yt-register">

					<?php
					$usersConfig = JComponentHelper::getParams( 'com_users' );
					if ($usersConfig->get('allowUserRegistration')) : ?>
						<div class="form-login-register">
							<a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=register', 1); ?>"><?php print JText::_('REGISTRATION') ?></a>
						</div>
					<?php endif; ?>
					<?php echo $params->get('posttext'); ?>

					<input type="hidden" name="option" value="com_jshopping" />
					<input type="hidden" name="controller" value="user" />
					<input type="hidden" name="task" value="loginsave" />
					<input type="hidden" name="return" value="<?php echo $return; ?>" />
					<?php echo JHTML::_( 'form.token' ); ?>

				</li>
				<!--
                <li class="jshop-checkout">
                    <a href="/index.php/shopping/shop-basket/view">Checkout</a>
                </li>
                -->
			</ul>

		</div>
	</div>


	<!--
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" class="form-inline">
	<?php echo $params->get('pretext'); ?>

	<p id="form-login-username">
		<label for="modlgn_username"><?php echo JText::_('USERNAME') ?></label>
		<input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="18" />
	</p>
	<p id="form-login-password">
		<label for="modlgn_passwd"><?php echo JText::_('PASSWORD') ?></label>
		<input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="18" alt="password" />
	</p>
	<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
	<div id="form-login-remember" class="control-group checkbox">
        <label class="control-label" for="modlgn-remember"><?php echo JText::_('REMEMBER_ME') ?></label>
        <input id="modlgn-remember" class="inputbox" type="checkbox" value="yes" name="remember">
	</div>
	<?php endif; ?>
	<button class="uk-button" type="submit" name="Submit"><?php echo JText::_('LOGIN') ?></button>
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />

	<div>
	    <a href="<?php echo JRoute::_( 'index.php?option=com_users&view=reset'); ?>"><?php print JText::_('LOST_PASSWORD') ?></a>
    </div>
    <?php /*<div>
	    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
    </div> */ ?>
	<?php
	$usersConfig = JComponentHelper::getParams( 'com_users' );
	if ($usersConfig->get('allowUserRegistration')) : ?>
	<div>
		<a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=register', 1); ?>"><?php print JText::_('REGISTRATION') ?></a>
	</div>
	<?php endif; ?>
	<?php echo $params->get('posttext'); ?>

	<input type="hidden" name="option" value="com_jshopping" />
    <input type="hidden" name="controller" value="user" />
	<input type="hidden" name="task" value="loginsave" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
-->

<?php endif; ?>