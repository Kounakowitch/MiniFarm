<?php
require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $farm_id = $_POST['farm_id'];
    $event_type = $_POST['event_type'];
    $message = $_POST['message'];

    try {
        $stmt = $pdo->prepare("INSERT INTO events (farm_id, event_type, message) VALUES (?, ?, ?)");
        $stmt->execute([$farm_id, $event_type, $message]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
