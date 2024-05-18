<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['shipping'] = array(
        'Name' => $_POST['name'],
        'LastName' => $_POST['last-name'],
        'Tax' => $_POST['tax-id'],
        'Country' => $_POST['country'],
        'Address' => $_POST['address'],
        'CityState' => $_POST['city'] . ', ' . $_POST['state'],
        'PostalCode' => $_POST['postal-code'],
        'Phone' => $_POST['phone']
    );

    $paymentMethod = $_POST['payment'];
    if ($paymentMethod === 'debit-card') {
        $cardNumber = $_POST['card-number'];
        if (strlen($cardNumber) > 4) {
            $maskedCardNumber = str_repeat('*', strlen($cardNumber) - 4) . substr($cardNumber, -4);
        } else {
            $maskedCardNumber = $cardNumber; // If card number is too short, don't mask
        }
        $_SESSION['payment'] = array(
            'PaymentMethod' => $paymentMethod,
            'CardHolder' => $_POST['card-holder'],
            'CardNumber' => $maskedCardNumber,
            'CVV2' => $_POST['cvv2'],
            'ExpiryDate' => $_POST['expiry-date']
        );
    } else {
        $_SESSION['payment'] = array(
            'PaymentMethod' => $paymentMethod
        );
    }

    foreach ($cartItems as $item) {
        var_dump($item);
        $sellerId = $item->OwnerID;
        $buyerId = $session->getId();
        Item::createTransaction($db, $sellerId, $buyerId, $item->ItemID);
    }

    header('Location: ../pages/checkout.php');
    exit;
}