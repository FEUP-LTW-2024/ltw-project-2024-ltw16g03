<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['RealName'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['confirm_password'])) {
        $db = getDatabaseConnection();

        if (empty($_POST['RealName']) || empty($_POST['Email']) || empty($_POST['Username']) || empty($_POST['Password']) || empty($_POST['confirm_password'])) {
            $session->addMessage('error', 'All fields are required!');
            die(header('Location: ../pages/register.php'));
        }
        
        else if (User::isUsernameTaken($db, $_POST['Username'])) {
            $session->addMessage('error', 'Username already taken');
            die(header('Location: ../pages/register.php'));
        }

        else if (User::isEmailTaken($db, $_POST['Email'])) {
            $session->addMessage('error', 'Email already taken');
            die(header('Location: ../pages/register.php'));
        }

        else if (strlen($_POST['RealName']) < 4) {
            $session->addMessage('error', 'Name too short');
            die(header('Location: ../pages/register.php'));
        }

        else if (strlen($_POST['Password']) < 4) {
            $session->addMessage('error', 'Password too short');
            die(header('Location: ../pages/register.php'));
        }

        else if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $_POST['Password']) && !preg_match('/[0-9]/', $_POST['Password'])) {
            $session->addMessage('error', 'Use a special character or a number');
            die(header('Location: ../pages/register.php'));
        }

        else if ($_POST['Password'] === $_POST['confirm_password']) {
            $stmt = $db->prepare('INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
             (:RealName, :Username, :Password, :Email, :IsAdmin)');

            $RealName = $_POST['RealName'];
            $Username = $_POST['Username'];
            $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            $Email = $_POST['Email'];
            $IsAdmin = 0;

            $stmt->bindParam(':RealName', $RealName);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':Password', $Password);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':IsAdmin', $IsAdmin);


            if ($stmt->execute()) {
                if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $tempFileName = $_FILES['image']['tmp_name'];
                    
                    if (!is_dir('../assets')) mkdir('../assets');
                    if (!is_dir('../assets/uploads_profile')) mkdir('../assets/uploads_profile');
                    
                    $image = @imagecreatefromjpeg($tempFileName);
                    if (!$image) $image = @imagecreatefrompng($tempFileName);
                    if (!$image) $image = @imagecreatefromgif($tempFileName);
                    
                    if (!$image) die(header('Location: ../pages/register.php'));

                    $id = $db->lastInsertId();
                    $imagePath = "../assets/uploads_profile/$id.jpg";

                    imagejpeg($image, $imagePath);
                }
                $session->addMessage('success', 'Registration successful!');
                header('Location: ../pages/login.php');
                exit();
            } else {
                $session->addMessage('error', 'Failed to register user!');
            }
        } else {
            $session->addMessage('error', 'Password and confirm password do not match!');
        }
    } else {
        $session->addMessage('error', 'All fields are required!');
    }

    header('Location: ../pages/register.php');
    exit();
}
?>
