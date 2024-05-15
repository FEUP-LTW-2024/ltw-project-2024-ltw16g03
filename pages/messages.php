<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../templates/common.tpl.php');

  $messages = Message::getMessages($db, $session->getId(), $_GET['id']);
  $mainUser = User::getUser($db, $session->getId());;
  $otherUser = "";

  drawHeader($session);
?>
        <main id="main_messages">
            <?php 
                if ($messages[0]->SenderID == $session->getId()) {
                    $otherUser = User::getUser($db, $messages[0]->ReceiverID);
                } else {
                    $otherUser = User::getUser($db, $messages[0]->SenderID);
                }
            ?>
            <?php foreach($messages as $message) {
                if ($message->SenderID == $session->getId()) { ?>
                <article class="message user">
                    <p class="username"><?=$mainUser->Username?></p>
                <?php } else { ?>
                <article class="message other">
                    <p class="username"><?=$otherUser->Username?></p>
                <?php } ?>
                    <p class="content"><?=$message->Content?></p>
                </article> 
            <?php } ?>
            <form id="message_input">
                <input class="input_info" data-sender="<?=$session->getId()?>" data-receiver="<?=$otherUser->UserID?>" data-userName="<?=$mainUser->Username?>" name="message" type="text" placeholder="Message"/>
                <button class="plain-button"><img src="../assets/send.png" alt="search"></button>
            </form>
        </main>

<?php drawFooter(); ?>