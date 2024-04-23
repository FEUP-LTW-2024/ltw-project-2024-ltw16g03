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
        <main>
            <section class="item">
                <article>
                    <img class="big-image-item" src="https://picsum.photos/500" alt="template" height = "500" width = "500"/>
                    <div class="info">
                        <p class="price-big">20.00 $</p>
                        <p class="name-big">Gelado</p>
                        <div class="details">
                            <div class="color-square" style="background-color: yellow;"></div>
                            <div class="size-square" style="background-color: grey;">XS</div>
                        </div>
                        <div class="description">
                            <p>Good condition!</p>
                            <p>Like new!</p>
                            <p>Price Negotiable.</p>
                        </div>
                        <section class="item_buttons2">
                            <button class="add-to-cart2">ADD TO CART</button>
                            <img class="add-to-wishlist" src="../assets/wishlist.svg" alt="wishlist" height = "35" width = "35"/>
                        </section>
                    </div>
                </article>
            </section>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>
    </body>
</html>