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
            <section class="sell_information">
                <h1>SELL</h1>
                <div class="sell_images">
                    <!-- EU TINHA FEITO COM SCROLL MAS ACHEI Q FICOU FEIO XXXXXXXXXXXXXXXXXXXX -->
                    <img src="https://picsum.photos/500" alt="template" height = "200" width = "200"/>
                </div> 
                <label class="description">DESCRIPTION
                <textarea name="description" r ows="5" cols="60">
                </textarea>
                </label>

                <label>CATEGORIES
                <input type="radio" name="CATEGORIES" value="Women">Women
                <input type="radio" name="CATEGORIES" value="Men">Men
                <input type="radio" name="CATEGORIES" value="Kids">Kids
                <input type="radio" name="CATEGORIES" value="Home">Home
                </label>

                <label>SIZE
                <input type="radio" name="SIZE" value="XL">XL
                <input type="radio" name="SIZE" value="L">L
                <input type="radio" name="SIZE" value="M">M
                <input type="radio" name="SIZE" value="S">S
                <input type="radio" name="SIZE" value="XS">XS
                </label>

                <label>COLOUR
                <input type="radio" name="COLOUR" value="None">None
                </label>

                <label>PRICE
                    <h6>20</h2>
                </label>

                <label>BRAND
                    <h6>jura que tem brand?</h2>
                </label>

            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>