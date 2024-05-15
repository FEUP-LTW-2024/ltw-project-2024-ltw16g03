<?php
  declare(strict_types = 1);

  class Item {
    public int $ItemID;
    public int $OwnerID;
    public int $CategoryID;
    public int $TypeID;
    public string $ItemName;
    public string $Brand;
    public string $Dimension;
    public string $Detail;
    public string $Color;
    public float $Price;
    public bool $IsSold;

    public function __construct(int $ItemID, int $OwnerID, int $CategoryID, int $TypeID, string $ItemName, string $Brand,
                               ?string $Dimension, string $Detail, string $Color, float $Price, bool $IsSold)
    {
        $this->ItemID = $ItemID;
        $this->OwnerID = $OwnerID;
        $this->CategoryID = $CategoryID;
        $this->TypeID = $TypeID;
        $this->ItemName = $ItemName;
        $this->Brand = $Brand;
        if($Dimension == null) $this->Dimension = "";
        else $this->Dimension = $Dimension;
        $this->Detail = $Detail;
        $this->Color = $Color;
        $this->Price = $Price;
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
        $item['Dimension'],
        $item['Detail'],
        $item['Color'],
        $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function update_sold_cart($db, int $itemId): void {
      $stmt = $db->prepare('
          UPDATE Item
          SET IsSold = 1
          WHERE ItemID = ?
      ');
  
      $stmt->execute(array($itemId));
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
          (bool) $item['IsSold']
        );
      }

      return $items;
    }

    static function getUserWishlist(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT Item.ItemID, Item.UserID, Item.CategoryID, 
             Item.TypeID, Item.ItemName, Item.Brand, 
            Item.Dimension,
             Item.Detail, Item.IsSold, Item.Color, Item.Price
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
          $item['Dimension'],
          $item['Detail'],
          $item['Color'],
          $item['Price'],
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
          $result['Dimension'],
          $result['Detail'], 
          $result['Color'],
          $result['Price'],
          (bool)$result['IsSold']
        );
        $items[] = $item;
      }
      return $items;
    }

    public static function searchNonUserItemsByName(PDO $db, $search, $id) {
      $stmt = $db->prepare('
      SELECT * 
      FROM Item
      WHERE ItemName LIKE :search AND UserID <> :id');
      $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
      $stmt->bindValue(':id', $id);
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
          $result['Dimension'],
          $result['Detail'], 
          $result['Color'],
          $result['Price'],
          (bool)$result['IsSold']
        );
        $items[] = $item;
      }
      return $items;
    }    
  }
?>