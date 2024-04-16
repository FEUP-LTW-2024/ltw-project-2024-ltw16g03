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
            <section class="my_account">
                <h1>MY ACCOUNT</h1>
                <div class="my_account">
                    <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "150"/>
                    <ul>
                        <!-- PARA MUDAR (colocar por php os seguintes dados)XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->
                        <li>name</li>
                        <li>email</li>
                        <li>username</li>
                    </ul>
                    <a href="edit_profile.php">Edit profile</a>
                </div>
            </section>
            <section class="selling">
                <h1>SELLING</h1>
                <article>
                    <!-- PARA MUDAR XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->
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
            <section class="previous_orders">
                <h1>PREVIOUS ORDERS</h1>
                <article>
                    <!-- PARA MUDAR XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->
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