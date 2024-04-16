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
            <section class="register_inputs">
                <img src="https://picsum.photos/500" alt="template" height = "100"/>
                <input type="text" name="text" placeholder="name">
                <input type="email" name="email" placeholder="email">
                <input type="text" name="text" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="password" placeholder="confirm password">
            <form>
            <button formaction="register.php" formmethod="post" type="submit">
                SAVE CHANGES 
            </button>
            </form>
            </section> 
            </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>