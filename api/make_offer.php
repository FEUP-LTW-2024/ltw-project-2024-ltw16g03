<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/proposal.class.php');
  require_once(__DIR__ . '/../database/item.class.php');
  require_once(__DIR__ . '/../database/message.class.php');

  $db = getDatabaseConnection();

  // Check if item doens't already have a proposal
  $itemID = (int) $_GET['id'];
  $item = Item::getItem($db, $itemID);
  $price = (float) $_GET['price'];

  $previousProposal = Proposal::getPendingProposal($db, $itemID, $session->getId());
  if ($previousProposal != null) {
    // Update
    Proposal::updateProposal($db, $previousProposal->ProposalID, $price);
    
    // Send Update Message
    Message::updateProposalMessage($db, $previousProposal->ProposalID);
    exit();
  }
  
  // Create new proposal
  Proposal::createProposal($db, $itemID, $session->getId(), $price);
  $currentProposal = Proposal::getPendingProposal($db, $itemID, $session->getId());
  // Send Proposal Message
  Message::sendNewProposalMessage($db, $session->getId(), $item->OwnerID, $currentProposal->ProposalID);
?>