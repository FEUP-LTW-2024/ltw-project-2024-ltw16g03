<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <header>
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>
            <form action="../actions/action_login.php" method="post" class="login">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <a href="../pages/register.php">Register</a>
                <button type="submit">Login</button>
            </form>  
            <nav class="buttons">
                <a href="wishlist.php">
                    <img src="../assets/wishlist.svg" alt="wishlist" height="50"/>
                </a>
                <a href="profile.php">
                    <img src="../assets/profile.svg" alt="profile" height="50"/>
                </a>
                <a href="shopping_cart.php">
                    <img src="../assets/cart.svg" alt="shopping cart" height="50"/>
                </a>
                <a href="sell.php">Sell</a>
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