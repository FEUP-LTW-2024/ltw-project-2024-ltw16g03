<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../templates/common.tpl.php');

  $chats = Message::getChats($db, $session->getId());

  if (empty($chats)) die(header('Location: ../pages/empty_chats.php'));
  
  drawHeader($session);
?>
        <main>
            <?php foreach($chats as $chat) { ?>
                <?php if ($chat->SenderID === $session->getId()) {
                $user = User::getUser($db, $chat->ReceiverID);
            } else { 
                $user = User::getUser($db, $chat->SenderID);
            } ?>
            <a href="../pages/messages.php?id=<?=urlencode($user->UserID)?>">
                <article class="messages-container">
                    <section class="one-message">
                        <img class = "profile-img" src="https://picsum.photos/500" alt="photo"/>
                        <div class="message-info">
                            <p class="message-username">
                                <?php if ($chat->SenderID === $session->getId()) {
                                    $user = User::getUser($db, $chat->ReceiverID);
                                    echo htmlspecialchars($user->Username);
                                } else { 
                                    $user = User::getUser($db, $chat->SenderID);
                                    echo htmlspecialchars($user->Username);
                                } ?>
                            </p>
                            <p class="message"><?=htmlspecialchars($chat->Content)?></p>
                            <p class="time"><?=htmlspecialchars($chat->Timestamp->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s'));?></p>
                        </div>
                    </section>
                </article>
            </a>
            <?php } ?>
        </main>

<?php drawFooter(); ?>