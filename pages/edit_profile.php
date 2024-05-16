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
    <form class="edit_profile_inputs" action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
      <img id="previewImage" class="profile_picture" src="<?=$user->ImageUrl?>" alt="A image representative of the profile"/>
          <section class="input_fields">
              <input type="file" id="fileInput" name="image">
              <label for="fileInput" class="upload_label"></i> Upload Image</label>
              <input class="input_info" type="text" name="RealName" placeholder="<?=$user->RealName?>" value="<?=$user->RealName?>">
              <input class="input_info" type="email" name="Email" placeholder="<?=$user->Email?>" value="<?=$user->Email?>">
              <input class="input_info" type="text" name="Username" placeholder="<?=$user->Username?>" value="<?=$user->Username?>">
              <input class="input_info" id="important" type="password" name="current_password" placeholder="current password">
              <input class="input_info" type="password" name="new_password" placeholder="new password (optional)">
              <input class="input_info" type="password" name="password" placeholder="confirm password (optional)">
          </section>
          <?php foreach ($session->getMessages() as $messsage) { ?>
                <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
                </article>
                <?php } ?>
              <button type="submit">SAVE</button>
      </form>    
  </main>

<?php drawFooter();?>
