<?php
require_once 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    $tableExists = $stmt->rowCount() > 0;

    if (!$tableExists) {
        // Create users table
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "Users table created successfully.<br>";
    } else {
        echo "Users table already exists.<br>";
    }

    // Check if we have any users
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $userCount = $stmt->fetchColumn();

    if ($userCount == 0) {
        // Create test user
        $username = 'testuser';
        $email = 'test@example.com';
        $password = password_hash('test123', PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        echo "Test user created successfully.<br>";
        echo "Email: test@example.com<br>";
        echo "Password: test123<br>";
    } else {
        echo "Found $userCount existing users in the database.<br>";
        
        // List existing users (without passwords)
        $stmt = $pdo->query("SELECT id, username, email, created_at FROM users");
        echo "<br>Existing users:<br>";
        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}, Created: {$user['created_at']}<br>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 