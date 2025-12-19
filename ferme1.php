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
                <p>Niveau réservoir :</p>
                <div id="water-bar-container" style="width: 100%; background-color: #ddd; border-radius: 5px; height: 20px;">
                    <div id="water-bar" style="height: 100%; width: 0%; background-color: #4CAF50; border-radius: 5px;"></div>
                </div>
                <p id="water-alert" style="color: red; display: none;">Réservoir faible !</p>
                <div class="toggle-container"></div>
            </div>

            <div class="control-card control-seeding">
                <h4><i class="fas fa-tractor"></i> Controole brouillard</h4>
                <p>Statut du capteur : <span id="seeding-go-status" class="status good">Feu Vert (OK)</span></p>

                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="seeding-toggle" checked>
                        <span class="slider round"></span>
                    </label>
                    <span id="seeding-mode-label">Semis Automatique ON</span>
                </div>
                <p class="alert-message" id="seeding-alert-msg"><i class="fas fa-check-circle"></i> Température, Humidité et Gel OK.</p>
            </div>

            <div class="control-card control-temperature">
                <h4><i class="fas fa-thermometer-three-quarters"></i> Température Actuelle</h4>
                <p class="data-value"><span id="air_temp">--</span> °C</p>
                <p class="alert-message warning-text" id="gel-alert" style="display:none;">
                    <i class="fas fa-exclamation-triangle"></i> **Risque de Gel** imminent (< 3°C). Déclenchement de l'alerte !
                </p>
            </div>

        </div>
    </section>

    <hr>

    <section class="logistics-stock">
        <h3>Logistique et Gestion des Stocks</h3>

        <div class="logistics-grid">

            <div class="progress-card">
                <h4>Avancement de l'Envoi vers Ferme 4</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="delivery-progress" style="width: 75%;"></div>
                </div>
                <p class="progress-label"><span id="delivery-value">75</span>% Livré. (Cultures envoyées pour l'Étable)</p>
            </div>

            <div class="progress-card">
                <h4>Stock de Cultures Disponibles</h4>
                <div class="progress-bar-container stock-low"> <div class="progress-bar progress-green-to-red" id="stock-progress" style="width: 25%;"></div>
                </div>
                <p class="progress-label">Stock estimé : <span id="stock-value">25</span>%</p>
                <p class="alert-message danger-text" id="stock-warning">
                    <i class="fas fa-exclamation-circle"></i> **Stock Bas !** Envoi important vers Ferme 4. Pensez à planifier de nouveaux semis.
                </p>
            </div>

        </div>
    </section>

    <hr>

    <section class="historical-charts">
        <h3>Analyse des Conditions du Sol (7 Derniers Jours)</h3>

        <div class="charts-grid">
            <div class="chart-card">
                <h4>Humidité du Sol (%)</h4>
                <canvas id="soilHumidityChart"></canvas>
            </div>

            <div class="chart-card">
                <h4>Taux de Nutriments (pH)</h4>
                <canvas id="phLevelChart"></canvas>
            </div>
        </div>

    </section>

</main>

<script src="ferme1.js"></script>
</body>
</html>