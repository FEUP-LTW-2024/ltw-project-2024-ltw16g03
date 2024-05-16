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
        <script src="../javascript/wishlisting.js" defer></script>
        <script src="../javascript/filters.js" defer></script>
        <script src="../javascript/seeMore.js" defer></script>
        <script src="../javascript/profile.js" defer></script>
        <script src="../javascript/messages.js" defer></script>
        <script src="../javascript/make_offer.js" defer></script>
    </head>
    <body>
        <header>
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>

            <section class="search-bar">
                <button id="filter-button" class="plain-button"><img src="../assets/filter.png" alt="filter"></button>
                <div class="dropdown" id="filter-dropdown">
                    <a href="categories.php?type=Clothing">Clothing</a>
                    <a href="categories.php?type=Shoes">Shoes</a>
                    <a href="categories.php?type=Bags">Bags</a>
                    <a href="categories.php?type=Accessories">Accessories</a>
                    <a href="categories.php?type=Beauty">Beauty</a>
                    <a href="categories.php?type=Grooming">Grooming</a>
                    <a href="categories.php?type=Toys%20/%20Games">Toys / Games</a>
                    <a href="categories.php?type=Baby%20Care">Baby Care</a>
                    <a href="categories.php?type=Buggies">Buggies</a>
                    <a href="categories.php?type=School%20Supplies">School Supplies</a>
                    <a href="categories.php?type=Textiles">Textiles</a>
                    <a href="categories.php?type=Home%20accessories">Home Accessories</a>
                    <a href="categories.php?type=Tableware">Tableware</a>
                    <a href="categories.php?type=Celebrations">Celebrations</a>
                </div>
                <form action="../pages/categories.php" method="GET" id="search-form">
                    <input name="search" type="text" placeholder="Search here..."/>
                    <button class="plain-button" type="submit" id="search-button"><img src="../assets/search.png" alt="search"></button>
                </form>
            </section> 

            <nav class="buttons">
                <a href="homepage.php">Home</a>
                <a href="sell.php">Sell</a>
                <?php if ($session->isLoggedIn()) { ?>
                <a href="chats.php">
                    <img src="../assets/messages.png" alt="messages"/>
                </a>
                <a href="wishlist.php">
                    <img src="../assets/wishlist.svg" alt="wishlist"/>
                </a>
                <?php } ?>
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
                    <li><a href="categories.php?category=Women">Women</a></li>
                    <li><a href="categories.php?category=Men">Men</a></li>
                    <li><a href="categories.php?category=Kids">Kids</a></li>
                    <li><a href="categories.php?category=House">House</a></li>
                </ul>
            </nav>
        </header>
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
        <script src="../javascript/delete_account.js" defer></script>
        <script src="../javascript/cart.js" defer></script>
        <script src="../javascript/wishlisting.js" defer></script>
        <script src="../javascript/order.js" defer></script>
        <link rel="stylesheet" href="../css/style.css" media="print">
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

<?php function drawEmpty(string $string, string $subtitle, bool $wishlist, bool $shop, bool $sell) { ?>
    <main class="empty">
        <img src="../assets/sad_disco_ball.png" alt="disco ball"/>           
        <p> <?=$string?> </p>
        <p class="description"> <?=$subtitle?> </p>
        <?php if ($wishlist): ?>
            <a href="wishlist.php"><button class="red" style="width: 250px">WISHLIST</button></a>
        <?php endif; ?>
        <?php if ($shop): ?>
            <a href="categories.php"><button style="width: 250px;">SHOP NOW!</button></a>
        <?php endif; ?>
        <?php if ($sell): ?>
            <a href="sell.php"><button style="width: 250px;">SELL NOW!</button></a>
        <?php endif; ?>
    </main>
<?php } ?> 