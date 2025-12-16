document.addEventListener('DOMContentLoaded', () => {
    // --- PARAMÈTRES ET SÉLECTEURS DU DOM ---

    // Alertes et Conditions
    const tempActuelleDisplay = document.getElementById('temp-actuelle');
    const humiActuelleDisplay = document.getElementById('humi-actuelle');
    const gelAlert = document.getElementById('gel-alert');
    const irrigationAlertMsg = document.getElementById('irrigation-alert-msg');
    const nextIrrigationTimeDisplay = document.getElementById('next-irrigation-time');

    // Irrigation
    const irrigationToggle = document.getElementById('irrigation-toggle');
    const irrigationStatus = document.getElementById('irrigation-status');
    const irrigationModeLabel = document.getElementById('irrigation-mode-label');
    const manualIrrigationBtn = document.getElementById('manual-irrigation-btn');

    // Stocks
    const stockItems = [
        { name: 'carrot', min: 20, max: 100 },
        { name: 'tomato', min: 35, max: 100 },
        { name: 'salad', min: 15, max: 100 }
    ];

    // Pop-up Semis
    const seedingModal = document.getElementById('seeding-modal');
    const closeBtn = document.querySelector('.close-btn');
    const startSeedingBtn = document.getElementById('start-seeding-btn');
    let modalDisplayed = false; // Flag pour s'assurer que le pop-up n'apparaît qu'une fois par session.


    // --- LOGIQUE DES CONTRÔLES D'IRRIGATION (Manuel/Auto) ---

    // Gestion du basculement Auto/Manuel
    irrigationToggle.addEventListener('change', function() {
        if (this.checked) {
            irrigationStatus.textContent = "Automatique";
            irrigationStatus.className = "status good";
            irrigationModeLabel.textContent = "Mode Auto ON (Calculé)";
        } else {
            irrigationStatus.textContent = "Manuel";
            irrigationStatus.className = "status warning";
            irrigationModeLabel.textContent = "Mode Manuel ON";
        }
    });

    // Gestion de l'arrosage manuel
    manualIrrigationBtn.addEventListener('click', () => {
        if (!irrigationToggle.checked) {
            alert("Commande envoyée : Arrosage manuel de 5 minutes démarré.");
            manualIrrigationBtn.textContent = "Arrosage en cours...";
            manualIrrigationBtn.disabled = true;
            setTimeout(() => {
                manualIrrigationBtn.textContent = "Arroser 5 min (Manuel)";
                manualIrrigationBtn.disabled = false;
            }, 5000); // 5 secondes pour la simulation
        } else {
            alert("L'arrosage automatique est activé. Basculez en mode manuel pour prendre le contrôle.");
        }
    });


    // --- FONCTION PRINCIPALE DE MISE À JOUR (Conditions Météo/Arrosage) ---

    function updateFarm3Status(data) {
        // Données du capteur (Température de l'air, Humidité du sol)
        const temp = data.temperature;
        const humi = data.humidity;
        const now = new Date();
        const currentHour = now.getHours();

        // 1. Mise à jour des indicateurs globaux
        tempActuelleDisplay.textContent = temp.toFixed(1);
        humiActuelleDisplay.textContent = humi.toFixed(0);

        // --- 2. LOGIQUE DE L'IRRIGATION ET CALCUL DU PROCHAIN CYCLE ---

        const TEMP_HIGH_SEUIL = 28; // Température considérée comme "chaude"
        const HUMI_LOW_SEUIL = 40;  // Humidité considérée comme "basse"
        const ARROSAGE_WINDOW_START = 6; // Arrosage tôt le matin (6h)
        const ARROSAGE_WINDOW_END = 8;   // Fenêtre d'arrosage maximum (8h)
        let nextIrrigationTime = 'Calcul en cours...';

        // L'heure optimale est calculée à 6h00 si l'humidité est basse
        if (humi < HUMI_LOW_SEUIL) {
            nextIrrigationTime = '06:00 (H. basse)';
            if (currentHour >= ARROSAGE_WINDOW_START && currentHour <= ARROSAGE_WINDOW_END) {
                // Si on est dans la fenêtre d'arrosage et qu'il fait chaud/sec :
                irrigationAlertMsg.innerHTML = `<i class="fas fa-check-circle"></i> Irrigation nécessaire MAINTENANT !`;
                irrigationAlertMsg.className = 'alert-message warning-text';
            } else {
                irrigationAlertMsg.innerHTML = `<i class="fas fa-sun"></i> Prochain cycle d'arrosage à 06:00.`;
                irrigationAlertMsg.className = 'alert-message good-text';
            }
        } else if (temp > TEMP_HIGH_SEUIL && currentHour > 10 && currentHour < 18) {
            // Si forte chaleur en milieu de journée, indiquer de ne PAS arroser (risque de brûlure)
            irrigationAlertMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> NE PAS ARROSER (Chaleur Intense). Risque de brûlure.`;
            irrigationAlertMsg.className = 'alert-message danger-text';
            nextIrrigationTime = '20:00 (Chaleur)';
        } else {
            irrigationAlertMsg.innerHTML = `<i class="fas fa-check-circle"></i> Humidité et conditions optimales.`;
            irrigationAlertMsg.className = 'alert-message good-text';
            nextIrrigationTime = 'Non requis';
        }

        nextIrrigationTimeDisplay.textContent = nextIrrigationTime;


        // --- 3. LOGIQUE DE L'ALERTE GEL ET RÉCOLTE D'URGENCE ---

        const GEL_SEUIL = 2; // Température très basse pour déclencher l'alerte

        if (temp < GEL_SEUIL) {
            gelAlert.style.display = 'block';
            gelAlert.innerHTML = `<i class="fas fa-snowflake"></i> **ALERTE GEL!** Température critique (${temp.toFixed(1)}°C). Planifiez la récolte et l'envoi d'urgence vers Ferme 4.`;
        } else {
            gelAlert.style.display = 'none';
        }

        // --- 4. LOGIQUE DU POP-UP "SESSION DE SEMIS" ---

        const SEEDING_TEMP_MIN = 12;
        const SEEDING_TEMP_MAX = 25;
        const SEEDING_HUMI_MIN = 50;

        if (temp >= SEEDING_TEMP_MIN && temp <= SEEDING_TEMP_MAX && humi >= SEEDING_HUMI_MIN && !modalDisplayed) {
            // Afficher le pop-up si les conditions sont bonnes et qu'il n'a pas été affiché
            setTimeout(() => { // Décalage pour ne pas apparaître immédiatement au chargement
                seedingModal.style.display = 'block';
                modalDisplayed = true;
            }, 1500);
        }

    }


    // --- 5. LOGIQUE DES STOCKS ET ALERTES ---

    function updateStock(stockData) {
        stockItems.forEach(item => {
            const currentStock = stockData[item.name] || 0;
            const progress = document.getElementById(`${item.name}-stock-progress`);
            const value = document.getElementById(`${item.name}-stock-value`);
            const warning = document.getElementById(`${item.name}-warning`);
            const percent = (currentStock / item.max) * 100;

            progress.style.width = `${percent}%`;
            value.textContent = `${currentStock} (${percent.toFixed(0)}%)`;

            if (currentStock < item.min) {
                warning.style.display = 'block';
                warning.innerHTML = `<i class="fas fa-exclamation-circle"></i> STOCK BAS (${currentStock}). Semis de ${item.name} requis.`;
                progress.parentElement.classList.add('stock-low');
            } else {
                warning.style.display = 'none';
                progress.parentElement.classList.remove('stock-low');
            }
        });
    }

    // --- 6. GESTION DE LA MODALE POP-UP ---

    closeBtn.onclick = function() {
        seedingModal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == seedingModal) {
            seedingModal.style.display = 'none';
        }
    }

    startSeedingBtn.onclick = function() {
        alert("Session de semis démarrée !");
        seedingModal.style.display = 'none';
    }

    // --- 7. SIMULATION DE DONNÉES ET GRAPHIQUES ---

    // Simuler des données pour le Potager : Temp/Humi Sol, Stocks
    const simulatedSensorData = { temperature: 18.5, humidity: 65 };
    const simulatedStockData = {
        carrot: 45, // OK
        tomato: 20, // BAS, alerte
        salad: 12   // TRÈS BAS, alerte
    };

    updateFarm3Status(simulatedSensorData);
    updateStock(simulatedStockData);

    function createCharts() {
        const labels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        // Graphique Température du Sol
        const tempCtx = document.getElementById('soilTempChart').getContext('2d');
        new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Température Sol (°C)',
                    data: [18, 19, 17, 20, 21, 19, 18.5],
                    borderColor: '#FF8A65', // Couleur Potager
                    backgroundColor: 'rgba(255, 138, 101, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: false, suggestedMin: 15, suggestedMax: 25 } }
            }
        });

        // Graphique Humidité du Sol
        const humiCtx = document.getElementById('soilHumidityChart').getContext('2d');
        new Chart(humiCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Humidité Sol (%)',
                    data: [60, 55, 65, 50, 48, 52, 60],
                    borderColor: '#4FC3F7', // Bleu clair
                    backgroundColor: 'rgba(79, 195, 247, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: false, suggestedMin: 40, suggestedMax: 70 } }
            }
        });
    }

    createCharts();
});