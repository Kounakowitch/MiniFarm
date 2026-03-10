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
                        <p id="soil-status">Humidité du sol : --</p>
                        <button class="btn-action green-btn" id="manual-irrigation-btn"><i class="fas fa-tint"></i> Arroser 5 min (Manuel)</button>
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
                <span id="consommation">--</span> kWh</p>
                <div class="progress-bar-container" style="height: 10px; margin-top: 10px;">
                    <div class="progress-bar" style="width: 45%; background-color: #673AB7;"></div>
                </div>
                <p class="progress-label" style="font-size: 0.8em; margin-top: 5px;">Utilisation : Normale</p>
            </div>

        </div>
    </section>

    <hr>


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

