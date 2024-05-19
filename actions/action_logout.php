<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  
  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../pages/homepage.php');
    exit();
  }
  
  $session->logout();

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>