<?php
  declare(strict_types = 1);

  class User {
    public int $UserID;
    public string $RealName;
    public string $Username;
    public string $Email;
    public int $IsAdmin;

    public function __construct(int $UserID, string $RealName, string $Username, string $Email, int $IsAdmin)
    {
      $this->UserID = $UserID;
      $this->RealName = $RealName;
      $this->Username = $Username;
      $this->Email = $Email;
      $this->IsAdmin = $IsAdmin;
    }

    static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT *
        FROM User 
        WHERE lower(username) = ?');
        
      $stmt->execute(array(strtolower($username)));

      $user = $stmt->fetch();
  
      if ($user && password_verify($password, $user['Password'])) {
        return new User(
          $user['UserID'],
          $user['RealName'],
          $user['Username'],
          $user['Email'],
          $user['IsAdmin'],
        );
      } else return null;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT *
        FROM User 
        WHERE UserID = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User(
        $user['UserID'],
        $user['RealName'],
        $user['Username'],
        $user['Email'],
        $user['IsAdmin'],
      );
    }

    static function isUsernameTaken(PDO $db, string $username) : bool {
      $stmt = $db->prepare('
        SELECT *
        FROM User 
        WHERE lower(username) = ?
      ');
    
      $stmt->execute(array(strtolower($username)));
      return (bool) $stmt->fetch();
    }

    static function isEmailTaken(PDO $db, string $email) : bool {
      $stmt = $db->prepare('
        SELECT *
        FROM User 
        WHERE lower(email) = ?
      ');

      $stmt->execute(array(strtolower($email)));
      return (bool) $stmt->fetch();
    }

    static function deleteUser(PDO $db, int $id) : void {
      $stmt = $db->prepare('
        DELETE FROM User 
        WHERE UserID = ?
      ');
      $stmt->execute(array($id));
    }

    static function getCart(PDO $db, int $id) : array{
      $stmt = $db->prepare('
        SELECT ItemID
        FROM Cart 
        WHERE UserID = ?
      ');

      $itemsID = array();
      $stmt->execute(array($id));
      while ($item = $stmt->fetch()) {
        $itemsID[] = (int) $item['ItemID'];
      }

      return $itemsID;
    }

    static function addToCart(PDO $db, int $userID, int $itemID) {
      $stmt = $db->prepare('
        INSERT INTO Cart (UserID, ItemID, Quantity) 
        VALUES (?, ?, 1)
      ');

      $stmt->execute(array($userID, $itemID));
    }

    static function removeFromCart(PDO $db, int $userID, int $itemID) {
       $stmt = $db->prepare('
        DELETE FROM Cart 
        WHERE UserID = ? AND ItemID = ?
      ');

      $stmt->execute(array($userID, $itemID));
    }
  }
?>