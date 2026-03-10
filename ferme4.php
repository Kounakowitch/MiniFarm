<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ferme 4 : L'Étable</title>
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
        <a href="ferme3.php" class="nav-item">Ferme 3</a>
        <a href="ferme4.php" class="nav-item active">Ferme 4</a>
    </nav>
</header>

<main class="dashboard-container">

    <section class="farm-detail-header">
        <h2><i class="fas fa-cow"></i> Dashboard Détaillé : Ferme 4 - L'Étable</h2>
        <p class="farm-subtitle">Gestion des stocks, planification de l'alimentation et sécurité des animaux.</p>
    </section>

    <hr>

    <section class="farm-controls-alerts">
        <h3>Commandes d'Alimentation & Statut des Moutons</h3>

        <div class="controls-grid">

            <div class="control-card control-gate">
                <h4><i class="fas fa-door-open"></i> Trappe de Nourriture</h4>

                <div class="toggle-container" style="margin-bottom: 15px;">
                    <label class="switch">
                        <input type="checkbox" id="trap-toggle">
                        <span class="slider round"></span>
                    </label>
                    <span id="trap-mode-label">Mode Manuel de la Trappe</span>
                </div>

                <p class="alert-message warning-text" id="feeding-alert-msg"><i class="fas fa-clock"></i> En attente du prochain cycle.</p>
            </div>

            <div class="control-card control-gate">
                <h4><i class="fas fa-door-open"></i> Barrière pâture</h4>

                <div class="toggle-container" style="margin-bottom: 15px;">
                    <button class="btn-action green-btn" id="manual-barrière-btn4"><i class="fas fa-tint"></i> Ouvrir Barrière Pâturage </button>
                </div>

                <p class="alert-message warning-text" id="feeding-alert-msg"><i class="fas fa-clock"></i> En attente du prochain cycle.</p>
            </div>

            <div class="control-card control-sheep-status">
                <h4><i class="fas fa-sheep"></i> Statut des Animaux</h4>
                <p>Moutons à l'Étable : <span id="sheep_count" ></span> / 10</p>

                <p class="alert-message good-text" id="sheep-location-msg">
                    Localisation : <span id="sheep-location">--</span>
                </p>

                <p class="alert-message" id="stable-led-status">
                    <i class="fas fa-lightbulb"></i> LED Étable : <span id="led-state" class="status danger">Éteinte</span>
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
                <span id="consommation">--</span> kWh</p>
                <div class="progress-bar-container" style="height: 10px; margin-top: 10px;">
                    <div class="progress-bar" style="width: 45%; background-color: #673AB7;"></div>
                </div>
            </div>

        </div>
    </section>

    

</main>

<script>
const FARM_ID = 4;
</script>

<script src="script.js"></script>
</body>
</html>
