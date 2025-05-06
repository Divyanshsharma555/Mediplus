<?php
require_once 'config.php';
require_once 'auth.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Debug information
    error_log("Login attempt - Email: " . $email);

    if (empty($email) || empty($password)) {
        header('Location: ../login.html?error=empty_fields');
        exit();
    }

    try {
        // Debug database connection
        if (!$pdo) {
            error_log("Database connection is null");
            header('Location: ../login.html?error=system_error');
            exit();
        }

        // Check if user exists with detailed error logging
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("Failed to prepare statement: " . print_r($pdo->errorInfo(), true));
            header('Location: ../login.html?error=system_error');
            exit();
        }

        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            error_log("User found in database: " . print_r($user, true));
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                error_log("Password verified successfully");
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../index.html');
                exit();
            } else {
                error_log("Password verification failed");
                header('Location: ../login.html?error=invalid_password');
                exit();
            }
        } else {
            error_log("No user found with email: " . $email);
            header('Location: ../login.html?error=user_not_found');
            exit();
        }
    } catch (Exception $e) {
        error_log("Login process error: " . $e->getMessage());
        header('Location: ../login.html?error=system_error');
        exit();
    }
} else {
    header('Location: ../login.html');
    exit();
}
?> 