<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 5");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($data);
echo "</pre>";
