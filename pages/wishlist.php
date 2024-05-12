<?php
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  $stmt = $db->prepare('SELECT Item.ImageURL, Item.Price, Item.Brand, Item.Dimension 
                        FROM Item
                        INNER JOIN Wishlist ON Item.ItemID = Wishlist.ItemID
                        WHERE Wishlist.UserID = :userID
                        ');
  $stmt->bindParam(':userID', $session->getId());

  $stmt->execute();
  $wishItems = $stmt->fetchAll();

  if (empty($wishItems)) die(header('Location: ../pages/wishlist_empty.php'));
?>
    <?=drawClassicHeader("WISHLIST");?>
            <main id="main-wishlist">
                    <h2><?=count($wishItems)?> item(s)</h2>
                    <section class="main-items">
                        <?php foreach ($wishItems as $item) { ?>
                        <article class="display_item">
                            <a href="#"><img class = "item_img" src="<?=$item['ImageURL']?>" alt=""/></a>
                            <section class="item_info">
                                <p><?=$item['Price']?> €</p>
                                <p><?=$item['Brand']?></p>
                                <p><?=$item['Dimension']?></p>
                            </section>
                            <section class="item_buttons">
                                <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                                <button class="add-to-cart">ADD TO CART</button>
                            </section>
                        </article>
                        <?php } ?>
                    </section>
                </main>

    <?=drawFooter();?>