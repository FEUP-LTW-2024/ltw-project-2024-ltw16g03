<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  
  if (!$session->isLoggedIn()) {
    echo 'ERROR';
    exit();
  }

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php'); 

  $db = getDatabaseConnection();
  
  // Add item to database table
  User::removeFromWishlist($db, $session->getId(), (int) $_GET["item"]);
?>