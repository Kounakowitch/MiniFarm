<?php
require 'connection_db.php';

try {
    $stmt = $pdo->query("SELECT * FROM farms");
    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
