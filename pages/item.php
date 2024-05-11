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
?>

<?=drawHeader($session);?>

        <main id="item_page">
            <article class="item">
                <img class="big-image-item" src="<?=$item->ImageURL?>" alt="template" height = "500" width = "500"/>
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
                        <button>ADD TO CART</button>
                        <img class="add-to-wishlist2" src="../assets/wishlist.svg" alt="wishlist" height = "40" width = "40"/>
                    </section>
                </section>
            </article>
            <article class="seller-details">
                <div class="seller-info">
                    <img class="seller-picture" src="<?=$user->ImageURL?>" alt="profile picture">
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
                        <button class="ask-seller">ASK SELLER</button>
                    </div>
                </div>
            </article>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>
    </body>
</html>