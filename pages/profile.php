<?php
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php'); 

  $db = getDatabaseConnection();
  $user = User::getUser($db, $session->getId());

  drawHeader($session);
?>
    <main id="profile_main">
        <section class="my-account">
            <h1>MY ACCOUNT</h1>
            <section class="secondary_info">
                <img class="profile_picture" src="https://picsum.photos/500" alt="A image representative of the profile"/>
                <a href="edit_profile.php">Edit Profile</a>
                <a href="my_selling.php">My Sellings</a>
            </section>
            <ul>
                <li class="display_info"><?=$user->RealName?></li>
                <li class="display_info"><?=$user->Email?></li>
                <li class="display_info"><?=$user->Username?></li>
            </ul>
        </section>

        <section class="selling image_display">
            <h1>SELLING</h1>
            <?php output_item_display(); ?>
        </section>

        <section class="previous-orders image_display">
            <h1>PREVIOUS ORDERS</h1>
            <?php output_item_display(); ?>
        </section>

        <form action="../actions/action_logout.php" method="post" class="logout">
            <button type="submit" formaction="../actions/action_logout.php">Logout</button>
        </form>
    </main>

<?php drawFooter(); ?>