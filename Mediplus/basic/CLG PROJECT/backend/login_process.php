<?php
// Add session start at the top
session_start();

require_once 'config.php';
require_once 'auth.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // EXTENSIVE LOGGING
    error_log("LOGIN ATTEMPT DETAILS:");
    error_log("Email: " . $email);
    error_log("Password Length: " . strlen($password));
    
    // Dump PDO connection status
    error_log("PDO Connection Status: " . ($pdo ? "Connected" : "Not Connected"));

    if (empty($email) || empty($password)) {
        error_log("Empty email or password");
        header('Location: ../login.html?error=empty_fields');
        exit();
    }

    try {
        // Detailed user query logging
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("PREPARE STATEMENT FAILED: " . print_r($pdo->errorInfo(), true));
            header('Location: ../login.html?error=system_error');
            exit();
        }

        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Log detailed user information
        if ($user) {
            error_log("USER FOUND DETAILS:");
            error_log("Stored Hashed Password: " . $user['password']);
            error_log("Provided Password Length: " . strlen($password));
        } else {
            error_log("NO USER FOUND FOR EMAIL: " . $email);
        }

        // Verify password with extensive logging
        if ($user && password_verify($password, $user['password'])) {
            error_log("PASSWORD VERIFICATION SUCCESSFUL");
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../index.html');
            exit();
        } else {
            error_log("PASSWORD VERIFICATION FAILED");
            header('Location: ../login.html?error=invalid_credentials');
            exit();
        }
    } catch (Exception $e) {
        error_log("LOGIN PROCESS EXCEPTION: " . $e->getMessage());
        header('Location: ../login.html?error=system_error');
        exit();
    }
} else {
    header('Location: ../login.html');
    exit();
}
?>
