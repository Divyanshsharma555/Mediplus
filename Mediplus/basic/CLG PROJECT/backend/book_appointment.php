<?php
require_once 'check_auth.php';
require_once 'config.php';

// Require login for booking appointments
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = getCurrentUserId();
    $doctor_id = $_POST['doctor_id'] ?? null;
    $appointment_date = $_POST['appointment_date'] ?? null;
    $appointment_time = $_POST['appointment_time'] ?? null;
    $reason = $_POST['reason'] ?? '';

    if (!$doctor_id || !$appointment_date || !$appointment_time) {
        header('Location: ../appoint.html?error=missing_fields');
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, reason) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$user_id, $doctor_id, $appointment_date, $appointment_time, $reason]);

        if ($result) {
            header('Location: ../appoint.html?success=true');
        } else {
            header('Location: ../appoint.html?error=booking_failed');
        }
    } catch(PDOException $e) {
        header('Location: ../appoint.html?error=system_error');
    }
    exit();
} else {
    header('Location: ../appoint.html');
    exit();
}
?> 