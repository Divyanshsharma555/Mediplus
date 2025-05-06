<?php
require_once 'config.php';

$username = 'admin';
$email = 'admin@123';
$password = password_hash('adminpassword', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
if ($stmt->execute([$username, $email, $password])) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . print_r($stmt->errorInfo(), true);
}
?>