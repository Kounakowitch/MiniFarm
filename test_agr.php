<?php
$conn = new mysqli("localhost", "root", "", "smartfarm");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

echo "✅ Connecté à la base smartfarm";
?>
