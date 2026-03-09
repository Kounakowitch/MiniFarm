<?php

$host = "10.30.50.139";
$user = "isen";
$password = "isen";
$dbname = "smartferme";

try {

$pdo = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8",
$user,
$password
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

header('Content-Type: application/json');

echo json_encode([
"error" => "Erreur connexion DB",
"details" => $e->getMessage()
]);

exit;

}
?>