<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $session->getId());

  drawHeader($session);
?>
  <main>
    <form class="edit_profile_inputs">  
      <img class="profile_picture" src="<?=$user->ImageURL?>" alt="A image representative of the profile"/>
          <section class="input_fields">
              <input class="input_info" type="text" name="text" placeholder="<?=$user->RealName?>">
              <input class="input_info" type="email" name="email" placeholder="<?=$user->Email?>">
              <input class="input_info" type="text" name="text" placeholder="<?=$user->Username?>">
              <input class="input_info" type="password" name="current_password" placeholder="current password">
              <input class="input_info" type="password" name="new_password" placeholder="new password">
              <input class="input_info" type="password" name="password" placeholder="confirm password">
          </section>
          <button formaction="edit_profile.php" formmethod="post" type="submit">
              SAVE
          </button>
      </form>    
  </main>

<?php drawFooter();?>
