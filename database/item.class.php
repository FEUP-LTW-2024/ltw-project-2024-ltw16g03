<?php
  declare(strict_types = 1);

  class Item {
    public int $ItemID;
    public int $OwnerID;
    public int $CategoryID;
    public int $TypeID;
    public string $ItemName;
    public string $Brand;
    public string $Model;
    public string $Dimension;
    public string $Condition;
    public string $Detail;
    public string $Color;
    public float $Price;
    public string $ImageURL;
    public bool $IsSold;

    public function __construct(int $ItemID, int $OwnerID, int $CategoryID, int $TypeID, string $ItemName, string $Brand,
                                string $Model, string $Dimension, string $Condition, string $Detail, string $Color,
                                float $Price, string $ImageURL, bool $IsSold)
    {
        $this->ItemID = $ItemID;
        $this->OwnerID = $OwnerID;
        $this->CategoryID = $CategoryID;
        $this->TypeID = $TypeID;
        $this->ItemName = $ItemName;
        $this->Brand = $Brand;
        $this->Model = $Model;
        $this->Dimension = $Dimension;
        $this->Condition = $Condition;
        $this->Detail = $Detail;
        $this->Color = $Color;
        $this->Price = $Price;
        $this->ImageURL = $ImageURL;
        $this->IsSold = $IsSold;
    }

    static function getUserSellingItems(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 0
      ');
      $stmt->execute(array($id));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function getUserSoldItems(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 1
      ');
      $stmt->execute(array($id));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function getItem(PDO $db, int $id) : Item {
      $stmt = $db->prepare('
        SELECT * 
        FROM Item
        WHERE ItemID = ?
      ');
      $stmt->execute(array($id));

      $item = $stmt->fetch();
      
      return new Item(
        $item['ItemID'],
        $item['UserID'],
        $item['CategoryID'],
        $item['TypeID'],
        $item['ItemName'],
        $item['Brand'],
        $item['Model'],
        $item['Dimension'],
        $item['Condition'],
        $item['Detail'],
        $item['Color'],
        $item['Price'],
        $item['ImageURL'],
        (bool) $item['IsSold']
      );
    }
    
    static function getAllSellingItems(PDO $db) : array {
      $stmt = $db->prepare('
      SELECT * 
      FROM Item
      WHERE IsSold = 0');

      $stmt->execute();
      $items = array();
    
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }

      return $items;
    }

    static function getSomeSellingItem(PDO $db, int $numberOfItems, int $id) {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 0
        LIMIT ?
      ');
      $stmt->execute(array($id, $numberOfItems));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function getThreeSellingItem(PDO $db, int $currItem, int $id) {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 0
        LIMIT 3 OFFSET ?
      ');
      $stmt->execute(array($id, $currItem));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function getSomeSoldItem(PDO $db, int $numberOfItems, int $id) {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 1
        LIMIT ?
      ');
      $stmt->execute(array($id, $numberOfItems));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function getThreeSoldItem(PDO $db, int $currItem, int $id) {
      $stmt = $db->prepare('
        SELECT *
        FROM Item 
        WHERE UserID = ? AND IsSold = 1
        LIMIT 3 OFFSET ?
      ');
      $stmt->execute(array($id, $currItem));
  
      $items = array();
  
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }


    static function getNonUserSellingItems(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT * 
      FROM Item
      WHERE IsSold = 0 AND UserID <> ?');

      $stmt->execute(array($id));
      $items = array();
    
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }

      return $items;
    }

    static function getUserWishlist(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT Item.ItemID, Item.UserID, Item.CategoryID, 
             Item.TypeID, Item.ItemName, Item.Brand, 
             Item.Model, Item.Dimension, Item.Condition, 
             Item.Detail, Item.IsSold, Item.Color, Item.Price, 
             Item.ImageURL 
      FROM Item INNER JOIN Wishlist ON Item.ItemID = Wishlist.ItemID WHERE Wishlist.UserID = ?;');

      $stmt->execute(array($id));
      $items = array();
    
      while ($item = $stmt->fetch()) {
        $items[] = new Item(
          $item['ItemID'],
          $item['UserID'],
          $item['CategoryID'],
          $item['TypeID'],
          $item['ItemName'],
          $item['Brand'],
          $item['Model'],
          $item['Dimension'],
          $item['Condition'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          $item['ImageURL'],
          (bool) $item['IsSold']
        );
      }

      return $items;
    }
    
    public static function searchItemsByName(PDO $db, $search) {
      $stmt = $db->prepare('
      SELECT * 
      FROM Item
      WHERE ItemName LIKE :search');
      $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $items = [];
      foreach ($results as $result) {
        $item = new Item(
          $result['ItemID'],
          $result['UserID'], 
          $result['CategoryID'],
          $result['TypeID'],
          $result['ItemName'],
          $result['Brand'],
          $result['Model'], 
          $result['Dimension'],
          $result['Condition'], 
          $result['Detail'], 
          $result['Color'],
          $result['Price'],
          $result['ImageURL'],
          (bool)$result['IsSold']
        );
        $items[] = $item;
      }
      return $items;
    }
  }
?>