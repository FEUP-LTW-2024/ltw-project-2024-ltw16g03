<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  drawClassicHeader(); ?>
    
    <?=drawEmpty("YOUR CART IS EMPTY", "See if you have any products in your cart 
  or take a look at our new-in items.", true, true);?>

  <?=drawFooter();?>
