<?php
  declare(strict_types = 1);

  class User {
    public int $UserID;
    public string $RealName;
    public string $Username;
    public string $Email;
    public string $ImageUrl;
    public int $IsAdmin;

    public function __construct(int $UserID, string $RealName, string $Username, string $Email, string $ImageUrl, int $IsAdmin)
    {
      $this->UserID = $UserID;
      $this->RealName = $RealName;
      $this->Username = $Username;
      $this->Email = $Email;
      $this->ImageUrl = $ImageUrl;
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
          $user['ImageUrl'],
          $user['IsAdmin']
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
        $user['ImageUrl'],
        $user['IsAdmin']
      );
    }

    static function isUsernameTaken(PDO $db, string $username, ?int $userID = null) : bool {
      $sql = "SELECT 1 FROM User WHERE lower(Username) = ?";
    $params = [strtolower($username)];
    
    if ($userID !== null) {
        $sql .= " AND UserID != ?";
        $params[] = $userID;
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return (bool) $stmt->fetch();
    }

    static function isEmailTaken(PDO $db, string $email, ?int $userID = null) : bool {
      $sql = "SELECT 1 FROM User WHERE lower(Email) = ?";
      $params = [strtolower($email)];
      
      if ($userID !== null) {
          $sql .= " AND UserID != ?";
          $params[] = $userID;
      }
  
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
      return (bool) $stmt->fetch();
    }

    static function deleteUser(PDO $db, int $id) : void {
      $stmt = $db->prepare('
        DELETE FROM User 
        WHERE UserID = ?
      ');
      $stmt->execute(array($id));
    }

    static function promoteAdmin(PDO $db, int $id) : void {
      $stmt = $db->prepare(
        'UPDATE User SET IsAdmin = 1 where UserID = ?');
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

    static function getWishlist(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT ItemID
        FROM Wishlist 
        WHERE UserID = ?
      ');

      $itemsID = array();
      $stmt->execute(array($id));
      while ($item = $stmt->fetch()) {
        $itemsID[] = (int) $item['ItemID'];
      }

      return $itemsID;
    }
  
    static function addToWishlist(PDO $db, int $userID, int $itemID) {
      $stmt = $db->prepare('
        INSERT INTO Wishlist (UserID, ItemID) 
        VALUES (?, ?)
      ');

      $stmt->execute(array($userID, $itemID));
    }

    static function removeFromWishlist(PDO $db, int $userID, int $itemID) {
      $stmt = $db->prepare('
       DELETE FROM Wishlist 
       WHERE UserID = ? AND ItemID = ?
     ');

     $stmt->execute(array($userID, $itemID));
    }

    static function getUserSellingItemsID(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT ItemID
        FROM Item 
        WHERE UserID = ? AND IsSold = 0
      ');
      $stmt->execute(array($id));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = (int) $item['ItemID'];
      }
  
      return $items;
    }

    static function searchUsers(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT * FROM User WHERE Username LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));
  
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['UserID'],
          $user['RealName'],
          $user['Username'],
          $user['Email'],
          $user['ImageUrl'],
          $user['IsAdmin']
        );
      }
  
      return $users;
    }

    static function getUsers(PDO $db) : array {
      $stmt = $db->prepare('SELECT * FROM User LIMIT 3');
      $stmt->execute(array());
  
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['UserID'],
          $user['RealName'],
          $user['Username'],
          $user['Email'],
          $user['ImageUrl'],
          $user['IsAdmin']
        );
      }
      return $users;
    }

    static function createAccount(PDO $db, User $user, string $password) : bool {
      $stmt = $db->prepare('INSERT INTO User (RealName, Username, Password, ImageUrl, Email, IsAdmin) VALUES
             (:RealName, :Username, :Password, :ImageUrl, :Email, :IsAdmin)');

      $stmt->bindParam(':RealName', $user->RealName);
      $stmt->bindParam(':Username', $user->Username);
      $stmt->bindParam(':Password', $password);
      $stmt->bindParam(':ImageUrl', $user->ImageUrl);
      $stmt->bindParam(':Email', $user->Email);
      $stmt->bindParam(':IsAdmin', $user->IsAdmin);

      return $stmt->execute();
    }

    static function editAccount(PDO $db, User $user, string $password) : bool {
      $stmt = $db->prepare('UPDATE User 
      SET RealName = :RealName, 
          Username = :Username, 
          Password = :Password, 
          ImageUrl = :ImageUrl,
          Email = :Email, 
          IsAdmin = :IsAdmin 
      WHERE UserID = :UserID');

      $stmt->bindParam(':UserID', $user->UserID);
      $stmt->bindParam(':RealName', $user->RealName);
      $stmt->bindParam(':Username', $user->Username);
      $stmt->bindParam(':Password', $password);
      $stmt->bindParam(':ImageUrl', $user->ImageUrl);
      $stmt->bindParam(':Email', $user->Email);
      $stmt->bindParam(':IsAdmin', $user->IsAdmin);

      return $stmt->execute();
    }

    static function updateProfileImage(PDO $db, int $userid, string $ImageUrl) : bool {
      $stmt = $db->prepare('UPDATE User SET ImageUrl = :ImageUrl WHERE UserID = :id');
      $stmt->bindParam(':ImageUrl', $ImageUrl);
      $stmt->bindParam(':id', $userid);
      return $stmt->execute();
    }
  }
?>