<?php
  declare(strict_types = 1);

  class Message {
    public int $MessageID;
    public int $SenderID;
    public int $ReceiverID;
    public string $Content;
    public DateTime $Timestamp;

    public function __construct(int $MessageID, int $SenderID, int $ReceiverID, string $Content, DateTime $Timestamp) {
      $this->MessageID = $MessageID;
      $this->SenderID = $SenderID;
      $this->ReceiverID = $ReceiverID;
      $this->Content = $Content;
      $this->Timestamp = $Timestamp;
    }
    
    static function getChats(PDO $db, int $id) {
      $stmt = $db->prepare('
      SELECT m.MessageID, m.SenderID, m.ReceiverID, m.Content, m.TimeStamp
      FROM Messages m
      JOIN (
        SELECT 
          CASE
            WHEN SenderID = :user_id THEN ReceiverID
            ELSE SenderID
          END AS CorrespondentID,
          MAX(Timestamp) AS LatestTimestamp, MessageID
          FROM Messages
        WHERE SenderID = :user_id OR ReceiverID = :user_id
        GROUP BY CorrespondentID
      ) AS latest_msg
      ON (m.MessageID = latest_msg.MessageID)');
        
      $stmt->bindParam(':user_id', $id);

      $stmt->execute();

      $results = $stmt->fetchAll();
        
      foreach ($results as $result) {
        $message = new Message(
          $result['MessageID'],
          $result['SenderID'], 
          $result['ReceiverID'],
          $result['Content'],
          DateTime::createFromFormat('Y-m-d H:i:s', $result['Timestamp'])
        );
        $messages[] = $message;
      }

      return $messages;
    }

    static function getMessages(PDO $db, int $user, int $other) : array {
      // Prepare the SQL query
      $stmt = $db->prepare('
      SELECT * 
      FROM Messages 
      WHERE (SenderID = :user1 AND ReceiverID = :user2) 
        OR (SenderID = :user2 AND ReceiverID = :user1)
      ORDER BY Timestamp ASC');

      // Bind the user IDs to the placeholders
      $stmt->bindParam(':user1', $user);
      $stmt->bindParam(':user2', $other);

      // Execute the query
      $stmt->execute();

      // Fetch the results
      $results = $stmt->fetchAll();

      foreach ($results as $result) {
        $message = new Message(
          $result['MessageID'],
          $result['SenderID'], 
          $result['ReceiverID'],
          $result['Content'],
          DateTime::createFromFormat('Y-m-d H:i:s', $result['Timestamp'])
        );
        $messages[] = $message;
      }

      return $messages;
    }

    static function sendMessage(PDO $db, int $senderID, int $receiverID, string $content) {
      // Prepare the SQL query
      $stmt = $db->prepare('
      INSERT INTO Messages (SenderID, ReceiverID, Content, Timestamp) 
      VALUES (?, ?, ?, CURRENT_TIMESTAMP)');

      // Execute the query
      $stmt->execute(array($senderID, $receiverID, $content));
    }
  }
?>