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
                    <label><input type="checkbox" name="CATEGORIES" value="1">Women</label>
                    <label><input type="checkbox" name="CATEGORIES" value="2">Men</label>
                    <label><input type="checkbox" name="CATEGORIES" value="3">Kids</label>
                    <label><input type="checkbox" name="CATEGORIES" value="4">House</label>

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
                    <article class="display_item" data-category="<?=$item->CategoryID?>" data-size="<?=$item->Dimension?>" data-color="<?=$item->Color?>">
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

<script>
    // JavaScript for filtering items based on selected checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterItems);
    });

    function filterItems() {
        const selectedCategories = Array.from(document.querySelectorAll('input[name="CATEGORIES"]:checked')).map(checkbox => checkbox.value);
        const selectedSizes = Array.from(document.querySelectorAll('input[name="SIZE"]:checked')).map(checkbox => checkbox.value);
        const selectedColors = Array.from(document.querySelectorAll('input[name="color"]:checked')).map(checkbox => checkbox.value);

        const items = document.querySelectorAll('.display_item');

        items.forEach(item => {
            const category = item.dataset.category;
            const size = item.dataset.size;
            const color = item.dataset.color;

            if (
                (selectedCategories.length === 0 || selectedCategories.includes(category)) &&
                (selectedSizes.length === 0 || selectedSizes.includes(size)) &&
                (selectedColors.length === 0 || selectedColors.includes(color))
            ) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

<?=drawFooter();?>
