<?php
    declare(strict_types = 1);

    class Type_ {
        public int $TypeID;
        public string $TypeName;

        public function __construct(int $TypeID, string $TypeName)
        {
        $this->TypeID = $TypeID;
        $this->TypeName = $TypeName;
        }

        public static function getAllTypes(PDO $db) : array {
            $types = array();
            $stmt = $db->prepare('SELECT TypeID, TypeName FROM Type_');
            $stmt->execute();
            $types = $stmt->fetchAll();
            return $types;
        }
    }
    
?>