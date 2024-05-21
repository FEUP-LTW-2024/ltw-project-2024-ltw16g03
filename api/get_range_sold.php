<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php');

  $db = getDatabaseConnection();

  $items = Item::getThreeOrders($db, (int) $_GET['number'], $session->getId());

  echo json_encode($items);
?>