<?php
    declare(strict_types = 1);

    class Condition {
        public int $ConditionID;
        public string $ConditionName;

        public function __construct(int $ConditionID, string $ConditionName)
        {
        $this->ConditionID = $ConditionID;
        $this->ConditionName = $ConditionName;
        }

        public static function getAllConditions(PDO $db) : array {
            $types = array();
            $stmt = $db->prepare('SELECT ConditionID, ConditionName FROM Condition');
            $stmt->execute();
            $types = $stmt->fetchAll();
            return $types;
        }

        static function addCondition(PDO $db, string $Condition) : bool {
            $stmt = $db->prepare('INSERT INTO Condition (ConditionName) VALUES (:Condition)');
            $stmt->bindParam(':Condition', $Condition);
            return $stmt->execute();
        }
    }
    
?>
