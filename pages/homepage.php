<?php // ATENÇÃO, EU DEFINI O TAMANHO DAS IMAGENS DIRETAMENTE NO HTML, 
      // EU N SEI SE ISTO N SERIA UMA QUESTÃO DE DESIGN E PORTANTO PROVAVELMENTE É PARA DEFINIR NO CSS ?>

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
            <div class="search-bar">
                <div class="search">
                    <button id="filter-button"><img src="../assets/filter.png" alt="filter"></button>
                    <input type="text" placeholder="Search here..."/>
                    <button id="search-button"><img src="../assets/search.png" alt="search"></button>
                </div>
            </div> 
            <!--<form action="../actions/action_login.php" method="post" class="login">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <a href="../pages/register.php">Register</a>
                <button type="submit">Login</button>
            </form>-->
            <nav class="buttons">
                <a href="homepage.php">Home</a>
                <a href="sell.php">Sell</a>
                <a> | </a>
                <a href="wishlist.php">
                    <img src="../assets/wishlist.svg" alt="wishlist" height="50"/>
                </a>
                <a href="profile.php">
                    <img src="../assets/profile.svg" alt="profile" height="50"/>
                </a>
                <a href="shopping_cart.php">
                    <img src="../assets/cart.svg" alt="shopping cart" height="50"/>
                </a>
            </nav>                         
        </header>
        <main>
            <!--<form class="search">
                <input type="text" placeholder="Search here..."/>
                <select>
                    <option All Categories>All Categories</option>
                    <option value="Children">Children</option>
                    <option value="Women">Women</option>
                    <option value="Men">Men</option>
                </select>    
            </form>-->
            <!--
            <section id="items">
                <article>
                    <img src="https://picsum.photos/250?1">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
                <article>
                    <img src="https://picsum.photos/250?2">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
                <article>
                    <img src="https://picsum.photos/250?3">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
                <article>
                    <img src="https://picsum.photos/250?4">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
                <article>
                    <img src="https://picsum.photos/250?5">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
                <article>
                    <img src="https://picsum.photos/250?6">
                    <a href="../pages/item.php?id=1">[ITEM NAME]</a>
                    <h2>Price: [ITEM PRICE]</h2>
                    <h2>Size: [ITEM SIZE]</h2>
                </article>
            </section>-->
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>