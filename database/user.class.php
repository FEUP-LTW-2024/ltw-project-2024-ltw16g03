<?php
  declare(strict_types = 1);

  class User {
    public int $UserID;
    public string $RealName;
    public string $Username;
    public string $Email;
    public int $IsAdmin;
    public string $ImageURL;

    public function __construct(int $UserID, string $RealName, string $Username, string $Email, int $IsAdmin, string $ImageURL)
    {
      $this->UserID = $UserID;
      $this->RealName = $RealName;
      $this->Username = $Username;
      $this->Email = $Email;
      $this->IsAdmin = $IsAdmin;
      $this->ImageURL = $ImageURL;
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
          $user['ImageURL']
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
        $user['ImageURL']
      );
    }
  }
?>