<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/type.class.php'); 
require_once(__DIR__ . '/../database/condition.class.php');
require_once(__DIR__ . '/../database/sizes.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Type'])) {
        if (Type_::addType($db, $_POST['Type'])) {
            $session->addMessage('success', 'New type added!');
        }
    }
    if (!empty($_POST['Condition'])) {
        if (Condition::addCondition($db, $_POST['Condition'])) {
            $session->addMessage('success', 'New condition added!');
        }
    }
    if (!empty($_POST['CATEGORIES'] && !empty($_POST['Size']))) {
        if (Size::addSize($db, $_POST['Size'], (int) $_POST['CATEGORIES'])) {
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