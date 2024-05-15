<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));
?>
    <?=drawHeader($session);?>

        <main id="sell_information">
            <h1 class="sub_title">SELL</h1>
            <?php foreach ($session->getMessages() as $messsage) { ?>
                    <article class="<?=$messsage['type']?>">
                    <?=$messsage['text']?>
                    </article>
                    <?php } ?>
            <form class="sell_form" enctype="multipart/form-data" action="../actions/action_sell.php" method="post">
                <section class="description">
                    <img class = "item_img" src="https://picsum.photos/500" alt="upload photo"/>
                    <input type="file" name="image">
                    <h2>Description</h2>
                    <textarea name="description" rows="4" cols="40"></textarea>
                </section>
                <aside class="filters_container">
                    <label>NAME
                        <input class="input_underlined" type="text" name="name">
                    </label>

                    <h2>CATEGORIES</h2>
                    <label><input type="radio" name="CATEGORIES" value="1" onchange="toggleSizes(this)">Women</label>
                    <label><input type="radio" name="CATEGORIES" value="2" onchange="toggleSizes(this)">Men</label>
                    <label><input type="radio" name="CATEGORIES" value="3" onchange="toggleSizes(this)">Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="4" onchange="toggleSizes(this)">House</label>

                    <div id="sizeOptions" class="size-options"></div>

                    <h2>TYPE</h2>
                    <label><input type="radio" name="TYPE" value="1">Clothing</label>
                    <label><input type="radio" name="TYPE" value="2">Shoes</label>
                    <label><input type="radio" name="TYPE" value="3">Bags</label>
                    <label><input type="radio" name="TYPE" value="4">Accessories</label>
                    <label><input type="radio" name="TYPE" value="5">Beauty</label>
                    <label><input type="radio" name="TYPE" value="6">Grooming</label>
                    <label><input type="radio" name="TYPE" value="7">Toys / Games</label>
                    <label><input type="radio" name="TYPE" value="8">Baby Care</label>
                    <label><input type="radio" name="TYPE" value="9">Buggies</label>
                    <label><input type="radio" name="TYPE" value="10">School Supplies</label>
                    <label><input type="radio" name="TYPE" value="11">Textiles</label>
                    <label><input type="radio" name="TYPE" value="12">Home accesories</label>
                    <label><input type="radio" name="TYPE" value="13">Tableware</label>
                    <label><input type="radio" name="TYPE" value="14">Celebrations</label>
                    
                    <h2>COLOUR</h2>
                    <section class="colour_sell">
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
                        <input type="checkbox" id="rainbow" name="color" value="rainbow" hidden>
                        <label class="color-swatch rainbow" for="rainbow"></label>
                    </section>
                    <section class="price_brand">
                        <label>PRICE
                            <input class="input_underlined" type="text" name="price">
                        </label>
                        <label>BRAND
                            <input class="input_underlined" type="text" name="brand">
                        </label>
                    </section>
                </aside>
                <button type="submit">Sign Up</button>
            </form>
        </main>
        
        <?=drawFooter();?>