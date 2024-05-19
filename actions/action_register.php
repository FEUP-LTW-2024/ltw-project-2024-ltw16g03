<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../pages/homepage.php');
    exit();
}

$_SESSION['form_data'] = $_POST;

require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!(isset($_POST['RealName'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['confirm_password'], $_FILES['image'])
        && $_FILES['image']['error'] === UPLOAD_ERR_OK)) {
            $session->addMessage('error', 'All fields are required!');
        }

        else if (empty($_POST['RealName']) || empty($_POST['Email']) || empty($_POST['Username']) || empty($_POST['Password']) || empty($_POST['confirm_password'])) {
            $session->addMessage('error', 'All fields are required!');
        }

        else if (strlen($_POST['RealName']) > 60 || strlen($_POST['Email']) > 60 || strlen($_POST['Username']) > 60 
        || strlen($_POST['Password']) > 60 || strlen($_POST['confirm_password']) > 60) {
            $session->addMessage('error', 'Some inputs are too large');
        }
        
        else if (User::isUsernameTaken($db, $_POST['Username'])) {
            $session->addMessage('error', 'Username already taken');
        }

        else if (User::isEmailTaken($db, $_POST['Email'])) {
            $session->addMessage('error', 'Email already taken');
        }

        else if (strlen($_POST['RealName']) < 4) {
            $session->addMessage('error', 'Name too short');
        }

        else if (strlen($_POST['Password']) < 4) {
            $session->addMessage('error', 'Password too short');
        }

        else if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $_POST['Password']) && !preg_match('/[0-9]/', $_POST['Password'])) {
            $session->addMessage('error', 'Use a special character or a number');
        }

        else if (!($_POST['Password'] === $_POST['confirm_password'])) {
            $session->addMessage('error', 'Password and confirm password do not match!');
        }
        

        if (empty($_SESSION['messages'])) {

            $db = getDatabaseConnection();
            $stmt = $db->prepare('INSERT INTO User (RealName, Username, Password, ImageUrl, Email, IsAdmin) VALUES
             (:RealName, :Username, :Password, :ImageUrl, :Email, :IsAdmin)');

            $RealName = $_POST['RealName'];
            $Username = $_POST['Username'];
            $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            $ImageUrl = "../assets/uploads_profile/-1.jpg";
            $Email = $_POST['Email'];
            $IsAdmin = 0;

            $stmt->bindParam(':RealName', $RealName);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':Password', $Password);
            $stmt->bindParam(':ImageUrl', $ImageUrl);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':IsAdmin', $IsAdmin);

            if ($stmt->execute()) {        
                $tempFileName = $_FILES['image']['tmp_name'];
                    
                if (!is_dir('../assets')) mkdir('../assets');
                if (!is_dir('../assets/uploads_profile')) mkdir('../assets/uploads_profile');
                
                $image = @imagecreatefromjpeg($tempFileName);
                if (!$image) $image = @imagecreatefrompng($tempFileName);
                if (!$image) $image = @imagecreatefromgif($tempFileName);
                
                if (!$image) die(header('Location: ../pages/register.php'));

                $id = $db->lastInsertId();        
                $imagePath = "../assets/uploads_profile/$id.jpg";
                $ImageUrl = "../assets/uploads_profile/$id.jpg";
    
                imagejpeg($image, $imagePath);

                $stmt = $db->prepare('UPDATE User SET ImageUrl = :ImageUrl WHERE UserID = :id');
                $stmt->bindParam(':ImageUrl', $ImageUrl);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $session->addMessage('success', 'Registration successful!');
                header('Location: ../pages/login.php');
                exit();
            } else {
                $session->addMessage('error', 'Failed to register user!');
                die(header('Location: ../pages/register.php'));
            }
    }  else {
        $session->addMessage('error', 'Failed to register user!');
        die(header('Location: ../pages/register.php'));
    }
    header('Location: ../pages/register.php');
    exit();
}
?>
