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
            <article>
                <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "500"/>
                <h1>[ITEM NAME]</h1>
                <h2> [ITEM CATEGORY]</h2>
                <h2>[ITEM SIZE]</h2>
                <h2>[ITEM CONDITION]</h2>
                <p>[LONG DESCRIPTION]</p>
            </article>
            <section class="seller_info">
                <h3>[SELLER NAME]</h3>
                <h3>[SELLER EMAIL]</h3>
                <h3>[SELLER PHONE]</h3>
            </section>
            <button>wishlist</button>
            <button>add to cart</button>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>
    </body>
</html>