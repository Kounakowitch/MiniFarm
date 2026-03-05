<?php
require_once("connexion_db.php");

$result = $conn->query("SELECT air_temp
FROM sensor_data
WHERE farm_id = 2;
");

while ($row = $result->fetch_assoc()) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}
?>
