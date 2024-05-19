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
    public string $ImageUrl;
    public string $Condition;
    public float $Price;
    public bool $IsSold;

    public function __construct(int $ItemID, int $OwnerID, int $CategoryID, int $TypeID, string $ItemName, string $Brand,
                               ?string $Dimension, string $Detail, string $Color, string $Condition, string $ImageUrl, float $Price, bool $IsSold)
    {
        $this->ItemID = $ItemID;
        $this->OwnerID = $OwnerID;
        $this->CategoryID = $CategoryID;
        $this->TypeID = $TypeID;
        $this->ItemName = $ItemName;
        $this->Brand = $Brand;
        $this->Dimension = $Dimension;
        $this->Detail = $Detail;
        $this->Color = $Color;
        $this->ImageUrl = $ImageUrl;
        $this->Condition = $Condition;
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
        $item['Condition'],
        $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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

    static function deleteItem($db, int $itemId): void {
      $stmt = $db->prepare('
          DELETE FROM Item
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $item['Condition'],
          $item['ImageUrl'],
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
          $result['Condition'],
          $result['ImageUrl'],
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
          $result['Condition'],
          $result['ImageUrl'],
          $result['Price'],
          (bool)$result['IsSold']
        );
        $items[] = $item;
      }
      return $items;
    }    

    static function createTransaction(PDO $db, int $sellerId, int $buyerId, int $itemId) {
      $stmt = $db->prepare('
          INSERT INTO Transact (SellerID, BuyerID, ItemID, TransactionDate)
          VALUES (?, ?, ?, CURRENT_TIMESTAMP)
      ');
      $stmt->execute([$sellerId, $buyerId, $itemId]);
    }

    static function getUserPreviousOrders(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT i.*
        FROM Item i
        INNER JOIN Transact t ON i.ItemID = t.ItemID
        WHERE t.BuyerID = ?
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
          $item['Condition'],
          $item['ImageUrl'],
          $item['Price'],
          (bool) $item['IsSold']
        );
      }
  
      return $items;
    }

    static function updateItem(PDO $db, Item $item) : bool {
      $stmt = $db->prepare('UPDATE Item SET 
            UserID = :UserID, 
            CategoryID = :CategoryID, 
            TypeID = :TypeID, 
            ItemName = :ItemName, 
            Brand = :Brand, 
            Dimension = :Dimension, 
            Detail = :Detail, 
            Color = :Color, 
            Condition = :Condition, 
            ImageUrl = :ImageUrl, 
            Price = :Price, 
            IsSold = :IsSold
            WHERE ItemID = :ItemID');

      $sold = (int) $item->IsSold;

      $stmt->bindParam(':ItemID', $item->ItemID);
      $stmt->bindParam(':UserID', $item->OwnerID);
      $stmt->bindParam(':CategoryID', $item->CategoryID);
      $stmt->bindParam(':TypeID', $item->TypeID);
      $stmt->bindParam(':ItemName', $item->ItemName);
      $stmt->bindParam(':Brand', $item->Brand);
      $stmt->bindParam(':Dimension', $item->Dimension);
      $stmt->bindParam(':Detail', $item->Detail);
      $stmt->bindParam(':Color', $item->Color);
      $stmt->bindParam(':ImageUrl', $item->ImageUrl);
      $stmt->bindParam(':Condition', $item->Condition);
      $stmt->bindParam(':Price', $item->Price);
      $stmt->bindParam(':IsSold', $sold);

      return $stmt->execute();
  }

  static function updateImage(PDO $db, string $ImageUrl, int $itemID) : bool {
    $stmt = $db->prepare('UPDATE Item SET ImageUrl = :ImageUrl WHERE ItemID = :id');
    $stmt->bindParam(':ImageUrl', $ImageUrl);
    $stmt->bindParam(':id', $itemID);
    return $stmt->execute();
  }

  static function sellItem(PDO $db, Item $item) : bool {
    $stmt = $db->prepare('INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, Condition, ImageUrl, Price, IsSold) VALUES
    (:UserID, :CategoryID, :TypeID, :ItemName, :Brand, :Dimension, :Detail, :Color, :Condition, :ImageUrl, :Price, :IsSold)');

    $sold = (int) $item->IsSold;

    $stmt->bindParam(':UserID', $item->OwnerID);
    $stmt->bindParam(':CategoryID', $item->CategoryID);
    $stmt->bindParam(':TypeID', $item->TypeID);
    $stmt->bindParam(':ItemName', $item->ItemName);
    $stmt->bindParam(':Brand', $item->Brand);
    $stmt->bindParam(':Dimension', $item->Dimension);
    $stmt->bindParam(':Detail', $item->Detail);
    $stmt->bindParam(':Color', $item->Color);
    $stmt->bindParam(':ImageUrl', $item->ImageUrl);
    $stmt->bindParam(':Condition', $item->Condition);
    $stmt->bindParam(':Price', $item->Price);
    $stmt->bindParam(':IsSold', $sold);

    return $stmt->execute();
  }
}
?>