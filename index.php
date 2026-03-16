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

        <div class="data-cards-grid">
            <div class="data-card"><i class="fas fa-thermometer-half"></i> Température: <span id="temp-global"></span>°C</div>
            <div class="data-card"><i class="fas fa-tint"></i> Humidité: <span id="humi-global"></span>%</div>
            <div class="data-card"><i class="fas fa-water"></i> Niveau d'eau: <span id="water-global"></span>%</div>
            <div class="data-card"><i class="fas fa-sun"></i> Luminosité: <span id="light-global"></span> Lux</div>
            <div class="data-card"><i class="fas fa-sun"></i> Energie: <span id="energy-global"></span> kWh</div>
            
        </div>

        
    </section>

    <hr>

    <section class="farm-dashboard-overview">
        <h2>Synthèse Opérationnelle des Fermes</h2>

        <div class="farm-cards-grid">

            <article class="farm-card">
                <h3>Ferme 1 - Les Champs</h3>
                <p>Statut Général :  <p>Niveau réservoir :</p>
                <div style="width:100%; background:#ddd; border-radius:5px; height:15px;">
                    <div id="water-bar-index" style="height:100%; width:0%; background:#4CAF50; border-radius:5px;"></div>
                </div>

                <p id="water-alert" style="color:red; display:none;"></p>
                <ul>
                    <li><i class="fas fa-seedling"></i> Cultures : Avoine, Blé, Orge</li>
                </ul>
                <a href="ferme1.php" class="btn-detail">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-2">
                <h3>Ferme 2 - Les Pâtures</h3>
                <p>Statut Général : <span id="sheep_count" ></span> / 10</p></p>
                <ul>
                    <li><i class="fas fa-leaf"></i> Elevage : Pâturage, Foin</li>
                </ul>
                <a href="ferme2.php" class="btn-detail warning-btn">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-3">
                <h3>Ferme 3 - Le Potager</h3>
                <p>Statut Général : <span id="water_level_farm3">--</span></p>
                <ul>
                    <li><i class="fas fa-carrot"></i> Cultures : Carottes, Tomates, Salades</li>
                </ul>
                <a href="ferme3.php" class="btn-detail danger-btn">Accéder au Dashboard</a>
            </article>

            <article class="farm-card status-4">
                <h3>Ferme 4 - L'Étable</h3>
                <p>Statut Général : <span id="sheep_count_farm4">--</span> / 10</p>
                <ul>
                    <li><i class="fas fa-cow"></i> Élevage : Moutons</li>
                </ul>
                <a href="ferme4.php" class="btn-detail info-btn">Accéder au Dashboard</a>
            </article>

        </div>
    </section>

</main>
<script>

// =======================
// FERME 1
// =======================

fetch("api_data.php?farm=1")
.then(r => r.json())
.then(data => {

    const value = data.water_level ?? null;

    if(value !== null){

        const min = 0;
        const max = 4095;

        let percent = ((value - min) / (max - min)) * 100;
        percent = Math.max(0, Math.min(100, percent));

        const bar = document.getElementById("water-bar-index");

        if(bar){
            bar.style.width = percent + "%";
        }

    }

});


// =======================
// FERME 2
// =======================

fetch("api_data.php?farm=2")
.then(r => r.json())
.then(data => {

    const sheep = document.getElementById("sheep_count");

    if(sheep){
        sheep.textContent = data.sheep_count ?? 0;
    }

});


// =======================
// FERME 3
// =======================

fetch("api_data.php?farm=3")
.then(r => r.json())
.then(data => {

    const water3 = document.getElementById("water_level_farm3");

    if(water3){
        water3.textContent = data.water_level ?? "--";
    }

});


// =======================
// FERME 4
// =======================

fetch("api_data.php?farm=4")
.then(r => r.json())
.then(data => {

    const sheep4 = document.getElementById("sheep_count_farm4");

    if(sheep4){
        sheep4.textContent = data.sheep_count ?? 0;
    }

});

</script>

</body>
</html>