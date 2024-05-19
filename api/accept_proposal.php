<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/proposal.class.php'); 
  require_once(__DIR__ . '/../database/message.class.php'); 

  $db = getDatabaseConnection();

  $proposalId = (int) $_GET["proposal"];

  Proposal::accept($db, $proposalId);
  Message::acceptProposalMessage($db, $proposalId);
?>