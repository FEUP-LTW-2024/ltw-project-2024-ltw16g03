<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/message.class.php'); 
  
    $db = getDatabaseConnection();

    // Retrieve the data sent by the JavaScript code
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract individual values
    $receiverID = $data['receiverID'];
    $content = $data['content'];

    Message::sendMessage($db, $session->getId(), (int) $receiverID, $content);
?>