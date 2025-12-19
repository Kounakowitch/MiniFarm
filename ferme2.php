<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ferme 2 : Les Pâtures</title>
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
        <a href="ferme2.php" class="nav-item active">Ferme 2</a>
        <a href="ferme3.php" class="nav-item">Ferme 3</a>
        <a href="ferme4.php" class="nav-item">Ferme 4</a>
    </nav>
</header>

<main class="dashboard-container">

    <section class="farm-detail-header">
        <h2><i class="fas fa-sheep"></i> Dashboard Détaillé : Ferme 2 - Les Pâtures</h2>
        <p class="farm-subtitle">Gestion des animaux (moutons) et surveillance des conditions d'élevage.</p>
    </section>

    <hr>

    <section class="farm-controls-alerts">
        <h3>Commandes Rapides & Alertes Clés</h3>

        <div class="controls-grid">

            <div class="control-card control-irrigation">
                <h4><i class="fas fa-gate"></i> Contrôle de la Barrière</h4>
                <p>Statut de l'accès à l'Étable : <span id="gate-status" class="status good">Ouverte (Auto)</span></p>
                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="gate-toggle" checked>
                        <span class="slider round"></span>
                    </label>
                    <span id="gate-mode-label">Mode Automatique activé</span>
                </div>
                <button class="btn-action red-btn" id="manual-gate-btn"><i class="fas fa-times-circle"></i> Fermer Manuellement</button>
            </div>

            <div class="control-card control-seeding">
                <p>Niveau réservoir :</p>
                <div id="water-bar-container" style="width: 100%; background-color: #ddd; border-radius: 5px; height: 20px;">
                    <div id="water-bar" style="height: 100%; width: 0%; background-color: #4CAF50; border-radius: 5px;"></div>
                </div>
                <p id="water-alert" style="color: red; display: none;">Réservoir faible !</p>
                <div class="toggle-container"></div>
            </div>

            <div class="control-card control-temperature">
                <h4><i class="fas fa-thermometer-three-quarters"></i> Conditions Actuelles</h4>
                <p class="data-value"><span id="temp-actuelle">--</span> °C / <span id="humi-actuelle">--</span> %</p>
                <p class="alert-message danger-text" id="weather-alert" style="display: none;">
                    <i class="fas fa-exclamation-triangle"></i> **Risque d'Hypothermie** imminent. Les moutons doivent rentrer !
                </p>
            </div>

        </div>
    </section>

    <hr>

    <section class="logistics-stock">
        <h3>Statut des Moutons et Gestion de l'Étable</h3>

        <div class="logistics-grid">

            <div class="progress-card">
                <h4>Localisation des Moutons</h4>
                <div id="sheep_bar_container" style="width: 100%; background-color: #ddd; border-radius: 5px; height: 20px;">
                    <div id="sheep_bar" style="height: 100%; width: 0%; background-color: #4CAF50; border-radius: 5px;"></div>
                </div>
                <p class="progress-label">Dans la Pâture : <span id="sheep_count">--</span> moutons</p>
                <p class="alert-message good-text" id="sheep-status-message">
                    <i class="fas fa-check-circle"></i> Conditions stables.
                </p>
            </div>

            <div class="progress-card">
                <h4>Présence de moutons</h4>
                <p>Présence de mouton devant la trappe : <span id="presence_mouton">--</span></p>
            </div>

        </div>
    </section>

    <hr>

    <section class="historical-charts">
        <h3>Analyse des Conditions Environnementales (7 Derniers Jours)</h3>
        <div class="charts-grid">
            <div class="chart-card">
                <h4>Température de la Pâture (°C)</h4>
                <canvas id="pastureTempChart"></canvas>
            </div>
            <div class="chart-card">
                <h4>Humidité de l'Air (%)</h4>
                <canvas id="airHumidityChart"></canvas>
            </div>
        </div>
    </section>
</main>

<script src="ferme2.js"></script>
</body>
</html>