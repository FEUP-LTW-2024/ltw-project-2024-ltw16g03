<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
?>
  <?=drawClassicHeader();?>
    
  <h1 class="sub_title">MESSAGES</h1>
  <?=drawEmpty("YOU DON'T HAVE ANY MESSAGES YET", "", false, false, false)?>
  <?=drawFooter();?>
