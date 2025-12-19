<?php
require 'connection_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $farm_id = $_POST['farm_id'];
    $target = $_POST['target'];
    $command = $_POST['command'];
    $value = $_POST['value'] ?? null;

    try {
        $stmt = $pdo->prepare("INSERT INTO commands (farm_id, target, command, value) VALUES (?, ?, ?, ?)");
        $stmt->execute([$farm_id, $target, $command, $value]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
