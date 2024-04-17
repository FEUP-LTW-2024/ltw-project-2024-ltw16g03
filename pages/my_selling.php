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
        <main>
            <h1>SELLING</h1>
            <section class="selling_items">
                <article>
                    <img src="https://picsum.photos/500" alt="template" height = "200" width = "200"/>
                    <label>PRICE<p>20</p></label>
                    <label>Nome do artigo<p>Gelado</p></label>
                    <p class="color"></p>
                    <p class="size">XL</p>
                    <form>
                        <button formaction="sell.php" formmethod="post" type="submit">
                            EDIT 
                        </button>
                    </form>
                </article>
                <article>
                    <img src="https://picsum.photos/500" alt="template" height = "200" width = "200"/>
                    <label>PRICE<p>20</p></label>
                    <label>Nome do artigo<p>Gelado</p></label>
                    <p class="color"></p>
                    <p class="size">XL</p>
                    <form>
                        <button formaction="sell.php" formmethod="post" type="submit">
                            EDIT 
                        </button>
                    </form>
                </article>
            </section>
            <h1>SOLD</h1>
            <section class="sold_items">
                <article>
                    <img src="https://picsum.photos/500" alt="template" height = "200" width = "200"/>
                    <label>PRICE<p>20</p></label>
                    <label>Nome do artigo<p>Gelado</p></label>
                    <p class="color"></p>
                    <p class="size">XL</p>
                </article>
                <article>
                    <img src="https://picsum.photos/500" alt="template" height = "200" width = "200"/>
                    <label>PRICE<p>20</p></label>
                    <label>Nome do artigo<p>Gelado</p></label>
                    <p class="color"></p>
                    <p class="size">XL</p>
                </article>
            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>