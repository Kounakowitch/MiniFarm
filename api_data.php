<?php

if (file_exists("connexion_db.php")) {
    require("connexion_db.php");
}

$farm = $_GET['farm'] ?? 1;

try {

$stmt = $pdo->prepare("SELECT * 
        FROM ta_table 
        WHERE farm_id = $farm_id
        ORDER BY timestamp DESC
        LIMIT 1");

$stmt->execute([$farm]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($data);

} catch(PDOException $e){

echo json_encode([
"error" => $e->getMessage()
]);

}

?>