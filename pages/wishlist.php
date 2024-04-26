<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  drawClassicHeader(); ?>
    
    

  <?=drawFooter();?>


        
            <h2>6 item(s)</h2>
            <section class="main-items">
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
                <article class="display_item">
                    <a href="#"><img class = "item_img" src="https://picsum.photos/400" alt="" height = "200"/></a>
                    <section class="item_info">
                        <p>10.00 $</p>
                        <p>H&M</p>
                        <p>XS</p>
                    </section>
                    <section class="item_buttons">
                        <img src="../assets/wishlist.svg" alt="wishlist" height = "20"/>
                        <button class="add-to-cart">ADD TO CART</button>
                    </section>
                </article>
            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>