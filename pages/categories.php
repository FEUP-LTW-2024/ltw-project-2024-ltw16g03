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
                            <?php echo $type['TypeName']; ?>
                        </label>
                    <?php endforeach; ?>


                    <h2>CONDITION</h2>
                    <?php foreach ($conditions as $condition): ?>
                        <label>
                            <input type="checkbox" name="CONDITION" value="<?php echo $condition['ConditionID']; ?>" <?php echo ($_GET['condition'] === $condition['ConditionName']) ? 'checked' : ''; ?>>
                            <?php echo $condition['ConditionName']; ?>
                        </label>
                    <?php endforeach; ?>

                    <h2>COLOUR</h2>
                    <input type="checkbox" id="red" name="color" value="red" hidden>
                    <label class="color-swatch red" for="red"></label>
                    <input type="checkbox" id="yellow" name="color" value="yellow" hidden>
                    <label class="color-swatch yellow" for="yellow"></label>
                    <input type="checkbox" id="blue" name="color" value="blue" hidden>
                    <label class="color-swatch blue" for="blue"></label>
                    <input type="checkbox" id="green" name="color" value="green" hidden>
                    <label class="color-swatch green" for="green"></label>
                    <input type="checkbox" id="orange" name="color" value="orange" hidden>
                    <label class="color-swatch orange" for="orange"></label>
                    <input type="checkbox" id="purple" name="color" value="purple" hidden>
                    <label class="color-swatch purple" for="purple"></label>
                    <input type="checkbox" id="pink" name="color" value="pink" hidden>
                    <label class="color-swatch pink" for="pink"></label>
                    <input type="checkbox" id="brown" name="color" value="brown" hidden>
                    <label class="color-swatch brown" for="brown"></label>
                    <input type="checkbox" id="gray" name="color" value="gray" hidden>
                    <label class="color-swatch gray" for="gray"></label>
                    <input type="checkbox" id="black" name="color" value="black" hidden>
                    <label class="color-swatch black" for="black"></label>
                    <input type="checkbox" id="white" name="color" value="white" hidden>
                    <label class="color-swatch white" for="white"></label>
                    <input type="checkbox" id="rainbow" name="color" value="rainbow" hidden>
                    <label class="color-swatch rainbow" for="rainbow"></label>

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
                        <article class="display_item" data-category="<?=$item->CategoryID?>" data-size="<?=$item->Dimension?>" data-color="<?=$item->Color?>" data-type="<?=$item->TypeID?>" data-condition="<?=$item->Condition?>">
                            <a href="../pages/item.php?id=<?=$item->ItemID?>"><img class = "item_img" src="<?=$item->ImageUrl?>" alt=""/></a>
                            <section class="item_info">
                                <p><?=$item->Price?> €</p>
                                <p><?=$item->Brand?></p>
                                <p><?=$item->Dimension?></p>
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
