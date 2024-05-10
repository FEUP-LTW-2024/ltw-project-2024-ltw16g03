<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));
?>
    <?=drawHeader($session);?>

        <main id="sell_information">
            <h1 class="sub_title">SELL</h1>
            <form class="sell_form">
                <section class="description">
                    <img class = "item_img" src="https://picsum.photos/500" alt="upload photo"/>
                    <h2>Description</h2>
                    <textarea name="description" rows="4" cols="40"></textarea>
                </section>
                <aside class="filters_container">
                    <label>NAME
                        <input class="input_underlined" type="text" name="name">
                    </label>
                    <h2>CATEGORIES</h2>
                    <label><input type="radio" name="CATEGORIES" value="Women">Women</label>
                    <label><input type="radio" name="CATEGORIES" value="Men">Men</label>
                    <label><input type="radio" name="CATEGORIES" value="Kids">Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="House">House</label>

                    <h2>SIZE</h2>
                    <label><input type="radio" name="SIZE" value="XL">XL</label>
                    <label><input type="radio" name="SIZE" value="L">L</label>
                    <label><input type="radio" name="SIZE" value="M">M</label>
                    <label><input type="radio" name="SIZE" value="S">S</label>
                    <label><input type="radio" name="SIZE" value="XS">XS</label>

                    <h2>TYPE</h2>
                    <label><input type="radio" name="TYPE" value="Clothing">Clothing</label>
                    <label><input type="radio" name="TYPE" value="Shoes">Shoes</label>
                    <label><input type="radio" name="TYPE" value="Bags">Bags</label>
                    <label><input type="radio" name="TYPE" value="Accessories">Accessories</label>
                    <label><input type="radio" name="TYPE" value="Beauty">Beauty</label>
                    <label><input type="radio" name="TYPE" value="Grooming">Grooming</label>
                    <label><input type="radio" name="TYPE" value="Toys / Games">Toys / Games</label>
                    <label><input type="radio" name="TYPE" value="Baby Care">Baby Care</label>
                    <label><input type="radio" name="TYPE" value="Buggies">Buggies</label>
                    <label><input type="radio" name="TYPE" value="School supplies">School Supplies</label>
                    <label><input type="radio" name="TYPE" value="Textiles">Textiles</label>
                    <label><input type="radio" name="TYPE" value="Home accessories">Home accesories</label>
                    <label><input type="radio" name="TYPE" value="Tableware">Tableware</label>
                    <label><input type="radio" name="TYPE" value="Celebrations">Celebrations</label>
                    
                    <h2>COLOUR</h2>
                    <input type="radio" id="red" name="color" value="red" hidden>
                    <label class="color-swatch red" for="red"></label>
                    <input type="radio" id="yellow" name="color" value="yellow" hidden>
                    <label class="color-swatch yellow" for="yellow"></label>
                    <input type="radio" id="blue" name="color" value="blue" hidden>
                    <label class="color-swatch blue" for="blue"></label>
                    <input type="radio" id="green" name="color" value="green" hidden>
                    <label class="color-swatch green" for="green"></label>
                    <input type="radio" id="orange" name="color" value="orange" hidden>
                    <label class="color-swatch orange" for="orange"></label>
                    <input type="radio" id="purple" name="color" value="purple" hidden>
                    <label class="color-swatch purple" for="purple"></label>
                    <input type="radio" id="pink" name="color" value="pink" hidden>
                    <label class="color-swatch pink" for="pink"></label>
                    <input type="radio" id="brown" name="color" value="brown" hidden>
                    <label class="color-swatch brown" for="brown"></label>
                    <input type="radio" id="gray" name="color" value="gray" hidden>
                    <label class="color-swatch gray" for="gray"></label>
                    <input type="radio" id="black" name="color" value="black" hidden>
                    <label class="color-swatch black" for="black"></label>
                    <input type="radio" id="white" name="color" value="white" hidden>
                    <label class="color-swatch white" for="white"></label>
                    <section>
                        <label>PRICE
                            <input class="input_underlined" type="text" name="price">
                        </label>
                        <label>BRAND
                            <input class="input_underlined" type="text" name="brand">
                        </label>
                    </section>
                </aside>
                <button>SAVE</button>
            </form>
        </main>
        
        <?=drawFooter();?>