<?php 
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php'); 
  require_once(__DIR__ . '/../database/item.class.php'); 
  
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();
  $item = Item::getItem($db, $_GET['id']);
  $user = User::getUser($db, $item->OwnerID);

  if (!$session->isLoggedIn()) {
    $wishlist = array();
  }
  else {
    $wishlist = User::getWishlist($db, $session->getId());
  }
?>

<?=drawHeader($session);?>

        <main id="item_page">
            <article class="item">
                <img class="big-image-item" src="<?=$item->ImageUrl?>" alt="template" height = "500" width = "500"/>
                <section class="info">
                    <p class="price big"><?=$item->Price?> $</p>
                    <p class="name big"><?=$item->ItemName?></p>
                    <section class="tags2">
                        <div class="color-square3 <?=$item->Color?>"></div>
                        <div class="size-square3"><?=$item->Dimension?></span>
                    </section>
                    <div>
                        <p><?=$item->Detail?></p>
                    </div>
                    <section class="buttons">
                        <?php if (!$session->isInCart($item->ItemID)) {?>
                        <button class="add-to-cart" data-item='<?=json_encode($item)?>'>ADD TO CART</button>
                        <?php } else { ?>
                        <button class="remove_from_cart gray" data-item='<?=json_encode($item)?>'>REMOVE</button>
                        <?php } ?>
                        <?php if (in_array($item->ItemID, $wishlist)) {?>
                        <img class="remove-from-wishlist2" data-itemId="<?=$item->ItemID?>" src="../assets/wishlisted.svg" alt="wishlisted" height = "40" width = "40"/>
                        <?php } else { ?>
                        <img class="add-to-wishlist2" data-itemId="<?=$item->ItemID?>" src="../assets/wishlist.svg" alt="wishlist" height = "40" width = "40"/>
                        <?php } ?>    
                    </section>
                </section>
            </article>
            <article class="seller-details">
                <div class="seller-info">
                    <img class="seller-picture" src="<?=$user->ImageUrl?>" alt="profile picture">
                    <div class="seller-info2">
                        <p class="seller-username"><?=$user->Username?></p>
                        <section class="seller-rating">
                            <img src="../assets/wishlist.svg" alt="star" height = "30" width = "30"/>
                            <img src="../assets/wishlist.svg" alt="star" height = "30" width = "30"/>
                            <img src="../assets/wishlist.svg" alt="star" height = "30" width = "30"/>
                            <img src="../assets/wishlist.svg" alt="star" height = "30" width = "30"/>
                            <img src="../assets/wishlist.svg" alt="star" height = "30" width = "30"/>
                        </section>
                        <button class="make-offer">MAKE AN OFFER</button>
                        <a href="../pages/messages.php?id=<?=$user->UserID?>"><button class="ask-seller">ASK SELLER</button></a>
                    </div>
                </div>
            </article>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>
    </body>
</html>