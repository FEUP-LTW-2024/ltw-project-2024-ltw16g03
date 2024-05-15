<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  $cartItems = $session->getItemsInCart();
  $shippingInfo = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : array();
  $paymentInfo = isset($_SESSION['payment']) ? $_SESSION['payment'] : array();
?>

<?=drawClassicHeader("THANK YOU");?>
        <main>
            <section class="process-order">
                <article class="shipping-left2">
                    <h1 class="shipping-titles2">SHIPPING</h1>
                    <div class="shipping-container"> 
                    <?php if (isset($_SESSION['shipping'])) : ?>
                        <p><?= $_SESSION['shipping']['Name'] . ' ' . $_SESSION['shipping']['LastName'] ?></p>
                        <p><?= $_SESSION['shipping']['Tax'] ?></p>
                        <p><?= $_SESSION['shipping']['Country'] ?></p>
                        <p><?= $_SESSION['shipping']['Address'] ?></p>
                        <p><?= $_SESSION['shipping']['CityState'] ?></p>
                        <p><?= $_SESSION['shipping']['PostalCode'] ?></p>
                        <p><?= $_SESSION['shipping']['Phone'] ?></p>
                    <?php endif; ?>
                    </div>
                </article>
                <article class="shipping-right2">
                    <h1 class="shipping-titles3">PAYMENT</h1>
                    <?php if ($paymentInfo['PaymentMethod'] === 'debit-card') : ?>
                        <div class="payment-option">
                            <label for="debit-card">Debit or Credit Card</label>
                            <img src="../assets/mastercard.png" alt="Debit Card" height="50" width="80">
                        </div>
                        <div class="payment-details">
                            <p>Card information:</p>
                            <p><?= $paymentInfo['CardHolder'] ?></p>
                            <p><?= $paymentInfo['CardNumber'] ?></p>
                            <p><?= $paymentInfo['ExpiryDate'] ?></p>
                        </div>
                    <?php else : ?>
                        <div class="payment-option">
                            <label for="paypal">Paypal</label>
                            <img src="../assets/paypal.png" alt="Paypal" height="50" width="120">
                        </div>
                        <div class="payment-details">
                            <p>You will complete your payment via PayPal.</p>
                        </div>
                    <?php endif; ?>
                </article>
            </section>
            <section class="item-checkout">
                <h1 class="shipping-titles">ITEMS</h1>
                <?php 
                    $total = 0;
                    foreach ($cartItems as $item) { 
                        $total += $item->Price;?>
                        <article class="item-background">
                            <img class="big-image-item" src="<?=$item->ImageURL?>" alt="template"/>
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
                </article>
            </section>
            </section>
            <div class="final-button">
                <button>SHOP AGAIN</button>
                <button id="print_external">PRINT RECEIPT</button>
            </div>
        </main>

<?=drawFooter()?>