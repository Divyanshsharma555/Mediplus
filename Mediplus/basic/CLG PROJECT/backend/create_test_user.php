<?php
require_once 'config.php';

try {
    // Create test user
    $username = 'testuser';
    $email = 'test@example.com';
    $password = password_hash('test123', PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $result = $stmt->execute([$username, $email, $password]);

    if ($result) {
        echo "Test user created successfully!<br>";
        echo "Email: test@example.com<br>";
        echo "Password: test123";
    } else {
        echo "Failed to create test user";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 