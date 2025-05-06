<?php
require_once 'config.php';

try {
    if ($pdo) {
        echo "Database connection successful!";
        
        // Test query
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $count = $stmt->fetchColumn();
        echo "<br>Number of users in database: " . $count;
    } else {
        echo "Database connection failed: PDO object is null";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 