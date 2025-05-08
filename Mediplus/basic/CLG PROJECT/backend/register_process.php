<?php
require_once 'config.php';
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        error_log("Registration: Empty fields");
        header('Location: ../register.html?error=empty_fields');
        exit();
    }

    if ($password !== $confirm_password) {
        error_log("Registration: Password mismatch");
        header('Location: ../register.html?error=password_mismatch');
        exit();
    }

    // Ensure strong password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $result = $stmt->execute([$username, $email, $hashed_password]);

        if ($result) {
            error_log("User registered successfully: " . $email);
            header('Location: ../login.html?registered=true');
            exit();
        } else {
            error_log("Registration failed: " . print_r($stmt->errorInfo(), true));
            header('Location: ../register.html?error=registration_failed');
            exit();
        }
    } catch(PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        header('Location: ../register.html?error=system_error');
        exit();
    }
} else {
    header('Location: ../register.html');
    exit();
}
?>
