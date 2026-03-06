<?php

if (file_exists("connexion_db.php")) {
    require("connexion_db.php");
}

$farm = $_GET['farm'] ?? 1;

try {

$stmt = $pdo->prepare("
    SELECT * 
    FROM sensor_data 
    WHERE farm_id = ?
");

$stmt->execute([$farm]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode($data);

} catch(PDOException $e){

echo json_encode([
"error" => $e->getMessage()
]);

}

?>