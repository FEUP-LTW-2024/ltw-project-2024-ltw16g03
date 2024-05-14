<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  $cartItems = $session->getItemsInCart();
  $shippingInfo = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : array();
  unset($_SESSION['shipping']);
?>

<?=drawClassicHeader("THANK YOU");?>
        <main>
            <section class="process-order">
                <article class="shipping-left2">
                    <h1 class="shipping-titles2">SHIPPING</h1>
                    <div class="shipping-container"> 
                    <?php foreach ($shippingInfo as $value) : ?>
                        <p><?= $value ?></p>
                    <?php endforeach; ?>
                    </div>
                </article>
                <article class="shipping-right2">
                    <h1 class="shipping-titles3">PAYMENT</h1>
                    <div class="payment-option">
                    
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
            </div>
        </main>

<?=drawFooter()?>