<!DOCTYPE html>
<html lang="en-US" data-theme="light">
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
        <main id="profile_main">
            <section class="my-account">
                <h1>MY ACCOUNT</h1>
                <section class="secondary_info">
                    <img class="profile_picture" src="https://picsum.photos/500" alt="A image representative of the profile"/>
                    <a href="edit_profile.php">Edit Profile</a>
                    <a href="my_selling.php">My Sellings</a>
                </section>
                <ul>
                    <li class="display_info">name</li>
                    <li class="display_info">email</li>
                    <li class="display_info">username</li>
                </ul>
            </section>

            <section class="selling image_display">
                <h1>SELLING</h1>
                <button class="left_arrow">
                    <img src="../assets/left_arrow.png" alt="Button Image">
                </button>
                <section class="images">
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                </section>
                <button class="right_arrow">
                    <img src="../assets/right_arrow.png" alt="Button Image">
                </button>
            </section>

            <section class="previous-orders image_display">
                <h1>PREVIOUS ORDERS</h1>
                <button class="left_arrow">
                    <img src="../assets/left_arrow.png" alt="Button Image">
                </button>
                <section class="images">
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                </section>
                <button class="right_arrow">
                    <img src="../assets/right_arrow.png" alt="Button Image">
                </button>
            </section>

            <button>
                LOGOUT
            </button>
            
            </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>