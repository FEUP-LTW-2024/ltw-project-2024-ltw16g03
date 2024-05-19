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
  $currentUser = $session->isLoggedIn() ? User::getUser($db, $session->getId()) : null;

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
                    <p class="price big"><?=$item->Price?> €</p>
                    <p class="name big"><?=$item->ItemName?></p>
                    <section class="tags2">
                        <div class="color-square3 <?=$item->Color?>"></div>
                        <div class="size-square3"><?=$item->Dimension?></span>
                    </section>
                    <div>
                        <p><?=$item->Detail?></p>
                    </div>
                    <section class="buttons">
                        <?php if ($currentUser && $currentUser->UserID === $item->OwnerID) { ?>
                            <a href="edit_item.php?id=<?=$item->ItemID?>"><button class="edit-item">EDIT</button></a>
                        <?php } else { ?>
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
                        <?php } ?>  
                    </section>
                </section>
            </article>
            <?php if (!($currentUser && $currentUser->UserID === $item->OwnerID)) { ?>
            <article class="seller-details">
                <div class="seller-info">
                    <img class="seller-picture" src="<?=$user->ImageUrl?>" alt="profile picture">
                    <div class="seller-info2">
                        <p class="seller-username"><?=$user->Username?></p>
                        <button class="make-offer">MAKE AN OFFER</button>
                        <a href="../pages/messages.php?id=<?=$user->UserID?>"><button class="ask-seller">ASK SELLER</button></a>
                    </div>
                </div>
            </article>
            <section class="offer pop_up">
                <img class="cross" src="../assets/cross.svg" alt="cross" height = "40" width = "40"/>
                <h1>MAKE AN OFFER</h1>
                <p class="crossed_out"><?=$item->Price?> €</p>
                <section class="proposal">
                    <input class="input_underlined" type="number" min="0" max="<?=$item->Price?>" name="offer" placeholder="<?=$item->Price?>">
                    <p> €</p>
                </section>
                <button>SUBMIT</button>
            </section>
            <?php } ?>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>
    </body>
</html>