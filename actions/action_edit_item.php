<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ItemID = (int) $_GET['ItemID'];

    if (isset($_POST['description'], $_POST['name'], $_POST['CATEGORIES'], $_POST['CONDITION'],
            $_POST['TYPE'], $_POST['color'], $_POST['price'], $_POST['brand'], $_POST['SIZE'])) {

            if (strlen($_POST['name']) > 16 || strlen($_POST['brand']) > 60 || strlen($_POST['price']) > 60 || strlen($_POST['description']) > 500) {
                $session->addMessage('error', 'Some inputs are too large');
                die(header('Location: ../pages/edit_item.php'));
            }
            
            //Insert item into database
            $ItemID = (int) $_GET['ItemID'];

            $item = new Item($ItemID, $session->getId(), (int) $_POST['CATEGORIES'], (int) $_POST['TYPE'],
                            $_POST['name'], $_POST['brand'], $_POST['SIZE'], $_POST['description'],
                            $_POST['color'], $_POST['CONDITION'], "../assets/uploads_item/$ItemID.jpg", (int) $_POST['price'], false);

            //Image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $tempFileName = $_FILES['image']['tmp_name'];
            
            if (!is_dir('../assets')) mkdir('../assets');
            if (!is_dir('../assets/uploads_item')) mkdir('../assets/uploads_item');
            
            $image = @imagecreatefromjpeg($tempFileName);
            if (!$image) $image = @imagecreatefrompng($tempFileName);
            if (!$image) $image = @imagecreatefromgif($tempFileName);
            
            if (!$image) die(header('Location: ../pages/sell.php'));

            $imagePath = "../assets/uploads_item/$ItemID.jpg";

            imagejpeg($image, $imagePath);
            }
            
            if (Item::updateItem($db, $item)) {
                $session->addMessage('success', 'Edit item successful!');
            } else {
                $session->addMessage('error', 'Failed to Edit item!');
            }
        } else {
            $session->addMessage('error', 'All fields and image are required!');
            die(header('Location: ../pages/edit_item.php?ItemID=' . $ItemID));
        } 
    }
    header('Location: ../pages/my_selling.php');
    exit();
?>