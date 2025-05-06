<?php
require_once 'config.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $subject && $message) {
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $subject, $message])) {
        header('Location: ../contact.html?success=1');
        exit();
    } else {
        echo "Error: " . print_r($stmt->errorInfo(), true);
        exit();
    }
} else {
    echo "Error: Missing fields";
    exit();
}
?> 