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
    
    static function getProposal(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT *
        FROM PROPOSAL
        WHERE ProposalID = ?
      ');

      $stmt->execute(array($id));

      $results = $stmt->fetchAll();
      $proposals = array();
    
      foreach ($results as $result) {
        $proposal = new Proposal(
          $result['ProposalID'],
          $result['ItemID'], 
          $result['ReceiverID'],
          $result['Content'],
          $result['ProposalID']
        );
        $proposals[] = $proposal;
      }

      return $proposals;
    }
  }
?>