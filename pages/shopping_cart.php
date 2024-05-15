<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  $db = getDatabaseConnection();

  $cartItems = $session->getItemsInCart();
  if (empty($cartItems)) die(header('Location: ../pages/shopping_cart_empty.php'));
?>

    <?=drawClassicHeader("CART");?>
        
        <main>
            <section class="item-checkout">
            <?php 
            $total = 0;
            foreach ($cartItems as $item) { 
                $total += $item->Price;?>
                <article class="item-background">
                    <img class="big-image-item" src="../assets/uploads_item/<?=$item->ItemID?>.jpg" alt="template"/>
                    <img class="add-to-wishlist" data-itemId="<?=$item->ItemID?>" src="../assets/wishlist.svg" alt="wishlist" height = "35" width = "35"/>
                    <img class="cross eliminate-item" data-itemId="<?=$item->ItemID?>" src="../assets/cross.svg" alt="cross" height = "40" width = "40"/>
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
                    <button class="process-order" onclick="window.location.href = 'process_order.php'">PROCESS ORDER</button>
                </article>
            </section>
        </main>

    <?=drawFooter()?>