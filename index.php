<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agricole - Suivi des Fermes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<header class="main-header">
    <div class="logo">
        <h1>Mini Farm</h1>
    </div>

    <nav class="farm-nav">
        <a href="ferme1.php" class="nav-item">Ferme 1</a>
        <a href="ferme2.php" class="nav-item">Ferme 2</a>
        <a href="ferme3.php" class="nav-item">Ferme 3</a>
        <a href="ferme4.php" class="nav-item">Ferme 4</a>
    </nav>
</header>

<main class="dashboard-container">

    <section class="live-data-summary">
        <h2>Conditions Météo et Capteurs (Mise à Jour Automatique)</h2>
        <p class="data-last-update">Dernière mise à jour : <span id="last-update-time">--:--:--</span></p>

        <div class="data-cards-grid">
            <div class="data-card"><i class="fas fa-thermometer-half"></i> Température: <span id="temp-global">0.0</span>°C</div>
            <div class="data-card"><i class="fas fa-tint"></i> Humidité: <span id="humi-global">0</span>%</div>
            <div class="data-card"><i class="fas fa-clock"></i> Heure Locale: <span id="time-display">--:--</span></div>
            <div class="data-card"><i class="fas fa-water"></i> Niveau d'eau: <span id="water-global">0</span>%</div>
            <div class="data-card"><i class="fas fa-sun"></i> Luminosité: <span id="light-global">0</span> Lux</div>
        </div>
    </section>

    <hr>

    <section class="farm-dashboard-overview">
        <h2>Synthèse Opérationnelle des Fermes</h2>

        <div class="farm-cards-grid">

            <article class="farm-card">
                <h3>Ferme 1 - Les Champs</h3>
                <p>Statut Général : <span class="status good">Optimal</span></p>
                <ul>
                    <li><i class="fas fa-seedling"></i> Cultures : Avoine, Blé, Orge</li>
                    <li><i class="fas fa-chart-line"></i> Tendance : Rendement Stable (+0.5%)</li>
                    <li><i class="fas fa-bolt"></i> Consommation Énergie : 45 kWh</li>
                </ul>
                <a href="ferme1.php" class="btn-detail">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-2">
                <h3>Ferme 2 - Les Pâtures</h3>
                <p>Statut Général : <span class="status warning">Alerte Humidité</span></p>
                <ul>
                    <li><i class="fas fa-leaf"></i> Cultures : Pâturage, Foin</li>
                    <li><i class="fas fa-chart-line"></i> Tendance : Légère Baisse (-1.2%)</li>
                    <li><i class="fas fa-wrench"></i> Maintenance Requise : Oui</li>
                </ul>
                <a href="ferme2.php" class="btn-detail warning-btn">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-3">
                <h3>Ferme 3 - Le Potager</h3>
                <p>Statut Général : <span class="status danger">Urgence Chaleur</span></p>
                <ul>
                    <li><i class="fas fa-carrot"></i> Cultures : Carottes, Tomates, Salades</li>
                    <li><i class="fas fa-chart-area"></i> Tendance : Forte Baisse (-3.5%)</li>
                    <li><i class="fas fa-fire"></i> Niveau d'Alarme : Élevé</li>
                </ul>
                <a href="ferme3.php" class="btn-detail danger-btn">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-4">
                <h3>Ferme 4 - L'Étable</h3>
                <p>Statut Général : <span class="status info">Maintenance Prévue</span></p>
                <ul>
                    <li><i class="fas fa-cow"></i> Élevage : Bovins, Volailles</li>
                    <li><i class="fas fa-user-friends"></i> Personnel : 3 Présents</li>
                    <li><i class="fas fa-truck"></i> Logistique : Livraison en attente</li>
                </ul>
                <a href="ferme4.php" class="btn-detail info-btn">Accéder au Dashboard</a>
            </article>

        </div>
    </section>

</main>

<script src="script.js"></script>
</body>
</html>