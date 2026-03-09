<?php
$host = "10.30.50.139";
$user = "root";
$dbname = "smartferme";

try {

$pdo = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8",
$user
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

die("Erreur connexion DB : " . $e->getMessage());

}
?>