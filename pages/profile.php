<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/item.class.php'); 

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php'); 

  $db = getDatabaseConnection();
  $user = User::getUser($db, $session->getId());
  $sellingItems = Item::getUserSellingItems($db, $session->getID());
  $previousOrder = Item::getUserPreviousOrders($db, $session->getID());
  drawHeader($session);
?>
    <main id="profile_main">
        <section class="my-account">
            <h1>MY ACCOUNT</h1>
            <section class="secondary_info">
                <img class="profile_picture" src="<?=$user->ImageUrl?>" alt="A image representative of the profile"/>
                <a href="edit_profile.php" class="option_link">Edit Profile</a>
                <a href="my_selling.php" class="option_link">My Sellings</a>
                <a id="account_delete" class="option_link">Delete Account</a>
                <?php if ($user->IsAdmin): ?> <a href="admin.php" class="option_link" id="isadmin">Admin</a>  <?php endif; ?>
            </section>
            <ul>
                <li class="display_info"><?=htmlspecialchars($user->RealName)?></li>
                <li class="display_info"><?=htmlspecialchars($user->Email)?></li>
                <li class="display_info"><?=htmlspecialchars($user->Username)?></li>
            </ul>
        </section>

        <section class="selling image_display">
            <h1>SELLING</h1>
            <?php output_item_display($sellingItems); ?>
        </section>

        <section class="previous-orders image_display">
            <h1>PREVIOUS ORDERS</h1>
            <?php output_item_display($previousOrder); ?>
        </section>

        <form action="../actions/action_logout.php" method="post" class="logout">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <button type="submit" formaction="../actions/action_logout.php">Logout</button>
        </form>

        <form class="delete pop_up" hidden>
            <img class="cross" src="../assets/cross.svg" alt="cross" height = "40" width = "40"/>
            <p>Are you sure you want to delete your account?</p>
            <p>If you are write DELETE in the following field: </p>
            <input class="input_info" type="text" name="confirm" placeholder="DELETE">
            <button formaction="../actions/action_delete.php" formmethod="post" type="submit">CONFIRM</button>
        </form>
    </main>

<?php drawFooter(); ?>