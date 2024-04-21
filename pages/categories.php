<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="script.js" defer></script>
    </head>
    <body>
        <header>
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>

            <section class="search-bar">
                <button id="filter-button"><img src="../assets/filter.png" alt="filter"></button>
                <input type="text" placeholder="Search here..."/>
                <button id="search-button"><img src="../assets/search.png" alt="search"></button>
            </section> 

            <nav class="buttons">
                <a href="homepage.php">Home</a>
                <a href="sell.php">Sell</a>
                <a href="wishlist.php">
                    <img src="../assets/wishlist.svg" alt="wishlist"/>
                </a>
                <a href="profile.php">
                    <img src="../assets/profile.svg" alt="profile"/>
                </a>
                <a href="shopping_cart.php">
                    <img src="../assets/cart.svg" alt="shopping cart"/>
                </a>
            </nav>
            
            <nav class="categories">
                <ul>
                    <li><a href="categories.php">All Categories</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Kids</a></li>
                    <li><a href="#">House</a></li>
                </ul>
            </nav>
        </header>
        <div class="categories-squares">
            <a class="moving-text">SHOP NOW! SHOP NOW! SHOP NOW! SHOP NOW!</a>
        </div>
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
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>