<!DOCTYPE html>
<html lang="en-US" data-theme="light">
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
        <main class="profile_main">
            <section class="my-account">
                <h1>MY ACCOUNT</h1>
                <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "150"/>
                <ul>
                    <li>name</li>
                    <li>email</li>
                    <li>username</li>
                </ul>
                <a href="edit_profile.php">Edit profile</a>
            </section>

            <section class="selling">
                <h1>SELLING</h1>
                <article>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                </article>
            </section>

            <section class="previous-orders">
                <h1>PREVIOUS ORDERS</h1>
                <article>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a>
                    <a href="#" class="category-link">
                        <img src="../assets/women.png" alt="women-geral">
                        <span class="category-text">WOMEN</span>
                    </a> 
                </article>
            </section>

            <form>
                <button formaction="register.php" formmethod="post" type="submit">
                    LOGOUT
                </button>
            </form>
            
            </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>