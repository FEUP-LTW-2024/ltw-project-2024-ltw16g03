<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['Username'], $_POST['Password'], $_POST['Email'])) {

        if ($_POST['Password'] === $_POST['confirm_password']) {

            $db = getDatabaseConnection();

            $stmt = $db->prepare('INSERT INTO User (Username, Password, Email, IsAdmin) VALUES
             (:Username, :Password, :Email, :IsAdmin)');


            $Username = $_POST['Username'];
            $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            $Email = $_POST['Email'];
            $IsAdmin = 0;

            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':Password', $Password);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':IsAdmin', $IsAdmin);

            if ($stmt->execute()) {
                $database = __DIR__ . '/../database/database.sql';
                $sql = "INSERT INTO User (Username, Password, Email, IsAdmin) VALUES
                ('{$Username}', '{$Password}', '{$Email}', '{$IsAdmin}');";
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
