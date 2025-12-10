<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agricole - Ferme 2 : Les Pâtures</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<header class="main-header">
    <div class="logo">
        <h1>Mini Farm</h1>
    </div>

    <nav class="farm-nav">
        <a href="index.php" class="nav-item">Accueil</a>
        <a href="ferme1.php" class="nav-item">Ferme 1</a>
        <a href="ferme2.php" class="nav-item active-nav-item">Ferme 2</a> <a href="ferme3.php" class="nav-item">Ferme 3</a>
        <a href="ferme4.php" class="nav-item">Ferme 4</a>
    </nav>
</header>

<main class="dashboard-container">

    <section class="farm-specific-data">
        <h2>🐑 Ferme 2 : Les Pâtures - État Opérationnel</h2>
        <p class="data-last-update">Dernière mise à jour : <span id="last-update-time">--:--:--</span></p>

        <div class="data-cards-grid">
            <div class="data-card"><i class="fas fa-thermometer-half"></i> Température: <span id="temp-global">0.0</span>°C</div>
            <div class="data-card"><i class="fas fa-tint"></i> Humidité: <span id="humi-global">0</span>%</div>
            <div class="data-card"><i class="fas fa-sheep"></i> Moutons: <span id="sheep-count">--</span></div>
            <div class="data-card"><i class="fas fa-clock"></i> Heure Locale: <span id="time-display">--:--</span></div>
        </div>

        <hr>

        <article class="status-2 farm-card special-status-card">
            <h3>Statut des Moutons</h3>
            <p id="sheep-status">Récupération des données en cours...</p>
        </article>

    </section>

</main>

<script src="script.js"></script>
<script>
    // Ajout d'une fonction spécifique pour la logique de la ferme 2
    function updateFarm2Status(data) {
        const temp = data.temperature;
        const humi = data.humidity;
        const now = new Date();
        const hour = now.getHours();

        const sheepCount = 45; // Nombre de moutons dans la pâture (Exemple)
        let sheepLocation = `${sheepCount} moutons dans la Pâture`;
        let statusMessage = "Conditions stables. Surveillance de l'humidité en cours.";

        // --- Logique Temporelle et Météo (Heure > 21h OU < 6h) ---
        if (hour >= 21 || hour < 6) {
            sheepLocation = `${sheepCount} moutons sont à l'Étable`;
            statusMessage = "Il fait nuit. Les moutons sont en sécurité à l'étable pour la nuit.";
        }

        // La condition "la température est en baisse" nécessite de comparer avec une valeur précédente
        // Pour l'instant, on simule la baisse par une faible température (ex: < 15°C)
        // La vraie implémentation nécessiterait une variable globale pour l'ancienne température.
        const tempLowCondition = temp < 15; // Exemple de seuil

        // --- Logique Météo (Température basse ET Humidité haute) ---
        if (tempLowCondition && humi > 75) { // Seuil d'humidité élevé : 75%
            sheepLocation = `${sheepCount} moutons doivent rentrer à l'Étable (Urgence)`;
            statusMessage = `<span class="status danger"><i class="fas fa-exclamation-triangle"></i> URGENCE:</span> Température basse (${temp.toFixed(1)}°C) et forte humidité (${humi.toFixed(0)}%). Les animaux doivent rentrer immédiatement pour éviter l'hypothermie.`;
            document.getElementById('sheep-status').closest('.farm-card').style.borderColor = '#d32f2f';
        } else {
            document.getElementById('sheep-status').closest('.farm-card').style.borderColor = ''; // Réinitialise la couleur de la bordure
        }


        // Mise à jour de l'affichage
        document.getElementById('sheep-count').textContent = sheepCount;
        document.getElementById('sheep-status').innerHTML = `${sheepLocation}<br><br><strong>Statut :</strong> ${statusMessage}`;
    }


    // On surcharge la fonction 'updateDashboard' de script.js pour ajouter la logique de la ferme 2
    const originalUpdateDashboard = updateDashboard;
    window.updateDashboard = function(data) {
        // Exécute la mise à jour des indicateurs globaux
        originalUpdateDashboard(data);

        // Exécute la logique spécifique à la Ferme 2
        updateFarm2Status(data);
    };

    // On s'assure que la classe 'active-nav-item' est aussi stylée dans style.css
</script>
</body>
</html>
