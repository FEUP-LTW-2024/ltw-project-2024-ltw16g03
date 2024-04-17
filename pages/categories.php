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
            <div class="search-bar">
                <div class="search">
                    <button id="filter-button"><img src="../assets/filter.png" alt="filter"></button>
                    <input type="text" placeholder="Search here..."/>
                    <button id="search-button"><img src="../assets/search.png" alt="search"></button>
                </div>
            </div> 
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
        <main class="categories">
            <div class="categories-squares">
                <a>SHOP NOW!</a>
                <a>SHOP NOW!</a>
                <a>SHOP NOW!</a>
            </div>
            <aside class="filters">
                <h2>FILTERS</h2>
                <label for="CATEGORIES">CATEGORIES
                    <input type="radio" name="CATEGORIES" value="Women">Women
                    <input type="radio" name="CATEGORIES" value="Men">Men
                    <input type="radio" name="CATEGORIES" value="Kids">Kids
                    <input type="radio" name="CATEGORIES" value="Home">Home
                </label>

                <label for="SIZE">SIZE 
                    <input type="radio" name="SIZE" value="XL">XL
                    <input type="radio" name="SIZE" value="L">L
                    <input type="radio" name="SIZE" value="M">M
                    <input type="radio" name="SIZE" value="S">S
                    <input type="radio" name="SIZE" value="XS">XS
                </label>

                <label for="COLOUR">COLOUR
                    <input type="radio" name="COLOUR" value="None">None
                </label>

                <label for="PRICE">PRICE
                    <p name="PRICE">20</p>
                </label>
            </aside>
            <section class="items-homepage">
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
                        <span class="category-text">HOME</span>
                    </a>
                </div>
            </section> 
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>