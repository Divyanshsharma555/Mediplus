<?php
session_start();
require_once 'config.php';

function registerUser($username, $email, $password) {
    global $pdo;
    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $result = $stmt->execute([$username, $email, $hashedPassword]);
        if (!$result) {
            error_log("Registration failed: " . print_r($stmt->errorInfo(), true));
        }
        return $result;
    } catch(PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        return false;
    }
}

function loginUser($email, $password) {
    global $pdo;
    try {
        if (!$pdo) {
            error_log("Database connection is null in loginUser");
            return false;
        }
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("Failed to prepare statement: " . print_r($pdo->errorInfo(), true));
            return false;
        }
        
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    } catch(PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function logoutUser() {
    session_destroy();
}
?> 