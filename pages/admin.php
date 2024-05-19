<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  $db = getDatabaseConnection();
  $users = User::getUsers($db);
?>

    <?=drawHeader($session);?>

    <main>
        <h1 class="sub_title">ADMIN</h1>
        <div class="admin">
            <section class="User_admin">
                <h1 class="sub_title3">USERS</h1>
                <section class="search-bar">
                    <input id="searchUser" name="search" type="text" placeholder="Search here..."/>
                </section> 
                <section id="users_promote">
                    <?php  foreach ($users as $user) { ?>
                        <article class="show_users">
                            <h3><?=htmlspecialchars($user->Username)?></h3>
                            <button class="yellow button1promote" data-userid="<?=$user->UserID?>">Promote</button>
                            <button class="red button2ban" data-userid="<?=$user->UserID?>">Ban</button>
                        </article>
                    <?php } ?>
                </section>
            </section>
            <section class="Add_New_admin">
                <h1>ADD NEW...</h1>
                <form action="../actions/action_add_new.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
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
                    <input class="input_underlined" type="text" name="Condition">
                </label>
                <?php foreach ($session->getMessages() as $message) { ?>
                <article class="<?=$message['type']?>">
                <?=htmlspecialchars($message['text'])?>
                </article>
                <?php } ?>
                <button type="submit">
                    Save
                </button>
                </form>
            </section>
        </div>
    </main>
    

    <?=drawFooter();?>