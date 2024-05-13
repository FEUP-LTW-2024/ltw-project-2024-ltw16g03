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

<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterItems);
    });

    function toggleSizes(checkbox) {
        var sizeOptions = document.getElementById("sizeOptions");
        sizeOptions.innerHTML = "";
        if (checkbox.checked) {
            var categoryName = checkbox.parentNode.textContent.trim();
            switch (categoryName) {
                case "Women":
                case "Men":
                    sizeOptions.innerHTML = `
                    <h2>SIZE</h2>
                    <label><input type="checkbox" name="SIZE" value="XXL">XXL</label>
                    <label><input type="checkbox" name="SIZE" value="XL">XL</label>
                    <label><input type="checkbox" name="SIZE" value="L">L</label>
                    <label><input type="checkbox" name="SIZE" value="M">M</label>
                    <label><input type="checkbox" name="SIZE" value="S">S</label>
                    <label><input type="checkbox" name="SIZE" value="XS">XS</label>
                    <label><input type="checkbox" name="SIZE" value="XXS">XXS</label>
                    <label><input type="checkbox" name="SIZE" value="37">37</label>
                    <label><input type="checkbox" name="SIZE" value="38">38</label>
                    <label><input type="checkbox" name="SIZE" value="39">39</label>
                    <label><input type="checkbox" name="SIZE" value="40">40</label>
                    <label><input type="checkbox" name="SIZE" value="41">41</label>
                    <label><input type="checkbox" name="SIZE" value="42">42</label>
                    <label><input type="checkbox" name="SIZE" value="43">43</label>
                    <label><input type="checkbox" name="SIZE" value="44">44</label>
                    <label><input type="checkbox" name="SIZE" value="45">45</label>
                    <label><input type="checkbox" name="SIZE" value="46">46</label>
                    <label><input type="checkbox" name="SIZE" value="47">47</label>
                    <label><input type="checkbox" name="SIZE" value="48">48</label>
                    <label><input type="checkbox" name="SIZE" value="49">49</label>
                    <label><input type="checkbox" name="SIZE" value="50">50</label>
                    `;
                    break;
                case "Kids":
                    sizeOptions.innerHTML = `
                    <h2>SIZE</h2>
                    <label><input type="checkbox" name="SIZE" value="0-3 months">0-3 months</label>
                    <label><input type="checkbox" name="SIZE" value="3-6 months">3-6 months</label>
                    <label><input type="checkbox" name="SIZE" value="6-9 months">6-9 months</label>
                    <label><input type="checkbox" name="SIZE" value="9-12 months">9-12 months</label>
                    <label><input type="checkbox" name="SIZE" value="12-18 months">12-18 months</label>
                    <label><input type="checkbox" name="SIZE" value="18-24 months">18-24 months</label>
                    <label><input type="checkbox" name="SIZE" value="2-3 years">2-3 years</label>
                    <label><input type="checkbox" name="SIZE" value="3-4 years">3-4 years</label>
                    <label><input type="checkbox" name="SIZE" value="4-5 years">4-5 years</label>
                    <label><input type="checkbox" name="SIZE" value="5-6 years">5-6 years</label>
                    <label><input type="checkbox" name="SIZE" value="6-7 years">6-7 years</label>
                    <label><input type="checkbox" name="SIZE" value="7-8 years">7-8 years</label>
                    <label><input type="checkbox" name="SIZE" value="9-10 years">9-10 years</label>
                    <label><input type="checkbox" name="SIZE" value="10-11 years">10-11 years</label>
                    <label><input type="checkbox" name="SIZE" value="11-12 years">11-12 years</label>
                    <label><input type="checkbox" name="SIZE" value="12-13 years">12-13 years</label>
                    <label><input type="checkbox" name="SIZE" value="13-14 years">13-14 years</label>
                    <label><input type="checkbox" name="SIZE" value="14-15 years">14-15 years</label>
                    <label><input type="checkbox" name="SIZE" value="15-16 years">15-16 years</label>
                    <label><input type="checkbox" name="SIZE" value="15">15</label>
                    <label><input type="checkbox" name="SIZE" value="16">16</label>
                    <label><input type="checkbox" name="SIZE" value="17">17</label>
                    <label><input type="checkbox" name="SIZE" value="18">18</label>
                    <label><input type="checkbox" name="SIZE" value="19">19</label>
                    <label><input type="checkbox" name="SIZE" value="20">20</label>
                    <label><input type="checkbox" name="SIZE" value="21">21</label>
                    <label><input type="checkbox" name="SIZE" value="22">22</label>
                    <label><input type="checkbox" name="SIZE" value="23">23</label>
                    <label><input type="checkbox" name="SIZE" value="24">24</label>
                    <label><input type="checkbox" name="SIZE" value="25">25</label>
                    <label><input type="checkbox" name="SIZE" value="26">26</label>
                    <label><input type="checkbox" name="SIZE" value="27">27</label>
                    <label><input type="checkbox" name="SIZE" value="28">28</label>
                    <label><input type="checkbox" name="SIZE" value="29">29</label>
                    <label><input type="checkbox" name="SIZE" value="30">30</label>
                    <label><input type="checkbox" name="SIZE" value="31">31</label>
                    <label><input type="checkbox" name="SIZE" value="32">32</label>
                    <label><input type="checkbox" name="SIZE" value="33">33</label>
                    <label><input type="checkbox" name="SIZE" value="34">34</label>
                    <label><input type="checkbox" name="SIZE" value="35">35</label>
                    <label><input type="checkbox" name="SIZE" value="36">36</label>
                    `;
                    break;
                default:
                    break;
            }

            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterItems);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterItems);
        });

        const priceInputs = document.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', filterItems);
        });
    });

    function filterItems() {
        const categories = Array.from(document.querySelectorAll('input[name="CATEGORIES"]:checked')).map(checkbox => checkbox.value);
        const sizes = Array.from(document.querySelectorAll('input[name="SIZE"]:checked')).map(checkbox => checkbox.value);
        const colors = Array.from(document.querySelectorAll('input[name="color"]:checked')).map(checkbox => checkbox.value);
        const types = Array.from(document.querySelectorAll('input[name="TYPE"]:checked')).map(checkbox => checkbox.value); 
        const minPrice = document.getElementById('minPrice').value.trim() || 0;
        const maxPrice = document.getElementById('maxPrice').value.trim() || 99999;
        const items = document.querySelectorAll('.display_item');

        items.forEach(item => {
            const category = item.dataset.category;
            const size = item.dataset.size;
            const color = item.dataset.color;
            const type = item.dataset.type;
            const price = parseFloat(item.querySelector('.item_info p:first-child').textContent.trim());

            if (
                (categories.length === 0 || categories.includes(category)) &&
                (sizes.length === 0 || sizes.includes(size)) &&
                (colors.length === 0 || colors.includes(color)) &&
                (types.length === 0 || types.includes(type))  &&
                (price >= minPrice && price <= maxPrice)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
}
</script>

<?=drawFooter();?>
