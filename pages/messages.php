<?php
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  require_once(__DIR__ . '/../database/proposal.class.php');
  require_once(__DIR__ . '/../database/item.class.php');
  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../templates/common.tpl.php');

  $messages = Message::getMessages($db, $session->getId(), $_GET['id']);
  $mainUser = User::getUser($db, $session->getId());
  $otherUser = User::getUser($db, $_GET['id']);

  drawHeader($session);
?>
        <main id="main_messages">
            <?php foreach($messages as $message) { 
                if ($message->ProposalID === null) {
                    if ($message->SenderID == $session->getId()) { ?>
                        <article class="message user">
                            <p class="username"><?=$mainUser->Username?></p>
                    <?php } else { ?>
                        <article class="message other">
                            <p class="username"><?=$otherUser->Username?></p>
                        <?php } ?>
                            <p class="content"><?=$message->Content?></p>
                        </article> 
                <?php } else {
                    $proposal = Proposal::getProposalByID($db, $message->ProposalID);
                    $item = Item::getItem($db, $proposal->ItemID);
                    if ($message->SenderID == $session->getId()) { ?>
                        <article class="message user">
                            <p class="username"><?=$mainUser->Username?></p>
                    <?php } else { ?>
                        <article class="message other">
                            <p class="username"><?=$otherUser->Username?></p>
                    <?php } ?>
                            <article class="offer_display">
                                <h1 class="offer_title"><?=$message->Content?></h1>
                                <a href="../pages/item.php?id=<?=$item->ItemID?>"><img class="offer_image" src="<?=$item->ImageUrl?>" alt=""></a>
                                <section class="prices">
                                    <p class="crossed_out"><?=$item->Price?> €</p>
                                    <p><?=$proposal->Price?> €</p>
                                </section>
                            <?php if ($proposal->BuyerID != $session->getId()) { ?>
                                <button>ACCEPT</button>
                                <button>REJECT</button>
                            <?php } ?>
                            </article>
                        </article>
                <?php } ?>
            <?php } ?>
            <form id="message_input">
                <input class="input_info" data-receiver="<?=$otherUser->UserID?>" data-userName="<?=$mainUser->Username?>" name="message" type="text" placeholder="Message"/>
                <button class="plain-button"><img src="../assets/send.png" alt="search"></button>
            </form>
        </main>

<?php drawFooter(); ?>