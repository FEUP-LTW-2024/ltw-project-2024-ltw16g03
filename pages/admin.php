<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();?>

    <?=drawHeader($session);?>

    <main>
        <h1 class="sub_title">ADMIN</h1>
        <div class="admin">
            <section class="User_admin">
                <h1 class="sub_title3">USERS</h1>
                <section class="search-bar">
                    <form action="../pages/admin.php" method="GET" id="search-form">
                        <input name="search" type="text" placeholder="Search here..."/>
                        <button class="plain-button" type="submit" id="search-button"><img src="../assets/search.png" alt="search"></button>
                    </form>
                </section> 
                <article class="users_promote">
                    <h3>user name</h3>
                    <button class="yellow">
                        Promote to admin
                    </button>
                    <button class="red">
                        Ban user
                    </button>
                </article>
                <a href="#" class="option_link">See more</a>
            </section>
            <section class="Add_New_admin">
                <h1>ADD NEW...</h1>
                <label>Type
                    <input class="input_underlined" type="text" name="Type">
                </label>
                <label class="size">Size
                    <p>Select the categories for which this sizes will be available</p>
                    <label><input type="radio" name="CATEGORIES" value="1">Women</label>
                    <label><input type="radio" name="CATEGORIES" value="2">Men</label>
                    <label><input type="radio" name="CATEGORIES" value="3">Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="4">Baby</label>
                    <input class="input_underlined" type="text" name="Size" placeholder="Size here">
                </label>
                <label>Condition
                    <input class="input_underlined" type="text" name="Type">
                </label>
                <button>
                    Save
                </button>
            </section>
        </div>
    </main>
    

    <?=drawFooter();?>