<?php
// Connexion à la base MySQL (sera utilisée plus tard)

$host = "localhost";
$db   = "smartfarm";   // ta future base
$user = "root";
$pass = "";            // vide sur XAMPP

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // Pour l’instant on affiche rien (silencieux)
}
