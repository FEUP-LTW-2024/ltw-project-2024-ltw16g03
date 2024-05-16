<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES['image'], $_POST['description'], $_POST['name'], $_POST['CATEGORIES'],
            $_POST['TYPE'], $_POST['color'], $_POST['price'], $_POST['brand']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            if ($continue) {
            
            //Insert item into database
            $db = getDatabaseConnection();
            $stmt = $db->prepare('INSERT INTO Item(UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, Price, IsSold) VALUES
             (:UserID, :CategoryID, :TypeID, :ItemName, :Brand, :Dimension, :Detail, :Color, :Price, :IsSold)');

            $UserID = $session->getId();
            $CategoryID = $_POST['CATEGORIES'];
            $TypeID = $_POST['TYPE'];
            $ItemName = $_POST['name'];
            $Brand = $_POST['brand'];
            $Detail = $_POST['description'];
            $Color = $_POST['color'];
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
    
                imagejpeg($image, $imagePath);

                $session->addMessage('success', 'Sell successful!');
            } else {
                $session->addMessage('error', 'Failed to sell item!');
            }
        }
    } else {
        $session->addMessage('error', 'All fields and image are required!');
        die(header('Location: ../pages/sell.php'));
    }
    header('Location: ../pages/sell.php');
    exit();
}
?>