document.addEventListener('DOMContentLoaded', () => {
    // PARAMÈTRES DE LA FERME 2
    const TOTAL_SHEEP = 45;
    const MAX_STABLE_CAPACITY = 50;

    // Éléments du DOM
    const tempActuelleDisplay = document.getElementById('temp-actuelle');
    const humiActuelleDisplay = document.getElementById('humi-actuelle');
    const weatherAlert = document.getElementById('weather-alert');
    const sheepLocationProgress = document.getElementById('sheep-location-progress');
    const sheepLocationValue = document.getElementById('sheep-location-value');
    const stableProgress = document.getElementById('stable-progress');
    const stableValue = document.getElementById('stable-value');
    const sheepStatusMessage = document.getElementById('sheep-status-message');
    const stableWarning = document.getElementById('stable-warning');
    const gateToggle = document.getElementById('gate-toggle');
    const gateStatus = document.getElementById('gate-status');
    const gateModeLabel = document.getElementById('gate-mode-label');
    const manualGateBtn = document.getElementById('manual-gate-btn');


    // --- 1. LOGIQUE DES CONTRÔLES MANUELS (Barrière) ---
    gateToggle.addEventListener('change', function() {
        if (this.checked) {
            gateStatus.textContent = "Ouverte (Auto)";
            gateStatus.className = "status good";
            gateModeLabel.textContent = "Mode Automatique activé";
            manualGateBtn.textContent = "Fermer Manuellement";
            manualGateBtn.classList.remove('green-btn');
            manualGateBtn.classList.add('red-btn');
        } else {
            gateStatus.textContent = "Fermée (Manuel)";
            gateStatus.className = "status danger";
            gateModeLabel.textContent = "Mode Manuel activé";
            manualGateBtn.textContent = "Ouvrir Manuellement";
            manualGateBtn.classList.remove('red-btn');
            manualGateBtn.classList.add('green-btn');
        }
    });

    manualGateBtn.addEventListener('click', () => {
        const action = gateToggle.checked ? "Fermeture" : "Ouverture";
        alert(`Commande envoyée : ${action} manuelle de la barrière.`);
        // Simuler l'inversion de l'état pour le manuel
        gateToggle.checked = !gateToggle.checked;
        gateToggle.dispatchEvent(new Event('change'));
    });


    // --- 2. LOGIQUE DES ALERTES (Surveillance des moutons) ---

    // Fonction de mise à jour (prend les données réelles/simulées)
    function updateSheepStatus(data) {
        const temp = data.temperature;
        const humi = data.humidity;
        const now = new Date();
        const hour = now.getHours();

        // Mise à jour des indicateurs globaux
        tempActuelleDisplay.textContent = temp.toFixed(1);
        humiActuelleDisplay.textContent = humi.toFixed(0);

        let sheepInPasture = TOTAL_SHEEP;
        let statusText = "Conditions stables. Surveillance normale.";
        let alertStatus = 'good-text';

        const TEMP_SEUIL = 5;
        const HUMI_SEUIL = 75;

        const isNight = hour >= 21 || hour < 6;
        const isEmergency = temp < TEMP_SEUIL && humi > HUMI_SEUIL;

        // Logique de Priorité:

        // 1. Alerte Météo d'Urgence
        if (isEmergency) {
            sheepInPasture = 0;
            statusText = `<i class="fas fa-exclamation-triangle"></i> URGENCE: Température très basse (${temp.toFixed(1)}°C) et forte humidité (${humi.toFixed(0)}%). Les animaux DOIVENT rentrer !`;
            weatherAlert.innerHTML = statusText;
            weatherAlert.style.display = 'block';
            alertStatus = 'danger-text';

            // 2. Alerte Temporelle : Nuit
        } else if (isNight) {
            sheepInPasture = 0;
            statusText = `<i class="fas fa-moon"></i> Il fait nuit. Les moutons sont en sécurité à l'étable (21h - 6h).`;
            weatherAlert.style.display = 'none';
            alertStatus = 'warning-text';

            // 3. Statut Normal (Jour et Conditions OK)
        } else {
            weatherAlert.style.display = 'none';
        }

        // --- Mise à jour de l'Affichage ---
        const sheepInStable = TOTAL_SHEEP - sheepInPasture;
        const pasturePercent = (sheepInPasture / TOTAL_SHEEP) * 100;
        const stablePercent = (sheepInStable / MAX_STABLE_CAPACITY) * 100;

        // Localisation des Moutons
        sheepLocationProgress.style.width = `${pasturePercent}%`;
        sheepLocationProgress.style.backgroundColor = pasturePercent > 0 ? '#4CAF50' : '#FF9800';
        sheepLocationValue.textContent = sheepInPasture;

        // Statut de l'Étable
        stableProgress.style.width = `${stablePercent}%`;
        stableValue.textContent = stablePercent.toFixed(0);

        if (sheepInStable > 0) {
            stableWarning.innerHTML = `<i class="fas fa-check-circle"></i> ${sheepInStable} moutons à l'abri.`;
            stableWarning.className = "alert-message good-text";
        } else {
            stableWarning.innerHTML = `<i class="fas fa-info-circle"></i> L'Étable est actuellement vide.`;
            stableWarning.className = "alert-message danger-text";
        }

        // Message principal de statut
        sheepStatusMessage.innerHTML = statusText;
        sheepStatusMessage.className = `alert-message ${alertStatus}`;
    }

    // --- 3. SIMULATION DES DONNÉES (À AJUSTER) ---
    // Exemple de données simulées: Jour (14h), Temp: 18.5, Humi: 65
    const simulatedData = { temperature: 18.5, humidity: 65, time: 14 };
    updateSheepStatus(simulatedData);


    // --- 4. LOGIQUE DES GRAPHIQUES HISTORIQUES ---

    function createCharts() {
        const labels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        // Graphique de Température de la Pâture
        const tempCtx = document.getElementById('pastureTempChart').getContext('2d');
        new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Température Moyenne (°C)',
                    data: [15, 17, 12, 18, 16, 11, 14],
                    borderColor: '#FF9800',
                    backgroundColor: 'rgba(255, 152, 0, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Permet au CSS de définir la hauteur
                scales: { y: { beginAtZero: false, suggestedMin: 5, suggestedMax: 20 } }
            }
        });

        // Graphique d'Humidité de l'Air
        const humiCtx = document.getElementById('airHumidityChart').getContext('2d');
        new Chart(humiCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Humidité de l\'Air (%)',
                    data: [65, 70, 78, 55, 60, 85, 72],
                    borderColor: '#0288D1',
                    backgroundColor: 'rgba(2, 136, 209, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Permet au CSS de définir la hauteur
                scales: { y: { beginAtZero: false, suggestedMin: 50, suggestedMax: 90 } }
            }
        });
    }

    createCharts();
});