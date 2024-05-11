<?php
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  $stmt = $db->prepare('SELECT Item.ImageURL, Item.Price, Item.Brand, Item.dimension, Item.Detail, Cart.quantity
                        FROM Item
                        INNER JOIN Cart ON Item.ItemID = Cart.ItemID
                        WHERE Cart.UserID = :userID
                        ');
  $stmt->bindParam(':userID', $session->getId());

  $stmt->execute();
  $cartItems = $stmt->fetchAll();

  if (empty($cartItems)) die(header('Location: ../pages/shopping_cart_empty.php'));
?>

    <?=drawClassicHeader("CART");?>
    
        <?php 
        $total = 0;
        foreach ($cartItems as $item) { 
            $total += $item['Price'];?>
            <main>
                <section class="item-checkout">
                    <article class="item-background">
                        <img class="big-image-item" src="<?=$item['ImageURL']?>" alt="template" height = "250" width = "250"/>
                        <img class="add-to-wishlist" src="../assets/wishlist.svg" alt="wishlist" height = "35" width = "35"/>
                        <img class="cross eliminate-item" src="../assets/cross.svg" alt="cross" height = "40" width = "40"/>
                        <p class="price2"><?=$item['Price']?> €</p>
                        <div class="info2">
                            <p class="name2"><?=$item['Detail']?></p>
                            <div class="details">
                                <div class="color-square2" style="background-color: yellow;"></div>
                                <div class="size-square2" style="background-color: grey;"><?=$item['dimension']?></div>
                            </div>
                        </div>
                    </article>
                </section>    
            </main>
        <?php } ?>

        <section class="total">
                <article>
                    <div class="items-total">
                        <p><?=count($cartItems)?> items</p>
                        <p class="big-total"><span class="bold-text">TOTAL</span> <?=$total?> €</p>
                    </div>
                    <button class="process-order">PROCESS ORDER</button>
                </article>
            </section>
        </main>

    <?=drawFooter()?>