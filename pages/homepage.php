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
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo" height="100"/>           
            </a>
            <form action="../actions/action_login.php" method="post" class="login">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <button type="submit">Login</button>
            </form>                           
        </header>
        <main>
            <nav class="buttons">
                <a href="wishlist.php">
                    <img src="../assets/wishlist.svg" alt="wishlist" height="100"/>
                </a>
                <a href="profile.php">
                    <img src="../assets/profile.svg" alt="profile" height="100"/>
                </a>
                <a href="shopping_cart.php">
                    <img src="../assets/cart.svg" alt="shopping cart" height="100"/>
                </a>
                <a href="sell.php">Sell</a>
            </nav>
            <form class="search">
                <input type="text" placeholder="Search here..."/>
                <select>
                    <option All Categories>All Categories</option>
                    <option value="Children">Children</option>
                    <option value="Women">Women</option>
                    <option value="Men">Men</option>
                </select>    
            </form>
            <section id="items">
                <article>
                    <img src="https://picsum.photos/200?1">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
                <article>
                    <img src="https://picsum.photos/200?2">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
                <article>
                    <img src="https://picsum.photos/200?3">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
                <article>
                    <img src="https://picsum.photos/200?4">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
                <article>
                    <img src="https://picsum.photos/200?5">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
                <article>
                    <img src="https://picsum.photos/200?6">
                    <a href="../pages/itm?id=1">[ITEM NAME]</a>
                    <p>Price: [ITEM PRICE]</p>
                    <p>Size: [ITEM SIZE]</p>
                </article>
            </section>
        </main>
        <footer>
            Retro Club &copy; 2024
        </footer>    
    </body>
</html>