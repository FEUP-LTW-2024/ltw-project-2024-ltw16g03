<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Type'])) {
        $stmt = $db->prepare('INSERT INTO Type_ (TypeName) VALUES (:TypeName)');
        $TypeName = $_POST['Type'];
        $stmt->bindParam(':TypeName', $TypeName);
        if ($stmt->execute()) {
            $session->addMessage('success', 'New type added!');
        }
    }
    if (!empty($_POST['Condition'])) {
        $stmt = $db->prepare('INSERT INTO Condition (ConditionName) VALUES (:Condition)');
        $Condition = $_POST['Condition'];
        $stmt->bindParam(':Condition', $Condition);
        if ($stmt->execute()) {
            $session->addMessage('success', 'New condition added!');
        }
    }
    if (!empty($_POST['CATEGORIES'] && !empty($_POST['Size']))) {
        $stmt = $db->prepare('INSERT INTO Size (SizeName, CategoryID) VALUES (:SizeName, :CategoryID)');
        $SizeName = $_POST['Size'];
        $CategoryID = $_POST['CATEGORIES'];
        $stmt->bindParam(':SizeName', $SizeName);
        $stmt->bindParam(':CategoryID', $CategoryID);
        if ($stmt->execute()) {
            $session->addMessage('success', 'New size added!');
        }
    }

    header('Location: ../pages/admin.php');
    exit();
}
else {
    header('Location: ../pages/admin.php');
    exit();
}
?>