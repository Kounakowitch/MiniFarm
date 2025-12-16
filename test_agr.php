<?php
require_once("connexion_db.php");

$result = $conn->query("SELECT * FROM sensor_data");

while ($row = $result->fetch_assoc()) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}
?>
