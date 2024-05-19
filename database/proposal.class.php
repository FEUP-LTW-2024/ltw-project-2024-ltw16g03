<?php
  declare(strict_types = 1);

  class Proposal {
    public int $ProposalID;
    public int $ItemID;
    public int $BuyerID;
    public float $Price;
    public int $CurrentState;

    public function __construct(int $ProposalID, int $ItemID, int $BuyerID, float $Price, int $CurrentState) {
      $this->ProposalID = $ProposalID;
      $this->ItemID = $ItemID;
      $this->BuyerID = $BuyerID;
      $this->Price = $Price;
      $this->CurrentState = $CurrentState;
    }
    
    static function getProposalByID(PDO $db, int $id) : Proposal {
      $stmt = $db->prepare('
        SELECT *
        FROM Proposal
        WHERE ProposalID = ?
      ');

      $stmt->execute(array($id));

      $result = $stmt->fetch();
    
      $proposal = new Proposal(
        $result['ProposalID'],
        $result['ItemID'], 
        $result['BuyerID'],
        $result['Price'],
        $result['CurrentState']
      );

      return $proposal;
    }

    static function getPendingProposal(PDO $db, int $ItemID, int $BuyerID) : ?Proposal {
      $stmt = $db->prepare('
        SELECT *
        FROM Proposal
        WHERE ItemID = ? AND BuyerID = ? AND CurrentState = 0
      ');

      $stmt->execute(array($ItemID, $BuyerID));

      $result = $stmt->fetch();

      if ($result === false) return null;
    
      $proposal = new Proposal(
        $result['ProposalID'],
        $result['ItemID'], 
        $result['BuyerID'],
        $result['Price'],
        $result['CurrentState']
      );

      return $proposal;
    }

    static function getAcceptedProposal(PDO $db, int $ItemID, int $BuyerID) : ?Proposal {
      $stmt = $db->prepare('
        SELECT *
        FROM Proposal
        WHERE ItemID = ? AND BuyerID = ? AND CurrentState = 1
      ');

      $stmt->execute(array($ItemID, $BuyerID));

      $result = $stmt->fetch();

      if ($result === false) return null;
    
      $proposal = new Proposal(
        $result['ProposalID'],
        $result['ItemID'], 
        $result['BuyerID'],
        $result['Price'],
        $result['CurrentState']
      );

      return $proposal;
    }

    static function createProposal(PDO $db, int $ItemID, int $BuyerID, float $Price) {
      $stmt = $db->prepare('
        INSERT INTO PROPOSAL (ItemID, BuyerID, Price, CurrentState) 
        VALUES (?, ?, ?, 0)
      ');

      $stmt->execute(array($ItemID, $BuyerID, $Price));
    }

    static function updateProposal(PDO $db, int $ProposalID, float $Price) {
      $stmt = $db->prepare('
        UPDATE Proposal
        SET Price = ?
        WHERE ProposalID = ?
      ');

      $stmt->execute(array($Price, $ProposalID));
    }

    static function accept(PDO $db, int $ProposalID) {
      $stmt = $db->prepare('
        UPDATE Proposal
        SET CurrentState = 1
        WHERE ProposalID = ?
      ');

      $stmt->execute(array($ProposalID));
    }

    static function reject(PDO $db, int $ProposalID) {
      $stmt = $db->prepare('
        UPDATE Proposal
        SET CurrentState = 2
        WHERE ProposalID = ?
      ');

      $stmt->execute(array($ProposalID));
    }
  }
?>