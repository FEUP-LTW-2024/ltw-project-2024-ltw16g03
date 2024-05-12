<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php');
  require_once(__DIR__ . '/../database/user.class.php'); 

  $db = getDatabaseConnection();

  // Retrieve item ID
  $ItemID = (int) $_GET["item"];

  // Remove item from session cart
  $session->removeItemFromCart($ItemID);

  // Remove item from database table if user is logged in
  if ($session->isLoggedIn()) {
    User::removeFromCart($db, $session->getId(), $ItemID);
  }
?>