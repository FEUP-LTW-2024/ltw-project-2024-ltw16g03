<?php
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));
?>
    <?=drawHeader($session);?>
        <main id="profile_main">
            <section class="my-account">
                <h1>MY ACCOUNT</h1>
                <section class="secondary_info">
                    <img class="profile_picture" src="https://picsum.photos/500" alt="A image representative of the profile"/>
                    <a href="edit_profile.php">Edit Profile</a>
                    <a href="my_selling.php">My Sellings</a>
                </section>
                <ul>
                    <li class="display_info">name</li>
                    <li class="display_info">email</li>
                    <li class="display_info">username</li>
                </ul>
            </section>

            <section class="selling image_display">
                <h1>SELLING</h1>
                <button class="left_arrow">
                    <img src="../assets/left_arrow.png" alt="Button Image">
                </button>
                <section class="images">
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                </section>
                <button class="right_arrow">
                    <img src="../assets/right_arrow.png" alt="Button Image">
                </button>
            </section>

            <section class="previous-orders image_display">
                <h1>PREVIOUS ORDERS</h1>
                <button class="left_arrow">
                    <img src="../assets/left_arrow.png" alt="Button Image">
                </button>
                <section class="images">
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                    <a href="#" class="item_image">
                        <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
                    </a>
                </section>
                <button class="right_arrow">
                    <img src="../assets/right_arrow.png" alt="Button Image">
                </button>
            </section>

            <form action="../actions/action_logout.php" method="post" class="logout">
                <button type="submit" formaction="../actions/action_logout.php">Logout</button>
            </form>
    <?=drawFooter();?>