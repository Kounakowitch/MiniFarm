<?php
$host = "localhost";
$user = "root";
$password = "isen";
$dbname = "smartfarm";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur connexion DB : " . $conn->connect_error);
}
?>
