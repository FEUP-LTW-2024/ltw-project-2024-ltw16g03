<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../database/item.class.php'); 
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $wishItems = Item::getUserWishlist($db, $session->getId());

  if (empty($wishItems)) die(header('Location: ../pages/wishlist_empty.php'));
?>
    <?=drawClassicHeader("WISHLIST");?>
    
            <main id="main-wishlist">
                    <h2><?=count($wishItems)?> item(s)</h2>
                    <section class="main-items">
                        <?php foreach ($wishItems as $item) { ?>
                        <article class="display_item">
                            <a href="../pages/item.php?id=<?=urlencode((string)$item->ItemID)?>"><img class = "item_img" src="../assets/uploads_item/<?=$item->ItemID?>.jpg" alt=""/></a>
                            <section class="item_info">
                                <p><?=$item->Price?> €</p>
                                <p><?=$item->Brand?></p>
                                <p><?=$item->Dimension?></p>
                            </section>
                            <section class="item_buttons">
                                <img class="wishlist" data-itemId="<?=$item->ItemID?>" src="../assets/wishlisted.svg" alt="wishlist" height = "20"/>
                                <button class="add-to-cart" data-item='<?=json_encode($item)?>'>ADD TO CART</button>
                            </section>
                        </article>
                        <?php } ?>
                    </section>
                    <section class="confirm pop_up">
                        <img class="cross" src="../assets/cross.svg" alt="cross" height = "40" width = "40"/>
                        <p>Adding the item to the cart will remove it from the wishlist. Do you want to proceed?</p>
                        <button>CONTINUE</button>
                    </section>
                </main>

    <?=drawFooter();?>