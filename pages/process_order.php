<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  $cartItems = $session->getItemsInCart();
  if (empty($cartItems)) die(header('Location: ../pages/shopping_cart_empty.php'));
  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));
  
?>

<?=drawClassicHeader("PROCESS ORDER");?>

<main>   
    <form method="POST" action="../actions/action_process_order.php">
    <section class="process-order">
        <article class="shipping-left">
            <h1 class="shipping-titles2">SHIPPING</h1>
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="last-name" placeholder="Last name">
                <input type="text" name="tax-id" placeholder="Tax ID number">
                <input type="text" name="country" placeholder="Country">
                <input type="text" name="address" placeholder="Address">
                <input type="text" name="city" placeholder="City">
                <input type="text" name="state" placeholder="State">
                <input type="text" name="postal-code" placeholder="Postal code">
                <input type="text" name="phone" placeholder="Phone">
        </article>
        <article class="shipping-right">
            <h1 class="shipping-titles2">PAYMENT</h1>
            <div class="payment-option">
                <input type="radio" name="payment" id="debit-card" value="debit-card">
                <label for="debit-card">Debit or Credit Card</label>
                <img src="../assets/mastercard.png" alt="Debit Card" height = "50" width = "80">
            </div>
            <div class="payment-option">
                <input type="radio" name="payment" id="paypal" value="paypal">
                <label for="paypal">Paypal</label>
                <img src="../assets/paypal.png" alt="Paypal" height = "50" width = "120">
            </div>
            <div class="debit-card-details">
                <input type="text" name="card-holder" placeholder="Card holder">
                <input type="text" name="card-number" placeholder="Card number">
                <input type="text" name="cvv2" placeholder="CVV2 security code">
                <input type="date" name="expiry-date" placeholder="Expiry date">
            </div>
            <div class="paypal-details">
                <p>You will complete your payment via PayPal.</p>
            </div>
        </article>
    </section>
    <section class="item-checkout">
        <h1 class="shipping-titles">ITEMS</h1>
        <?php 
            $total = 0;
            foreach ($cartItems as $item) { 
                $total += $item->Price;?>
                <article class="item-background">
                    <img class="big-image-item" src="<?=$item->ImageUrl?>" alt="template"/>
                    <p class="price2"><?=$item->Price?> €</p>
                    <div class="info2">
                        <p class="name2"><?=$item->Detail?></p>
                        <section class="details">
                            <span class="color-square2 <?=$item->Color?>"></span>
                            <span class="size-square2" style="background-color: grey;"><?=$item->Dimension?></span>
                        </section>
                    </div>
                </article>  
        <?php } ?>
    </section>
    <section class="total">
        <article>
            <div class="items-total">
                <p><?=count($cartItems)?> items</p>
                <p class="big-total"><span class="bold-text">TOTAL</span> <?=$total?> €</p>
            </div>
            <form class="final-button" action="../actions/action_authorize_payment">
                <button type="submit">AUTHORISE PAYMENT</button>
            </form>
        </article>
        <?php foreach ($session->getMessages() as $messsage) { ?>
        <article class="<?=$messsage['type']?>">
        <?=$messsage['text']?>
        </article>
        <?php } ?>
        <br>
    </section>
    </form>
</main>

<?=drawFooter()?>