<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $db = getDatabaseConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $session->setId(1);
    $session->setName("AFF que chatice esse user.class.php, alguem me ajuda D;");

  }

  die(header('Location: ../pages/login.php'));
?>