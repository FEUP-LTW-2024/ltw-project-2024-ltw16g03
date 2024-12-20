<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../pages/homepage.php');
    exit();
}

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['RealName'], $_POST['Email'], $_POST['Username'], $_POST['current_password'], $_POST['new_password'], $_POST['password'])) {   
        $db = getDatabaseConnection();

        if (empty($_POST['RealName']) || empty($_POST['Email']) || empty($_POST['Username']) || empty($_POST['current_password'])) {
            $session->addMessage('error', 'Current password is required!');
            die(header('Location: ../pages/edit_profile.php'));
        }

        else if (strlen($_POST['RealName']) > 60 || strlen($_POST['Email']) > 60 || strlen($_POST['Username']) > 60 || strlen($_POST['current_password']) > 60
        || $_POST['new_password'] > 60 || $_POST['password'] > 60) {
            $session->addMessage('error', 'Some inputs are too large');
            die(header('Location: ../pages/edit_profile.php'));
        }

        $user = User::getUser($db, $session->getId());
        $user2 = User::getUserWithPassword($db, $user->Username, $_POST['current_password']);

        if ($user && $user2) {
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $tempFileName = $_FILES['image']['tmp_name'];
                
                if (!is_dir('../assets')) mkdir('../assets');
                if (!is_dir('../assets/uploads_profile')) mkdir('../assets/uploads_profile');
                
                $image = @imagecreatefromjpeg($tempFileName);
                if (!$image) $image = @imagecreatefrompng($tempFileName);
                if (!$image) $image = @imagecreatefromgif($tempFileName);
                
                if (!$image) die(header('Location: ../pages/edit_profile.php'));

                $imagePath = "../assets/uploads_profile/$user->UserID.jpg";
                imagejpeg($image, $imagePath);
            }
            
            if (User::isUsernameTaken($db, $_POST['Username'], $user->UserID)) {
                $session->addMessage('error', 'Username already taken');
                die(header('Location: ../pages/edit_profile.php'));
            }
    
            else if (User::isEmailTaken($db, $_POST['Email'], $user->UserID)) {
                $session->addMessage('error', 'Email already taken');
                die(header('Location: ../pages/edit_profile.php'));
            }
    
            else if (strlen($_POST['RealName']) < 4) {
                $session->addMessage('error', 'Name too short');
                die(header('Location: ../pages/edit_profile.php'));
            }

            $password = password_hash($_POST['current_password'], PASSWORD_DEFAULT);

            if (!empty($_POST['new_password']) && !empty($_POST['password'])) {
                
                if (strlen($_POST['new_password']) < 4) {
                    $session->addMessage('error', 'New password too short');
                    die(header('Location: ../pages/edit_profile.php'));
                }

                else if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $_POST['new_password']) && !preg_match('/[0-9]/', $_POST['new_password'])) {
                    $session->addMessage('error', 'Use a special character or a number for the new password');
                    die(header('Location: ../pages/edit_profile.php'));
                }

                $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

                if ($_POST['new_password'] === $_POST['password'])
                    $session->addMessage('error', 'New password and confirm password do not match!');
            }

            $user = new User($user->UserID, $_POST['RealName'], $_POST['Username'], $_POST['Email'], 
            "../assets/uploads_profile/$user->UserID.jpg", 0);

            if (User::editAccount($db, $user, $password)) {    
                $session->addMessage('success', 'Registration successful!');
                die(header('Location: ../pages/login.php'));
            } else {
                $session->addMessage('error', 'Failed to edit account!');
            }
        }
        else {
            $session->addMessage('error', 'Wrong password');
        }
    }
    header('Location: ../pages/edit_profile.php');
    exit();
}
?>
