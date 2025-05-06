<?php
require_once 'config.php';

function submitContact($name, $email, $subject, $message) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $subject, $message]);
    } catch(PDOException $e) {
        return false;
    }
}
?> 