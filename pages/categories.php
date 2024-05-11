<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/item.class.php'); 
  
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();
  $items = Item::getAllSellingItems($db);
?>

<?=drawHeader($session);?>

<?=drawSHOPNOW();?>

        <main id="categories_page">
            <aside class="filters">
                <form class="filters_container">
                    <h1>FILTERS</h1>

                    <h2>CATEGORIES</h2>
                    <label><input type="checkbox" name="CATEGORIES" value="Women">Women</label>
                    <label><input type="checkbox" name="CATEGORIES" value="Men">Men</label>
                    <label><input type="checkbox" name="CATEGORIES" value="Kids">Kids</label>
                    <label><input type="checkbox" name="CATEGORIES" value="House">House</label>

                    <h2>SIZE</h2>
                    <label><input type="checkbox" name="SIZE" value="XL">XL</label>
                    <label><input type="checkbox" name="SIZE" value="L">L</label>
                    <label><input type="checkbox" name="SIZE" value="M">M</label>
                    <label><input type="checkbox" name="SIZE" value="S">S</label>
                    <label><input type="checkbox" name="SIZE" value="XS">XS</label>

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

                    <h2>PRICE</h2>
                    <input type="range" name="price_range" min="0" max="100" step="1">
                </form>
            </aside>
            <section class="main-items">
                <?php foreach ($items as $item) { ?>
                    <article class="display_item">
                        <a href="../pages/item.php?id=<?=$item->ItemID?>"><img class = "item_img" src="<?=$item->ImageURL?>" alt="" height = "200"/></a>
                        <section class="item_info">
                            <p><?=$item->Price?> €</p>
                            <p><?=$item->Brand?></p>
                            <p><?=$item->Dimension?></p>
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
