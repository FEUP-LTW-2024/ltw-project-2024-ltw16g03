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
                            <p class="username"><?=htmlspecialchars($mainUser->Username)?></p>
                    <?php } else { ?>
                        <article class="message other">
                            <p class="username"><?=htmlspecialchars($otherUser->Username)?></p>
                        <?php } ?>
                            <p class="content"><?=htmlspecialchars($message->Content)?></p>
                        </article> 
                <?php } else {
                    $proposal = Proposal::getProposalByID($db, $message->ProposalID);
                    $item = Item::getItem($db, $proposal->ItemID);
                    if ($message->SenderID == $session->getId()) { ?>
                        <article class="message user">
                            <p class="username"><?=htmlspecialchars($mainUser->Username)?></p>
                    <?php } else { ?>
                        <article class="message other">
                            <p class="username"><?=htmlspecialchars($otherUser->Username)?></p>
                    <?php } ?>
                            <article class="offer_display">
                                <h1 class="offer_title"><?=htmlspecialchars($message->Content)?></h1>
                                <a href="../pages/item.php?id=<?=urlencode((string) $item->ItemID)?>"><img class="offer_image" src="<?=$item->ImageUrl?>" alt=""></a>
                                <section class="prices">
                                    <h1 class="crossed_out"><?=htmlspecialchars($item->Price)?> €</h1>
                                    <h1><?=htmlspecialchars($proposal->Price)?> €</h1>
                                </section>
                            <?php if ($proposal->BuyerID != $session->getId() and $proposal->CurrentState === 0) { ?>
                                <button class="accept_proposal" data-proposal="<?=$proposal->ProposalID?>">ACCEPT</button>
                                <button class="reject_proposal" data-proposal="<?=$proposal->ProposalID?>">REJECT</button>
                            <?php } ?>
                            <?php if ($proposal->CurrentState === 1 and $proposal->BuyerID == $session->getId()) { 
                                $item->Price = $proposal->Price; ?>
                                <?php if (!$session->isInCart($item->ItemID)) {?>
                                <button class="add_proposal" data-item='<?=json_encode($item)?>'>ADD TO CART</button>
                                <?php } else { ?>
                                <button class="remove_proposal" data-item='<?=json_encode($item)?>'>REMOVE FROM CART</button>
                                <?php } ?>
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