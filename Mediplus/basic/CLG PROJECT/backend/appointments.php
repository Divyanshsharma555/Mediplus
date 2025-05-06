<?php
require_once 'config.php';
require_once 'auth.php';

function bookAppointment($userId, $doctorId, $appointmentDate, $appointmentTime, $reason) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, reason) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $doctorId, $appointmentDate, $appointmentTime, $reason]);
    } catch(PDOException $e) {
        return false;
    }
}

function getAppointments($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM appointments WHERE user_id = ? ORDER BY appointment_date DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

function getDoctors() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM doctors");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}
?> 