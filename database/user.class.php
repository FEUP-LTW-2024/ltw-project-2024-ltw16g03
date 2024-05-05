<?php
  declare(strict_types = 1);

  class User {
    public int $UserID;
    public string $Username;
    public string $Email;
    public int $IsAdmin;

    public function __construct(int $UserID, string $Username, string $Email, int $IsAdmin)
    {
      $this->UserID = $UserID;
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
          $user['Username'],
          $user['Email'],
          $user['IsAdmin'],
        );
      } else return null;
    }
  }
?>