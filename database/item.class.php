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
  }
?>