<?php
  declare(strict_types = 1);

  class User {
    public int $UserID;
    public string $Username;
    public string $Passcode;
    public string $Email;
    public string $IsAdmin;

    public function __construct(int $UserID, string $Username, string $Passcode, string $Email, string $IsAdmin)
    {
      $this->UserID = $UserID;
      $this->Username = $Username;
      $this->Passcode = $Passcode;
      $this->Email = $Email;
      $this->IsAdmin = $IsAdmin;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE User SET Username = ?, Email = ?
        WHERE UserID = ?
      ');

      $stmt->execute(array($this->Username, $this->Email, $this->UserID));
    }
    
    static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {

      $stmt = $db->prepare('
        SELECT UserID, Username, Passcode, Email, IsAdmin
        FROM User 
        WHERE Username = :username AND Passcode = :password
        ');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

      $stmt->execute();
  
      if ($User = $stmt->fetch()) {
        return new User(
          $User['UserID'],
          $User['Username'],
          $User['Passcode'],
          $User['Email'],
          $User['IsAdmin']
        );
      } else return null;
    }

    static function getUser(PDO $db, int $UserID) : User {
      $stmt = $db->prepare('
        SELECT UserID, Username, Passcode, Email, IsAdmin
        FROM User 
        WHERE UserUserID = ?
      ');

      $stmt->execute(array($UserID));
      $User = $stmt->fetch();
      
      return new User(
        $User['UserUserID'],
        $User['Username'],
        $User['Passcode'],
        $User['Email'],
        $User['IsAdmin']
      );
    }
  }
?>