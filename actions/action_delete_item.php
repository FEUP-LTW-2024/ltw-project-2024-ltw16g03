<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../pages/homepage.php');
    exit();
  }

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php');

  $db = getDatabaseConnection();

  // Remove item and any reference from database
  Item::deleteItem($db, (int) $_GET['id']);
  // Go to home page
  header('Location: ../pages/profile.php');
?>