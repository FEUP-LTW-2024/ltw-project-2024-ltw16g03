<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 
  
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();
  if (!$session->isLoggedIn()) $items = Item::getAllSellingItems($db);
  else $items = Item::getNonUserSellingItems($db, $session->getId());
?>

<?=drawHeader($session);?>

<?=drawSHOPNOW();?>
        <main id="categories_page">
            <aside class="filters">
                <form class="filters_container">
                    <h1>FILTERS</h1>

                    <h2>CATEGORIES</h2>
                    <label><input type="checkbox" name="CATEGORIES" value="1" onchange="toggleSizes(this)">Women</label>
                    <label><input type="checkbox" name="CATEGORIES" value="2" onchange="toggleSizes(this)">Men</label>
                    <label><input type="checkbox" name="CATEGORIES" value="3" onchange="toggleSizes(this)">Kids</label>
                    <label><input type="checkbox" name="CATEGORIES" value="4" onchange="toggleSizes(this)">House</label>

                    <h2>TYPE</h2>
                    <label><input type="checkbox" name="TYPE" value="1">Clothing</label>
                    <label><input type="checkbox" name="TYPE" value="2">Shoes</label>
                    <label><input type="checkbox" name="TYPE" value="3">Bags</label>
                    <label><input type="checkbox" name="TYPE" value="4">Accessories</label>
                    <label><input type="checkbox" name="TYPE" value="5">Beauty</label>
                    <label><input type="checkbox" name="TYPE" value="6">Grooming</label>
                    <label><input type="checkbox" name="TYPE" value="7">Toys / Games</label>
                    <label><input type="checkbox" name="TYPE" value="8">Baby care</label>
                    <label><input type="checkbox" name="TYPE" value="9">Buggies</label>
                    <label><input type="checkbox" name="TYPE" value="10">School supplies</label>
                    <label><input type="checkbox" name="TYPE" value="11">Textiles</label>
                    <label><input type="checkbox" name="TYPE" value="12">Home accessories</label>
                    <label><input type="checkbox" name="TYPE" value="13">Tableware</label>
                    <label><input type="checkbox" name="TYPE" value="14">Celebrations</label>

                    <div id="sizeOptions" class="size-options"></div>

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
                <?php foreach ($items as $item) { ?>
                    <article class="display_item" data-category="<?=$item->CategoryID?>" data-size="<?=$item->Dimension?>" data-color="<?=$item->Color?>" data-type="<?=$item->TypeID?>">
                        <a href="../pages/item.php?id=<?=$item->ItemID?>"><img class = "item_img" src="<?=$item->ImageURL?>" alt=""/></a>
                        <section class="item_info">
                            <p><?=$item->Price?> €</p>
                            <p><?=$item->Brand?></p>
                            <p><?=$item->Dimension?></p>
                        </section>
                        <section class="item_buttons">
                            <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                            <?php if (!$session->isInCart($item->ItemID)) {?>
                            <button class="add-to-cart" data-item='<?=json_encode($item)?>'>ADD TO CART</button>
                            <?php } else { ?>
                            <button class="remove_from_cart gray" data-item='<?=json_encode($item)?>'>REMOVE</button>
                            <?php } ?>
                        </section>
                    </article>
                <?php } ?>
            </section>
        </main>

<?=drawFooter();?>
