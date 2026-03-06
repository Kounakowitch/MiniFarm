<?php

require("connexion_db.php");

$farm = $_GET['farm'] ?? 1;

try {

    // données de la ferme
    $stmt = $pdo->prepare("
        SELECT * 
        FROM sensor_data 
        WHERE farm_id = ?
    ");
    $stmt->execute([$farm]);
    $farmData = $stmt->fetch(PDO::FETCH_ASSOC);

    // moyennes globales ARRONDIES
    $stmt2 = $pdo->prepare("
        SELECT
            ROUND(AVG(air_temp),1) as temp_global,
            ROUND(AVG(air_humidity),0) as humi_global,
            ROUND(AVG(water_level),0) as water_global,
            ROUND(AVG(photoresistor),0) as light_global,
            ROUND(AVG(consommation),1) as energy_global
        FROM sensor_data
    ");

    $stmt2->execute();
    $globalData = $stmt2->fetch(PDO::FETCH_ASSOC);

    $data = array_merge($farmData, $globalData);

    header('Content-Type: application/json');
    echo json_encode($data);

} catch(PDOException $e){

    echo json_encode([
        "error" => $e->getMessage()
    ]);

}