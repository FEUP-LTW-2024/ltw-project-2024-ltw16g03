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
            <form class="register_inputs" action="../actions/action_register.php" method="post">  
                <img class="profile_picture" src="" alt=""/>
                <section class="input_fields">
                    <input class="input_info" type="text" name="RealName" placeholder="name">
                    <input class="input_info" type="email" name="Email" placeholder="email">
                    <input class="input_info" type="text" name="Username" placeholder="username">
                    <input class="input_info" type="password" name="Password" placeholder="password">
                    <input class="input_info" type="password" name="confirm password" placeholder="confirm password">
                </section>
                <button type="submit">Sign Up</button>
            </form>    
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>