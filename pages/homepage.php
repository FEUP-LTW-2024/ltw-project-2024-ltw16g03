<?php?>

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
        <main>
            <nav class="categories">
                <ul>
                    <li><a href="categories.php">All Categories</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Kids</a></li>
                    <li><a href="#">House</a></li>
                </ul>
            </nav>

            <section class="big-image">
                <img src="../assets/homepage_big.jpg" alt="homepage big">
                <a class="slogan">READY TO UP-LIFT YOUR OUTFIT?</a>
            </section>

            <div class="categories-squares">
                <a class="moving-text">SHOP NOW! SHOP NOW! SHOP NOW! SHOP NOW!</a>
            </div>

            <div class="items-homepage">
                <div class="row">
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/men.png" alt="men-geral">
                        <span class="category-text">MEN</span>
                    </a>
                </div>
                <div class="row">
                    <a href="#" class="category-link">
                        <img src="../assets/kids.png" alt="kids-geral">
                        <span class="category-text">KIDS</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/home.png" alt="home-geral">
                        <span class="category-text">HOUSE</span>
                    </a>
                </div>
            </div>

        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>