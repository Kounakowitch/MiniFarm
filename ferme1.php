<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ferme 1 : Les Champs</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body>

<header class="main-header">
    <div class="logo">
        <h1>Mini Farm</h1>
    </div>

    <nav class="farm-nav">
        <a href="index.php" class="nav-item">Accueil</a>
        <a href="ferme1.php" class="nav-item active">Ferme 1</a>
        <a href="ferme2.php" class="nav-item">Ferme 2</a>
        <a href="ferme3.php" class="nav-item">Ferme 3</a>
        <a href="ferme4.php" class="nav-item">Ferme 4</a>
    </nav>
</header>

<main class="dashboard-container">

    <section class="farm-detail-header">
        <h2><i class="fas fa-seedling"></i> Dashboard Détaillé : Ferme 1 - Les Champs</h2>
        <p class="farm-subtitle">Gestion des cultures de céréales et optimisation des ressources.</p>
    </section>

    <hr>

    <section class="farm-controls-alerts">
        <h3>Commandes Rapides & Alertes Clés</h3>

        <div class="controls-grid">

            <div class="control-card control-irrigation">
                <h4><i class="fas fa-water"></i> Système d'Irrigation</h4>
                <p>Statut : <span id="irrigation-status" class="status good">Automatique</span></p>
                <p id="soil-status">État du sol : --</p> <!-- Nouveau span pour l'état du sol -->
                <p>Niveau réservoir : <span id="water_level">--</span></p>
                <div id="water-bar-container" style="width: 100%; background-color: #ddd; border-radius: 5px; height: 20px;">
                    <div id="water-bar" style="height: 100%; width: 0%; background-color: #4CAF50; border-radius: 5px;"></div>
                </div>
                <p id="water-alert" style="color: red; display: none;">Réservoir faible !</p>
                <div class="toggle-container"></div>
            </div>

            <div class="control-card control-fog">
            <h4><i class="fas fa-smog"></i> Niveau de Brouillard</h4>
            <p>Intensité : <span id="">--</span></p>
            
            <div class="fog-bar-container" style="width: 100%; background-color: #eee; border-radius: 5px; height: 15px; margin: 10px 0;">
                <div id="fog-bar" style="height: 100%; width: 0%; background-color: #3498db; border-radius: 5px; transition: width 0.5s;"></div>
            </div>
            
            <p class="data-value" style="font-size: 0.9em;"><span id="fog-raw-value">0</span> / 4095</p>
            
            <p class="alert-message" id="fog-alert-msg" style="margin-top:10px;">
                <i class="fas fa-info-circle"></i> <span id="fog-advice">Calcul des données...</span>
            </p>

    

        </div>

            <div class="control-card control-temperature">
                <h4><i class="fas fa-thermometer-three-quarters"></i> Conditions Actuelles</h4>
                <p class="data-value"><span id="air_temp">--</span> °C / <span id="air_humidity"></span> %</p>
                <p class="alert-message danger-text" id="weather-alert" style="display: none;">
                    <i class="fas fa-exclamation-triangle"></i> **Risque d'Hypothermie** imminent. Les moutons doivent rentrer !
                </p>
            </div>

            <div class="control-card control-energy">
                <h4><i class="fas fa-bolt"></i> Consommation Énergie</h4>
                <p><span id="consommation">--</span> kWh</p>
                <div class="progress-bar-container" style="height: 10px; margin-top: 10px;">
                    <div class="progress-bar" style="width: 45%; background-color: #673AB7;"></div>
                </div>
                <p class="progress-label" style="font-size: 0.8em; margin-top: 5px;">Utilisation : Normale</p>
            </div>

        </div>
    </section>

    <hr>
    
    <section class="historical-charts">
        <h3>Analyse des Conditions du Sol (7 Derniers Jours)</h3>

        <div class="charts-grid">
            <div class="chart-card">
                <h4>Humidité du Sol (%)</h4>
                <p><span id="soil_humidity">--</span></p>
                <canvas id="soilHumidityChart"></canvas>
            </div>

        </div>

    </section>

</main>

<script>
const FARM_ID = 1;
</script>

<script src="script.js"></script>

</body>
</html>
