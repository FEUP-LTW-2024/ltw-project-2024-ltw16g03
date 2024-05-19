<?php
declare(strict_types = 1);

class Size {
    public int $SizeID;
    public string $SizeName;
    public int $CategoryID;

    public function __construct(int $SizeID, string $SizeName, int $CategoryID)
    {
        $this->SizeID = $SizeID;
        $this->SizeName = $SizeName;
        $this->CategoryID = $CategoryID;
    }

    public static function getAllTypes(PDO $db) : array {
        $types = array();
        $stmt = $db->prepare('SELECT TypeID, TypeName FROM Type_');
        $stmt->execute();
        $types = $stmt->fetchAll();
        return $types;
    }

    public static function getSizesByCategory(PDO $db, int $categoryID) : array {
        $sizes = array();
        $stmt = $db->prepare('
            SELECT SizeID, SizeName
            FROM Size
            WHERE CategoryID = :categoryID
        ');
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->execute();
        $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sizes;
    }

    static function addSize(PDO $db, string $SizeName, int $CategoryID) : bool {
        $stmt = $db->prepare('INSERT INTO Size (SizeName, CategoryID) VALUES (:SizeName, :CategoryID)');
        $stmt->bindParam(':SizeName', $SizeName);
        $stmt->bindParam(':CategoryID', $CategoryID);
        return $stmt->execute();
    }
}
?>
        