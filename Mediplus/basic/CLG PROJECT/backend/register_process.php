<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        header('Location: ../register.html?error=password_mismatch');
        exit();
    }

    if (registerUser($username, $email, $password)) {
        header('Location: ../login.html?registered=true');
        exit();
    } else {
        header('Location: ../register.html?error=registration_failed');
        exit();
    }
} else {
    header('Location: ../register.html');
    exit();
}
?> 