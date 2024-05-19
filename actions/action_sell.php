<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
$_SESSION['form_data'] = $_POST;

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
$db = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES['image'], $_POST['description'], $_POST['name'], $_POST['CATEGORIES'], $_POST['CONDITION'],
            $_POST['TYPE'], $_POST['color'], $_POST['price'], $_POST['brand'], $_POST['SIZE']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            if (strlen($_POST['name']) > 60 || strlen($_POST['brand']) > 60 || strlen($_POST['price']) > 60 || strlen($_POST['description']) > 500) {
                $session->addMessage('error', 'Some inputs are too large');
                die(header('Location: ../pages/sell.php'));
            }
            
            //Insert item into database
            $item = new Item(1, $session->getId(), (int) $_POST['CATEGORIES'], (int) $_POST['TYPE'],
                            $_POST['name'], $_POST['brand'], $_POST['SIZE'], $_POST['description'],
                            $_POST['color'], $_POST['CONDITION'], "../assets/uploads_item/-1.jpg", (int) $_POST['price'], false);

            if (Item::sellItem($db, $item)) {
                //Image
                $tempFileName = $_FILES['image']['tmp_name'];
                
                if (!is_dir('../assets')) mkdir('../assets');
                if (!is_dir('../assets/uploads_item')) mkdir('../assets/uploads_item');
                
                $image = @imagecreatefromjpeg($tempFileName);
                if (!$image) $image = @imagecreatefrompng($tempFileName);
                if (!$image) $image = @imagecreatefromgif($tempFileName);
                
                if (!$image) die(header('Location: ../pages/sell.php'));
    
                $id = (int) $db->lastInsertId();
                $imagePath = "../assets/uploads_item/$id.jpg";
                $ImageUrl = "../assets/uploads_item/$id.jpg";
    
                imagejpeg($image, $imagePath);

                Item::updateImage($db, $ImageUrl, $id);

                $session->addMessage('success', 'Sell successful!');
            } else {
                $session->addMessage('error', 'Failed to sell item!');
            }
        } else {
            $session->addMessage('error', 'All fields and image are required!');
            die(header('Location: ../pages/sell.php'));
        } 
    }
    header('Location: ../pages/sell.php');
    exit();
?>