<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="script.js" defer></script>
    </head>
    <body onload="onload()">
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
                <a> | </a>
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
        </header>
        <div class="categories-squares">
                <a class="moving-text">SHOP NOW! SHOP NOW! SHOP NOW! SHOP NOW!</a>
            </div>
        <main class="categories_page">
            <aside class="filters">
                
                <h2>FILTERS</h2>

                <h3>CATEGORIES</h3>
                <label for="women"><input type="radio" name="CATEGORIES" value="Women">Women</label>
                <label for="men"><input type="radio" name="CATEGORIES" value="Men">Men</label>
                <label for="kids"><input type="radio" name="CATEGORIES" value="Kids">Kids</label>
                <label for="house"><input type="radio" name="CATEGORIES" value="House">House</label>

                <h3>SIZE</h3>
                <label for="xl"><input type="radio" name="SIZE" value="XL">XL</label>
                <label for="l"><input type="radio" name="SIZE" value="L">L</label>
                <label for="m"><input type="radio" name="SIZE" value="M">M</label>
                <label for="s"><input type="radio" name="SIZE" value="S">S</label>
                <label for="xs"><input type="radio" name="SIZE" value="XS">XS</label>

                <h3>COLOUR</h3>
                <form>
                    <label for="red" class="color-button"><input type="radio" id="red" name="color" value="red" hidden><span class="color-swatch red"></span></label>
                    <label for="yellow" class="color-button"><input type="radio" id="yellow" name="color" value="yellow" hidden><span class="color-swatch yellow"></span></label>
                    <label for="blue" class="color-button"><input type="radio" id="blue" name="color" value="blue" hidden><span class="color-swatch blue"></span></label>
                    <label for="green" class="color-button"><input type="radio" id="green" name="color" value="green" hidden><span class="color-swatch green"></span></label>
                    <label for="orange" class="color-button"><input type="radio" id="orange" name="color" value="orange" hidden><span class="color-swatch orange"></span></label>
                    <label for="purple" class="color-button"><input type="radio" id="purple" name="color" value="purple" hidden><span class="color-swatch purple"></span></label>
                    <label for="pink" class="color-button"><input type="radio" id="pink" name="color" value="pink" hidden><span class="color-swatch pink"></span></label>
                    <label for="brown" class="color-button"><input type="radio" id="brown" name="color" value="brown" hidden><span class="color-swatch brown"></span></label>
                    <label for="gray" class="color-button"><input type="radio" id="gray" name="color" value="gray" hidden><span class="color-swatch gray"></span></label>
                    <label for="black" class="color-button"><input type="radio" id="black" name="color" value="black" hidden><span class="color-swatch black"></span></label>
                    <label for="white" class="color-button"><input type="radio" id="white" name="color" value="white" hidden><span class="color-swatch white"></span></label>
                </form>

                <h3>PRICE</h3>
                <input type="range" name="price_range" min="0" max="100" step="1">

            </aside>
            <section class="main-items">
                <div class = "item">
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/500" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                    <article>
                        <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                        <p>10.00 $</p>
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <p>H&M</p>
                        <button class="add-to-cart">ADD TO CART</button>
                        <p>XS</p>
                    </article>
                </div>
            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>