<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  if ($_POST['confirm'] != 'DELETE') {
    header('Location: ../pages/profile.php');
    exit();
  }

  // Logout 
  $session->logout();
  // Remove account and any reference from database
  User::deleteUser($db, $session->getId());
  // Go to home page
  header('Location: ../pages/homepage.php');
?>