<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session) { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="../javascript/script.js" defer></script>
        <script src="../javascript/delete_account.js" defer></script>
        <script src="../javascript/cart.js" defer></script>
    </head>
    <body>
        <header>
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>

            <section class="search-bar">
                <button id="filter-button"><img src="../assets/filter.png" alt="filter"></button>
                <div class="dropdown" id="filter-dropdown">
                    <a href="#">Clothing</a>
                    <a href="#">Shoes</a>
                    <a href="#">Bags</a>
                    <a href="#">Accessories</a>
                    <a href="#">Beauty</a>
                    <a href="#">Grooming</a>
                    <a href="#">Toys / Games</a>
                    <a href="#">Baby Care</a>
                    <a href="#">Buggies</a>
                    <a href="#">School Supplies</a>
                    <a href="#">Textiles</a>
                    <a href="#">Home accessories</a>
                    <a href="#">Tableware</a>
                    <a href="#">Celebrations</a>
                </div>
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var filterButton = document.getElementById("filter-button");
                var dropdown = document.getElementById("filter-dropdown");

                // Toggle dropdown when filter button is clicked
                filterButton.addEventListener("click", function(event) {
                    event.stopPropagation(); // Prevent click event from propagating to document
                    if (dropdown.style.display === "none") {
                        dropdown.style.display = "block";
                    } else {
                        dropdown.style.display = "none";
                    }
                });

                // Hide dropdown when clicking outside of it
                document.body.addEventListener("click", function(event) {
                    if (!dropdown.contains(event.target) && event.target !== filterButton) {
                        dropdown.style.display = "none";
                    }
                });
            });
        </script>
<?php } ?>

<?php function drawClassicHeader($string) { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="../javascript/script.js" defer></script>
        <script src="../javascript/cart.js" defer></script>
    </head>
    <body>
        <header class="classic">
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>
            <h1><?=$string?></h1>                       
        </header>
<?php } ?>

<?php function drawFooter() { ?>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>
<?php } ?>

<?php function drawSHOPNOW() { ?>
    <div class="categories-squares">
        <a class="moving-text">SHOP NOW! SHOP NOW! SHOP NOW! SHOP NOW!</a>
    </div>
<?php } ?>

<?php function drawEmpty(string $string, string $subtitle, bool $wishlist, bool $shop) { ?>
    <main class="empty">
        <img src="../assets/sad_disco_ball.png" alt="disco ball"/>           
        <p> <?=$string?> </p>
        <p class="description"> <?=$subtitle?> </p>
        <?php if ($wishlist): ?>
            <a href="categories.php"><button>WISHLIST</button></a>
            <?php endif; ?>
        <?php if ($shop): ?>
            <a href="categories.php"><button>SHOP NOW!</button></a>
            <?php endif; ?>
    </main>
<?php } ?> 