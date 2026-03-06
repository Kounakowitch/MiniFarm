<?php

if (file_exists("connexion_db.php")) {
    require("connexion_db.php");
}

$farm = $_GET['farm'] ?? 1;

try {

    // =========================
    // DONNÉES DE LA FERME
    // =========================
    $stmt = $pdo->prepare("
        SELECT *
        FROM sensor_data
        WHERE farm_id = ?
    ");

    $stmt->execute([$farm]);
    $farmData = $stmt->fetch(PDO::FETCH_ASSOC);


    // =========================
    // MOYENNES GLOBALES
    // =========================
    $stmt2 = $pdo->prepare("
    SELECT
        ROUND(AVG(air_temp),1) as temp_global,
        ROUND(AVG(air_humidity),1) as humi_global,
        ROUND(AVG(water_level),1) as water_global,
        ROUND(AVG(photoresistor),0) as light_global,
        ROUND(AVG(consommation),1) as energy_global
    FROM sensor_data
    ");

    $stmtGlobal->execute();
    $globalData = $stmtGlobal->fetch(PDO::FETCH_ASSOC);


    // =========================
    // FUSION DES DONNÉES
    // =========================
    $data = array_merge($farmData, $globalData);

    header('Content-Type: application/json');

    echo json_encode($data);

} catch(PDOException $e){

    echo json_encode([
        "error" => $e->getMessage()
    ]);

}

?>