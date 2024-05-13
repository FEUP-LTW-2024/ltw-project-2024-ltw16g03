<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php');
  require_once(__DIR__ . '/../database/user.class.php'); 

  $db = getDatabaseConnection();

  // Retrieve item data
  $item = new Item(...json_decode($_GET["item"], true));
  
  // Add item to session cart
  $added = $session->addItemToCart($item);
  // Add item to database table if user is logged in
  if ($session->isLoggedIn() and $added) {
    User::addToCart($db, $session->getId(), $item->ItemID);
  }
?>