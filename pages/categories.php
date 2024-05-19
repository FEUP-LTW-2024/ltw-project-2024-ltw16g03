<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/sizes.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/item.class.php'); 
  require_once(__DIR__ . '/../database/type.class.php'); 
  require_once(__DIR__ . '/../database/condition.class.php');
  
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();

  $search = isset($_GET['search']) ? $_GET['search'] : '';

  if (!$session->isLoggedIn()) {
    $items = Item::getAllSellingItems($db);
    $wishlist = array();
    if ($search != '') {
        $items = Item::searchItemsByName($db, $search); 
    }
  }
  else {
    $items = Item::getNonUserSellingItems($db, $session->getId());
    $wishlist = User::getWishlist($db, $session->getId());
    if ($search != '') {
        $items = Item::searchNonUserItemsByName($db, $search, $session->getId());    
    }
  }

  $types = Type_::getAllTypes($db);
  $conditions = Condition::getAllConditions($db); 
?>

<?=drawHeader($session);?>

<?=drawSHOPNOW();?>
        <main id="categories_page">
            <aside class="filters">
                <form class="filters_container">
                    <h1>FILTERS</h1>

                    <h2>CATEGORIES</h2>
                    <label><input type="radio" name="CATEGORIES" value="1" onchange="filterItems()">Women</label>
                    <label><input type="radio" name="CATEGORIES" value="2" onchange="filterItems()">Men</label>
                    <label><input type="radio" name="CATEGORIES" value="3" onchange="filterItems()">Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="4" onchange="filterItems()">Baby</label>

                    <div id="sizeOptionsSell" class="size-options"></div>

                    <h2>TYPE</h2>
                    <?php foreach ($types as $type): ?>
                        <label>
                            <input type="checkbox" name="TYPE" value="<?php echo $type['TypeID']; ?>" <?php echo ($_GET['type'] === $type['TypeName']) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($type['TypeName']); ?>
                        </label>
                    <?php endforeach; ?>


                    <h2>CONDITION</h2>
                    <?php foreach ($conditions as $condition): ?>
                        <label>
                            <input type="checkbox" name="CONDITION" value="<?php echo $condition['ConditionID']; ?>" <?php echo ($_GET['condition'] === $condition['ConditionName']) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($condition['ConditionName']); ?>
                        </label>
                    <?php endforeach; ?>

                    <h2>COLOUR</h2>
                    
                    <?php
                    $colors = [
                        "red", "yellow", "blue", "green", "orange", 
                        "purple", "pink", "brown", "gray", "black", 
                        "white", "rainbow"
                    ];
                    foreach ($colors as $color) {?>
                        <input type="checkbox" id="<?=$color?>" name="color" value="<?=$color?>" hidden>
                        <label class="color-swatch <?=$color?>" for="<?=$color?>"></label>
                    <?php } ?>

                    <h2>PRICE</h2>
                    <label for="minPrice" id="minPriceLabel">Min Price:</label>
                    <input type="number" id="minPrice" name="minPrice" min="0">
                    <label for="maxPrice" id="maxPriceLabel">Max Price:</label>
                    <input type="number" id="maxPrice" name="maxPrice" min="0">

                </form>
            </aside>
            <section class="main-items">
                <?php if (empty($items)) { ?>

                    <p>No items found for the search term "<?= htmlspecialchars($search) ?>".</p>
                <?php } else { ?>
                    <?php foreach ($items as $item) { ?>
                        <article class="display_item" data-category="<?=$item->CategoryID?>" data-size="<?=$item->Dimension?>" data-color="<?=$item->Color?>" data-type="<?=$item->TypeID?>" condition-type="<?=$item->ConditionID?>">
                            <a href="../pages/item.php?id=<?=urlencode($item->ItemID)?>"><img class="item_img" src="<?=$item->ImageUrl?>" alt=""/></a>
                            <section class="item_info">
                                <p><?=htmlspecialchars($item->Price)?> €</p>
                                <p><?=htmlspecialchars($item->Brand)?></p>
                                <p><?=htmlspecialchars($item->Dimension)?></p>
                            </section>
                            <section class="item_buttons">
                                <?php if (in_array($item->ItemID, $wishlist)) {?>
                                <img class="remove_from_wishlist" data-itemId="<?=$item->ItemID?>" src="../assets/wishlisted.svg" alt="wishlisted" height = "20"/>
                                <?php } else { ?>
                                <img class="wishlist" data-itemId="<?=$item->ItemID?>" src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                                <?php } ?>
                                <?php if (!$session->isInCart($item->ItemID)) {?>
                                <button class="add-to-cart" data-item='<?=json_encode($item)?>'>ADD TO CART</button>
                                <?php } else { ?>
                                <button class="remove_from_cart gray" data-item='<?=json_encode($item)?>'>REMOVE</button>
                                <?php } ?>
                            </section>
                        </article>
                    <?php } ?>
                <?php } ?>
            </section>
        </main>

<?=drawFooter();?>
