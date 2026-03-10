<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Ferme 3 : Le Potager</title>
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
                <a href="ferme1.php" class="nav-item">Ferme 1</a>
                <a href="ferme2.php" class="nav-item">Ferme 2</a>
                <a href="ferme3.php" class="nav-item active">Ferme 3</a> 
                <a href="ferme4.php" class="nav-item">Ferme 4</a>
            </nav>
        </header>
        <main class="dashboard-container">
            <section class="farm-detail-header">
                <h2><i class="fas fa-carrot"></i> Dashboard Détaillé : Ferme 3 - Le Potager</h2>
                <p class="farm-subtitle">Gestion des cultures maraîchères, irrigation optimisée et stocks.</p>
            </section>
            <hr>
            <section class="farm-controls-alerts">
                <h3>Contrôles d'Irrigation & Alertes Météo</h3>
                <div class="controls-grid">
                    <div class="control-card control-irrigation">
                        <h4><i class="fas fa-water"></i> Système d'Irrigation</h4>
                        <p id="soil-status">État du sol :
                            <p></p>Humidité: <span id="soil_humidity">--</span>%</p> <!-- Nouveau span pour l'état du sol -->
                        <p>Niveau réservoir :</p>
                        <p style="display:none;">niveau : <span id="water_level">--</span></p>
                        <div id="water-bar-container" style="width: 100%; background-color: #ddd; border-radius: 5px; height: 20px;">
                            <div id="water-bar" style="height: 100%; width: 0%; background-color: #4CAF50; border-radius: 5px;"></div>
                        </div>
                        <p id="water-alert" style="color: red; display: none;">Réservoir faible !</p>
                        <div class="toggle-container"></div>
                        <button class="btn-action green-btn" id="manual-irrigation-btn"><i class="fas fa-tint"></i> Arroser (Manuel)</button>
                    </div>

            <div class="control-card control-fog">
                <h4><i class="fas fa-smog"></i> Niveau de Brouillard</h4>

                <p style="display:none;">Intensité : <span id="steam_sensor">--</span></p>

                <div class="fog-bar-container" style="width: 100%; background-color: #eee; border-radius: 5px; height: 15px; margin: 10px 0;">
                    <div id="fog-bar" style="height: 100%; width: 0%; background-color: #3498db; border-radius: 5px; transition: width 0.5s;"></div>
                </div>
            </div>

                    
            <div class="control-card control-temperature">
                <h4>
                    <i class="fas fa-thermometer-three-quarters"></i> Conditions Actuelles
                </h4>
                    <p class="data-value"><span id="air_temp">--</span> °C / <span id="air_humidity"></span> %</p>
                <p class="alert-message danger-text" id="gel-alert" style="display: none;">
                    <i class="fas fa-snowflake"></i> **ALERTE GEL!** Température critique. Récolte d'urgence à planifier.
                </p>
            </div>

            <div class="control-card control-energy">
                <h4><i class="fas fa-bolt"></i> Consommation Énergie</h4>
                <p><span id="consommation">--</span> kWh</p>

                <div class="progress-bar-container" style="height: 10px; margin-top: 10px; background-color: #eee; border-radius: 5px;">
                    <div class="progress-bar" style="width: 45%; height: 100%; background-color: #673AB7; border-radius: 5px;"></div>
                </div>

                <p class="progress-label" style="font-size: 0.8em; margin-top: 5px;">Utilisation : Normale</p>
            </div>
    </section>


    <div id="seeding-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2><i class="fas fa-seedling"></i> Débuter la Session de Semis !</h2>
            <p>Les conditions sont parfaites (Température, Humidité) pour lancer les semis automatiques. Voulez-vous commencer maintenant ?</p>
            <button class="btn-action green-btn" id="start-seeding-btn">LANCER LES SEMIS MAINTENANT</button>
        </div>
    </div>

</main>

<script>
const FARM_ID = 3;
</script>

<script src="script.js"></script>
</body>
</html>

