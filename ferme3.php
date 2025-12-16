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
        <a href="ferme3.php" class="nav-item active">Ferme 3</a> <a href="ferme4.php" class="nav-item">Ferme 4</a>
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
                <p>Statut : <span id="irrigation-status" class="status good">Automatique</span></p>
                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="irrigation-toggle" checked>
                        <span class="slider round"></span>
                    </label>
                    <span id="irrigation-mode-label">Mode Auto ON (Calculé)</span>
                </div>
                <button class="btn-action green-btn" id="manual-irrigation-btn"><i class="fas fa-tint"></i> Arroser 5 min (Manuel)</button>
            </div>

            <div class="control-card control-seeding">
                <h4><i class="fas fa-clock"></i> Arrosage Automatique</h4>
                <p>Prochain cycle : <span id="next-irrigation-time" style="font-weight: 700;">--:--</span></p>

                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="seeding-toggle" checked disabled>
                        <span class="slider round"></span>
                    </label>
                    <span id="seeding-mode-label">Déclenchement conditionnel</span>
                </div>
                <p class="alert-message" id="irrigation-alert-msg"><i class="fas fa-check-circle"></i> Conditions actuelles optimales.</p>
            </div>

            <div class="control-card control-temperature">
                <h4><i class="fas fa-thermometer-three-quarters"></i> Conditions Actuelles</h4>
                <p class="data-value">
                    <span id="temp-actuelle">--</span> °C /
                    <span id="humi-actuelle">--</span> %
                </p>
                <p class="alert-message danger-text" id="gel-alert" style="display: none;">
                    <i class="fas fa-snowflake"></i> **ALERTE GEL!** Température critique. Récolte d'urgence à planifier.
                </p>
            </div>

        </div>
    </section>

    <hr>

    <section class="logistics-stock">
        <h3>Logistique et Gestion des Stocks de Légumes</h3>

        <div class="logistics-grid">

            <div class="progress-card">
                <h4><i class="fas fa-carrot"></i> Stock Carottes</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="carrot-stock-progress" style="width: 50%;"></div>
                </div>
                <p class="progress-label">Niveau: <span id="carrot-stock-value">50</span>%</p>
                <p class="alert-message danger-text" id="carrot-warning" style="display: none;">
                    <i class="fas fa-exclamation-circle"></i> **STOCK BAS !** Planifiez de nouveaux semis.
                </p>
            </div>

            <div class="progress-card">
                <h4><i class="fas fa-apple-alt"></i> Stock Tomates</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="tomato-stock-progress" style="width: 75%;"></div>
                </div>
                <p class="progress-label">Niveau: <span id="tomato-stock-value">75</span>%</p>
                <p class="alert-message danger-text" id="tomato-warning" style="display: none;"></p>
            </div>

            <div class="progress-card">
                <h4><i class="fas fa-leaf"></i> Stock Salades</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="salad-stock-progress" style="width: 25%;"></div>
                </div>
                <p class="progress-label">Niveau: <span id="salad-stock-value">25</span>%</p>
                <p class="alert-message danger-text" id="salad-warning" style="display: none;"></p>
            </div>

        </div>
    </section>

    <hr>

    <section class="historical-charts">
        <h3>Analyse des Conditions du Potager (7 Derniers Jours)</h3>

        <div class="charts-grid">
            <div class="chart-card">
                <h4>Température du Sol (°C)</h4>
                <canvas id="soilTempChart"></canvas>
            </div>

            <div class="chart-card">
                <h4>Humidité du Sol (%)</h4>
                <canvas id="soilHumidityChart"></canvas>
            </div>
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

<script src="ferme3.js"></script>
</body>
</html>
