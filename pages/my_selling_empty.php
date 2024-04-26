<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  drawHeader($session); ?>
  
      <h1 class="sub_title">SELLING</h1>
      <?=drawEmpty("YOUR SELLING LIST IS EMPTY", "Sell some items here!", false, true)?>

      <h1 class="sub_title2">SOLD</h1>
      <?=drawEmpty("YOUR SELLING LIST IS EMPTY", "", false, false)?>

  <?=drawFooter();?>

