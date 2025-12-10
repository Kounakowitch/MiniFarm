<?php
// Définit l'en-tête pour indiquer au navigateur qu'il s'agit d'une réponse JSON
header('Content-Type: application/json');

// -----------------------------------------------------------
// ETAPE 1 : Connexion à la Base de Données (via PHPStorm)
// -----------------------------------------------------------

// Normalement, vous auriez ici votre logique de connexion BDD (PDO)

// -----------------------------------------------------------
// ETAPE 2 : Récupération des données les plus récentes
// -----------------------------------------------------------

// Simulez la récupération des données les plus récentes de votre BDD
// REMPLACEZ CE CODE PAR VOTRE REQUÊTE SQL RÉELLE
$latestSensorData = [
    // Ces clés correspondent aux noms utilisés dans le script.js
    'temperature' => 21.8,
    'humidity' => 63.5,
    'waterLevel' => 88,
    'lightIntensity' => 590
    // Ajoutez ici d'autres données importantes (ex: pression, CO2, etc.)
];

// -----------------------------------------------------------
// ETAPE 3 : Renvoyer les données au format JSON
// -----------------------------------------------------------

echo json_encode($latestSensorData);
exit;
?>