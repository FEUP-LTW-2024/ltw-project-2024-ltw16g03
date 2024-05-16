<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($session->getId());
    var_dump($_POST['CATEGORIES']);
    var_dump($_POST['TYPE']);

    if (isset($_FILES['image'], $_POST['description'], $_POST['name'], $_POST['CATEGORIES'],
            $_POST['TYPE'], $_POST['color'], $_POST['price'], $_POST['brand'], $_POST['SIZE']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            
            //Insert item into database
            $db = getDatabaseConnection();
            $stmt = $db->prepare('INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageUrl, Price, IsSold) VALUES
             (:UserID, :CategoryID, :TypeID, :ItemName, :Brand, :Dimension, :Detail, :Color, :ImageUrl, :Price, :IsSold)');

            $UserID = $session->getId();
            $CategoryID = $_POST['CATEGORIES'];
            $TypeID = $_POST['TYPE'];
            $ItemName = $_POST['name'];
            $Brand = $_POST['brand'];
            $Detail = $_POST['description'];
            $Dimension = $_POST['SIZE'];
            $Color = $_POST['color'];
            $ImageUrl = "../assets/uploads_item/-1.jpg";
            $Price = $_POST['price'];
            $IsSold = 0;

            $stmt->bindParam(':UserID', $UserID);
            $stmt->bindParam(':CategoryID', $CategoryID);
            $stmt->bindParam(':TypeID', $TypeID);
            $stmt->bindParam(':ItemName', $ItemName);
            $stmt->bindParam(':Brand', $Brand);
            $stmt->bindParam(':Dimension', $Dimension);
            $stmt->bindParam(':Detail', $Detail);
            $stmt->bindParam(':Color', $Color);
            $stmt->bindParam(':ImageUrl', $ImageUrl);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':IsSold', $IsSold);


            if ($stmt->execute()) {
                //Image
                $tempFileName = $_FILES['image']['tmp_name'];
                
                if (!is_dir('../assets')) mkdir('../assets');
                if (!is_dir('../assets/uploads_item')) mkdir('../assets/uploads_item');
                
                $image = @imagecreatefromjpeg($tempFileName);
                if (!$image) $image = @imagecreatefrompng($tempFileName);
                if (!$image) $image = @imagecreatefromgif($tempFileName);
                
                if (!$image) die(header('Location: ../pages/sell.php'));
    
                $id = $db->lastInsertId();
                $imagePath = "../assets/uploads_item/$id.jpg";
                $ImageUrl = "../assets/uploads_item/$id.jpg";
    
                imagejpeg($image, $imagePath);

                $stmt = $db->prepare('UPDATE Item SET ImageUrl = :ImageUrl WHERE ItemID = :id');
                $stmt->bindParam(':ImageUrl', $ImageUrl);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

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