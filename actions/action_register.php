<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['Username'], $_POST['Password'], $_POST['Email'])) {

        if ($_POST['Password'] === $_POST['confirm_password']) {

            $db = getDatabaseConnection();

            $stmt = $db->prepare('INSERT INTO User (RealName, Username, Password, Email, IsAdmin, ImageURL) VALUES
             (:RealName, :Username, :Password, :Email, :IsAdmin, :ImageURL)');

            $RealName = $_POST['RealName'];
            $Username = $_POST['Username'];
            $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            $Email = $_POST['Email'];
            $IsAdmin = 0;
            $ImageURL = 'https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg';

            $stmt->bindParam(':RealName', $RealName);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':Password', $Password);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':IsAdmin', $IsAdmin);
            $stmt->bindParam(':ImageURL', $ImageURL);

            if ($stmt->execute()) {
                $database = __DIR__ . '/../database/database.sql';
                $sql = "INSERT INTO User (RealName, Username, Password, Email, IsAdmin, ImageURL) VALUES
                ('{$RealName}', '{$Username}', '{$Password}', '{$Email}', '{$IsAdmin}', '{$ImageURL}');";
                file_put_contents($database, $sql . PHP_EOL, FILE_APPEND);
                $session->addMessage('success', 'Registration successful!');
                die(header('Location: ../pages/login.php'));
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
