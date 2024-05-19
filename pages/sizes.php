<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/sizes.class.php');

$db = getDatabaseConnection();

if (isset($_GET['category_id'])) {
    $categoryID = $_GET['category_id'];;
    $sizes = Size::getSizesByCategory($db, $categoryID);
    header('Content-Type: application/json');
    echo json_encode($sizes);
}
?>