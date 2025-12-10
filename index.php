<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Fermes</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<!-- Header -->
<header>
    <nav>
        <ul class="fermes-menu">
            <li><a href="ferme1.php">Ferme 1</a></li>
            <li><a href="ferme2.php">Ferme 2</a></li>
            <li><a href="ferme3.php">Ferme 3</a></li>
            <li><a href="ferme4.php">Ferme 4</a></li>
        </ul>
    </nav>
</header>

<!-- Dashboard général -->
<main>
    <section class="dashboard">
        <h2>Tableaux de bord des fermes</h2>
        <div class="ferme-cards">
            <div class="card" id="ferme1-card">
                <h3>Ferme 1</h3>
                <p>Nombre de capteurs : 10</p>
                <p>Statut : OK</p>
            </div>
            <div class="card" id="ferme2-card">
                <h3>Ferme 2</h3>
                <p>Nombre de capteurs : 8</p>
                <p>Statut : OK</p>
            </div>
            <div class="card" id="ferme3-card">
                <h3>Ferme 3</h3>
                <p>Nombre de capteurs : 12</p>
                <p>Statut : OK</p>
            </div>
            <div class="card" id="ferme4-card">
                <h3>Ferme 4</h3>
                <p>Nombre de capteurs : 7</p>
                <p>Statut : OK</p>
            </div>
        </div>
    </section>

    <!-- Section capteurs temps réel -->
    <section class="capteurs">
        <h2>Capteurs en temps réel</h2>
        <div class="sensor-data">
            <p>Température : <span id="temperature">--</span> °C</p>
            <p>Humidité : <span id="humidity">--</span> %</p>
            <p>Heure : <span id="time">--:--:--</span></p>
            <p>Niveau d'eau : <span id="water-level">--</span> %</p>
            <p>Luminosité : <span id="light-level">--</span> lx</p>
        </div>
    </section>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Gestion des Fermes. Tous droits réservés.</p>
</footer>
</body>
</html>

