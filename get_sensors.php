<?php
require 'connection_db.php';

try {
    $stmt = $pdo->query("SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 100");
    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
