<?php
require_once 'config.php';

$name = 'Dr. John Smith';
$specialization = 'Cardiology';
$description = 'Experienced cardiologist.';
$image_url = 'images/doctors/john_smith.jpg';

$stmt = $pdo->prepare("INSERT INTO doctors (name, specialization, description, image_url) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$name, $specialization, $description, $image_url])) {
    echo "Doctor added successfully!";
} else {
    echo "Error: " . print_r($stmt->errorInfo(), true);
}
?> 