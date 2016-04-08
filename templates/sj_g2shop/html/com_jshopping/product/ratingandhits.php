<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php if ($this->allow_review || $this->config->show_hits){?>
<div class="rating">
    <?php if ($this->config->show_hits){?>
    <span><?php print $this->product->hits;?></span>
    <?php } ?>
    
    <?php if ($this->allow_review && $this->config->show_hits){?>
    <span> | </span>
    <?php } ?>
    
    <?php if ($this->allow_review){?>
   
    <span>
    <?php print showMarkStar($this->product->average_rating);?>                    
    </span>
    <?php } ?>
</div>
<?php } ?>