<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  $_SESSION['form_data'] = $_POST;

  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../pages/homepage.php');
    exit();
  }

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/item.class.php');
  require_once(__DIR__ . '/../database/proposal.class.php');

  if ($_SESSION['login_attempts'] >= 5) {
    $session->addMessage('error', 'Too many attempts, please try again later!');
    die(header('Location: ../pages/login.php'));
  }

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $session->setId($user->UserID);
    $session->setName($user->Username);
    // Update database with cart info
    $sessionCart = $session->getItemsInCart();
    $databaseCart = User::getCart($db, $user->UserID);
    $userSelling = User::getUserSellingItemsID($db, $user->UserID);
    // Delete from session cart User owned items
    foreach ($userSelling as $selling) {
      $session->removeItemFromCart($selling);
    }
    foreach ($sessionCart as $item) {
      // If item not in database then 
      if (!in_array($item->ItemID, $databaseCart) && !in_array($item->ItemID, $userSelling)) {
        User::addToCart($db, $user->UserID, $item->ItemID);
      }
    }
    // Update cart with database info
    foreach($databaseCart as $itemID) {
      // Get Item from database
      $item = Item::getItem($db, $itemID);
      // Check if item has proposal
      $proposal = Proposal::getAcceptedProposal($db, $itemID, $session->getId());
      if ($proposal !== null) {
        $item->Price = $proposal->Price;
      } 
      $session->addItemToCart($item);
    }
    $session->addMessage('success', 'Login successful!');
    $_SESSION['login_attempts'] = 0;
  } else {
    if (!isset($_SESSION['login_attempts'])) {
      $_SESSION['login_attempts'] = 0;
    }
    $_SESSION['login_attempts']++;
    $session->addMessage('error', 'Wrong username or password!');
  }

  die(header('Location: ../pages/login.php'));
?>