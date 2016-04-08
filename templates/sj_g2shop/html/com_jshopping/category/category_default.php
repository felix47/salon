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
<div class="jshop">
<h2 class="heading"><?php print $this->category->name?></h2>
<?php print $this->category->description?>

<?php if (count($this->categories)){ ?>
<div class="jshop_list_category">

<table class = "jshop list_category">
    <?php foreach($this->categories as $k=>$category){?>
        <?php if ($k%$this->count_category_to_row==0) print "<tr>"; ?>
        <td class="jshop_categ" width="<?php print (100/$this->count_category_to_row)?>%">
          <div class = "category">
            <div class="image">
                <a href = "<?php print $category->category_link;?>"><img class="jshop_img" src="<?php print $this->image_category_path;?>/<?php if ($category->category_image) print $category->category_image; else print $this->noimage;?>" alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" /></a>
            </div>
            <div class="info">
               <a class = "product_link" href = "<?php print $category->category_link?>"><?php print $category->name?></a>
               <p class = "category_short_description"><?php print $category->short_description?></p>
            </div>
           </div>
        </td>    
        <?php if ($k%$this->count_category_to_row==$this->count_category_to_row-1) print '</tr>'; ?>
    <?php } ?>
        <?php if ($k%$this->count_category_to_row!=$this->count_category_to_row-1) print '</tr>'; ?>
</table>
<?php }?>
</div>
<?php include(dirname(__FILE__)."/products.php");?>
</div>