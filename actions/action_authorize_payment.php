<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  $cartItems = $session->getItemsInCart();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['temp_cart_items'] = $session->getItemsInCart();
    $session->clearCart();
    header('Location: ../pages/checkout.php');
    exit;
  }

    if (isset($_SESSION['temp_cart_items'])) {
        unset($_SESSION['temp_cart_items']);
        $session->clearCart();
    } 

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ( ! (empty($_POST['name']) || empty($_POST['last-name']) || empty($_POST['tax-id']) || empty($_POST['country']) || empty($_POST['address'])
        || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['postal-code']) || empty($_POST['phone']) || empty($_POST['payment']))) {

            if (strlen($_POST['name']) > 60 || strlen($_POST['last-name']) > 60 || strlen($_POST['tax-id']) > 60 || strlen($_POST['country']) > 60 
            || strlen($_POST['name']) > 60 || strlen($_POST['address']) > 60 || strlen($_POST['city']) > 60 
            || strlen($_POST['state']) > 60 || strlen($_POST['postal-code']) > 60 || strlen($_POST['phone']) > 60) {
                $session->addMessage('error', 'Some inputs are too large');
                die(header('Location: ../pages/process_order.php'));
            }

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
                if ( ! (empty( $_POST['card-number']) ||  empty($_POST['card-holder']) || empty($_POST['cvv2']) || empty($_POST['expiry-date']))) {
                    if (strlen($_POST['card-number']) > 60 || strlen($_POST['card-holder']) > 60 || strlen($_POST['cvv2']) > 60 || strlen($_POST['expiry-date']) > 60 ) {
                        $session->addMessage('error', 'Card inputs are too large');
                        die(header('Location: ../pages/process_order.php'));
                    }
                    else if (!preg_match('/^\d{4}-?\d{4}-?\d{4}-?\d{4}$/', $_POST['card-number'])) {
                        $session->addMessage('error', 'Invalid card number input');
                        die(header('Location: ../pages/process_order.php'));
                    }
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
                    $session->addMessage('error', 'Card fields are required');
                    die(header('Location: ../pages/process_order.php'));
                }

            } else {
                $_SESSION['payment'] = array(
                    'PaymentMethod' => $paymentMethod
                );
            }
        
            foreach ($cartItems as $item) {
                $sellerId = $item->OwnerID;
                $buyerId = $session->getId();
                Item::createTransaction($db, $sellerId, $buyerId, $item->ItemID);
            }
        } else {
            $session->addMessage('error', 'All fields are required');
            die(header('Location: ../pages/process_order.php'));
        }


    header('Location: ../pages/checkout.php');
    exit;
}