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
        <a href="ferme4.php" class="nav-item active">Ferme 4</a> </nav>
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

            <div class="control-card control-feeding">
                <h4><i class="fas fa-utensils"></i> Distribution Automatique</h4>
                <p>Prochain Repas : <span id="next-meal-time" style="font-weight: 700;">--:--</span> (<span id="meal-type">--</span>)</p>

                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="feeding-toggle" checked>
                        <span class="slider round"></span>
                    </label>
                    <span id="feeding-mode-label">Mode Automatique ON</span>
                </div>

                <button class="btn-action green-btn" id="manual-feed-btn"><i class="fas fa-plus"></i> Nourrir Maintenant (Manuel)</button>
            </div>

            <div class="control-card control-gate">
                <h4><i class="fas fa-door-open"></i> Trappe de Nourriture</h4>
                <p>Statut Trappe : <span id="trap-status" class="status danger">Fermée</span></p>

                <div class="toggle-container">
                    <label for="food-choice">Choix du Repas :</label>
                    <select id="food-choice">
                        <option value="foin">Foin / Paille (F1)</option>
                        <option value="legumes">Légumes (F3)</option>
                    </select>
                </div>

                <p class="alert-message warning-text" id="feeding-alert-msg"><i class="fas fa-clock"></i> En attente du prochain cycle.</p>
            </div>

            <div class="control-card control-sheep-status">
                <h4><i class="fas fa-sheep"></i> Statut des Animaux</h4>
                <p>Moutons à l'Étable : <span id="sheep-in-stable" class="data-value">--</span> / 45</p>

                <p class="alert-message good-text" id="sheep-location-msg">
                    Localisation : <span id="sheep-location">--</span>
                </p>

                <p class="alert-message" id="stable-led-status">
                    <i class="fas fa-lightbulb"></i> LED Étable : <span id="led-state" class="status danger">Éteinte</span>
                </p>
            </div>

        </div>
    </section>

    <hr>

    <section class="logistics-stock">
        <h3>Logistique : Stocks et Réapprovisionnement</h3>

        <div class="logistics-grid">

            <div class="progress-card">
                <h4><i class="fas fa-warehouse"></i> Stock Foin / Paille (F1)</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="hay-stock-progress" style="width: 80%;"></div>
                </div>
                <p class="progress-label">Niveau : <span id="hay-stock-value">80</span>%</p>
                <button class="btn-action green-btn small-btn" id="manual-restock-hay-btn"><i class="fas fa-exchange-alt"></i> Réappro. Manuel F1</button>
                <p class="alert-message danger-text" id="hay-warning" style="display: none;"></p>
            </div>

            <div class="progress-card">
                <h4><i class="fas fa-carrot"></i> Stock Légumes (F3)</h4>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="veg-stock-progress" style="width: 55%;"></div>
                </div>
                <p class="progress-label">Niveau : <span id="veg-stock-value">55</span>%</p>
                <button class="btn-action green-btn small-btn" id="manual-restock-veg-btn"><i class="fas fa-exchange-alt"></i> Réappro. Manuel F3</button>
                <p class="alert-message danger-text" id="veg-warning" style="display: none;"></p>
            </div>

            <div class="progress-card control-schedule">
                <h4><i class="fas fa-clock"></i> Planification des Repas</h4>

                <label for="morning-feed-time">Repas Matin (Type: Foin)</label>
                <input type="time" id="morning-feed-time" value="08:00" class="time-input">

                <label for="evening-feed-time">Repas Soir (Type: Légumes)</label>
                <input type="time" id="evening-feed-time" value="18:30" class="time-input">

                <button class="btn-action green-btn" id="save-schedule-btn"><i class="fas fa-save"></i> Enregistrer les Horaires</button>
            </div>

        </div>
    </section>

    <hr>

    <section class="historical-charts">
        <h3>Analyse de la Consommation (7 Derniers Jours)</h3>

        <div class="charts-grid">
            <div class="chart-card">
                <h4>Consommation de Foin (kg)</h4>
                <canvas id="hayConsumptionChart"></canvas>
            </div>

            <div class="chart-card">
                <h4>Consommation de Légumes (kg)</h4>
                <canvas id="vegConsumptionChart"></canvas>
            </div>
        </div>

    </section>

</main>

<script src="ferme4.js"></script>
</body>
</html>