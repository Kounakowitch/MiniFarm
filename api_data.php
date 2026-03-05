<?php

header('Content-Type: application/json');

// connexion à la base
require 'connection_db.php';

try {

    // récupérer la dernière ligne de sensor_data
    $sql = "SELECT * FROM sensor_data ORDER BY updated_at DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {

        $latestSensorData = [
            "temperature" => $data["air_temp"],
            "humidity" => $data["air_humidity"],
            "soilHumidity" => $data["soil_humidity"],
            "waterLevel" => $data["water_level"],
            "lightIntensity" => $data["photoresistor"]
        ];

        echo json_encode($latestSensorData);

    } else {
        echo json_encode(["error" => "Aucune donnée trouvée"]);
    }

} catch (PDOException $e) {

    echo json_encode([
        "error" => $e->getMessage()
    ]);

}

?>