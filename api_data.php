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
    $stmtGlobal = $pdo->prepare("
        SELECT
            AVG(air_temp) as temp_global,
            AVG(air_humidity) as humi_global,
            AVG(water_level) as water_global,
            AVG(photoresistor) as light_global,
            AVG(consommation) as energy_global
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