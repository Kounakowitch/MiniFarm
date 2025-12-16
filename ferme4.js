document.addEventListener('DOMContentLoaded', () => {
    // --- PARAMÈTRES ET SÉLECTEURS DU DOM ---
    const TOTAL_SHEEP = 45;
    const HAY_MIN_STOCK = 30; // Seuil bas pour le foin (%)
    const VEG_MIN_STOCK = 20; // Seuil bas pour les légumes (%)

    // Alerte et Contrôles
    const feedingToggle = document.getElementById('feeding-toggle');
    const trapStatus = document.getElementById('trap-status');
    const feedingAlertMsg = document.getElementById('feeding-alert-msg');
    const manualFeedBtn = document.getElementById('manual-feed-btn');
    const foodChoice = document.getElementById('food-choice');
    const nextMealTimeDisplay = document.getElementById('next-meal-time');
    const mealTypeDisplay = document.getElementById('meal-type');

    // Stocks et Réappro
    const hayStockProgress = document.getElementById('hay-stock-progress');
    const hayStockValue = document.getElementById('hay-stock-value');
    const hayWarning = document.getElementById('hay-warning');
    const vegStockProgress = document.getElementById('veg-stock-progress');
    const vegStockValue = document.getElementById('veg-stock-value');
    const vegWarning = document.getElementById('veg-warning');
    const manualRestockHayBtn = document.getElementById('manual-restock-hay-btn');
    const manualRestockVegBtn = document.getElementById('manual-restock-veg-btn');

    // Horaires et Planification
    const morningFeedTimeInput = document.getElementById('morning-feed-time');
    const eveningFeedTimeInput = document.getElementById('evening-feed-time');
    const saveScheduleBtn = document.getElementById('save-schedule-btn');

    // Statut des Moutons et LED
    const sheepInStableDisplay = document.getElementById('sheep-in-stable');
    const sheepLocationMsg = document.getElementById('sheep-location-msg');
    const ledStateDisplay = document.getElementById('led-state');

    // Horaires stockés (par défaut)
    let feedSchedule = {
        morning: { time: morningFeedTimeInput.value, type: 'foin' },
        evening: { time: eveningFeedTimeInput.value, type: 'legumes' }
    };

    // --- LOGIQUE INITIALE : CHARGEMENT DES HORAIRES ---
    // En production, ces données viendraient d'une base de données ou du LocalStorage.
    const storedSchedule = localStorage.getItem('feedSchedule');
    if (storedSchedule) {
        feedSchedule = JSON.parse(storedSchedule);
        morningFeedTimeInput.value = feedSchedule.morning.time;
        eveningFeedTimeInput.value = feedSchedule.evening.time;
    }


    // --- 1. GESTION DE L'ALIMENTATION (Automatique/Manuelle) ---

    function updateTrapStatus(isOpen, mealType = null) {
        if (isOpen) {
            trapStatus.textContent = "Ouverte";
            trapStatus.className = "status good";
            feedingAlertMsg.innerHTML = `<i class="fas fa-check-circle"></i> Distribution de **${mealType || 'Nourriture'}** en cours...`;
            feedingAlertMsg.className = 'alert-message good-text';
        } else {
            trapStatus.textContent = "Fermée";
            trapStatus.className = "status danger";
            feedingAlertMsg.innerHTML = `<i class="fas fa-clock"></i> En attente du prochain cycle.`;
            feedingAlertMsg.className = 'alert-message warning-text';
        }
    }

    function performFeeding(type) {
        // Logique de distribution : Vérification du stock, envoi de la commande
        updateTrapStatus(true, type);

        // Simulation de la durée de distribution
        manualFeedBtn.disabled = true;
        setTimeout(() => {
            updateTrapStatus(false);
            manualFeedBtn.disabled = false;
        }, 15000); // 15 secondes pour la simulation
    }

    // Bouton de nourriture manuelle
    manualFeedBtn.addEventListener('click', () => {
        const type = foodChoice.value;
        if (feedingToggle.checked) {
            alert("Mode Automatique actif. Basculez en manuel pour l'action immédiate.");
        } else {
            performFeeding(type);
        }
    });

    // Enregistrement des horaires
    saveScheduleBtn.addEventListener('click', () => {
        feedSchedule.morning.time = morningFeedTimeInput.value;
        feedSchedule.evening.time = eveningFeedTimeInput.value;
        localStorage.setItem('feedSchedule', JSON.stringify(feedSchedule));
        alert("Horaires d'alimentation enregistrés et mis à jour !");
        updateFeedSchedule();
    });

    // Mise à jour du prochain repas et vérification des cycles
    function updateFeedSchedule() {
        const now = new Date();
        const currentTime = now.getHours() * 60 + now.getMinutes();

        const morningTime = feedSchedule.morning.time.split(':').map(Number);
        const morningMinutes = morningTime[0] * 60 + morningTime[1];

        const eveningTime = feedSchedule.evening.time.split(':').map(Number);
        const eveningMinutes = eveningTime[0] * 60 + eveningTime[1];

        let nextMeal = null;

        // Déterminer le prochain repas (dans l'ordre temporel)
        if (currentTime < morningMinutes) {
            nextMeal = feedSchedule.morning;
        } else if (currentTime < eveningMinutes) {
            nextMeal = feedSchedule.evening;
        } else {
            // Repas du lendemain matin (simulé pour l'affichage)
            nextMeal = feedSchedule.morning;
        }

        // Affichage du prochain repas
        nextMealTimeDisplay.textContent = nextMeal.time;
        mealTypeDisplay.textContent = nextMeal.type.toUpperCase();

        // Vérification du déclenchement automatique (si le toggle est ON)
        if (feedingToggle.checked) {
            if (currentTime === morningMinutes) {
                performFeeding(feedSchedule.morning.type);
            } else if (currentTime === eveningMinutes) {
                performFeeding(feedSchedule.evening.type);
            }
        }

        // Mettre à jour l'état chaque minute
        setTimeout(updateFeedSchedule, (60 - now.getSeconds()) * 1000);
    }

    // Lance la boucle de vérification des repas
    updateFeedSchedule();


    // --- 2. GESTION DES STOCKS ET DU RÉAPPROVISIONNEMENT ---

    function updateStocksAndRestock(stocks) {
        // Stock Foin (F1)
        const hayPercent = stocks.hay;
        hayStockProgress.style.width = `${hayPercent}%`;
        hayStockValue.textContent = hayPercent;

        if (hayPercent < HAY_MIN_STOCK) {
            hayWarning.style.display = 'block';
            hayWarning.innerHTML = `<i class="fas fa-exclamation-circle"></i> **STOCK BAS Foin !** Réapprovisionnement de F1 lancé (Auto).`;
            // Logique de Réapprovisionnement Automatique
            if (feedingToggle.checked) {
                console.log("Ordre de réappro F1 automatique envoyé.");
            }
        } else {
            hayWarning.style.display = 'none';
        }

        // Stock Légumes (F3)
        const vegPercent = stocks.legumes;
        vegStockProgress.style.width = `${vegPercent}%`;
        vegStockValue.textContent = vegPercent;

        if (vegPercent < VEG_MIN_STOCK) {
            vegWarning.style.display = 'block';
            vegWarning.innerHTML = `<i class="fas fa-exclamation-circle"></i> **STOCK BAS Légumes !** Réapprovisionnement de F3 lancé (Auto).`;
            // Logique de Réapprovisionnement Automatique
            if (feedingToggle.checked) {
                console.log("Ordre de réappro F3 automatique envoyé.");
            }
        } else {
            vegWarning.style.display = 'none';
        }
    }

    // Boutons de réapprovisionnement manuel
    manualRestockHayBtn.addEventListener('click', () => {
        alert("Demande de Réapprovisionnement Foin (F1) envoyée manuellement.");
        // Ici, on simulerait une augmentation du stock
        updateStocksAndRestock({ hay: 95, legumes: 55 });
    });
    manualRestockVegBtn.addEventListener('click', () => {
        alert("Demande de Réapprovisionnement Légumes (F3) envoyée manuellement.");
        // Ici, on simulerait une augmentation du stock
        updateStocksAndRestock({ hay: 80, legumes: 85 });
    });


    // --- 3. STATUT DES MOUTONS ET LED ---

    function updateSheepStatus(sheepInStable) {
        sheepInStableDisplay.textContent = sheepInStable;

        const sheepInPasture = TOTAL_SHEEP - sheepInStable;

        if (sheepInStable === TOTAL_SHEEP) {
            // Tous rentrés : LED ON
            sheepLocationMsg.innerHTML = `<i class="fas fa-home"></i> **TOUS** les moutons sont à l'étable.`;
            sheepLocationMsg.className = 'alert-message good-text';
            ledStateDisplay.textContent = 'ALLUMÉE';
            ledStateDisplay.className = 'status good';
        } else if (sheepInStable > 0) {
            // Quelques-uns rentrés : Statut OK
            sheepLocationMsg.innerHTML = `<i class="fas fa-walking"></i> ${sheepInPasture} mouton(s) encore à la pâture.`;
            sheepLocationMsg.className = 'alert-message warning-text';
            ledStateDisplay.textContent = 'Éteinte';
            ledStateDisplay.className = 'status danger';
        } else {
            // Aucun rentré : Statut normal (sauf s'il fait nuit/mauvais temps, géré par F2)
            sheepLocationMsg.innerHTML = `<i class="fas fa-grass"></i> Tous sont dehors.`;
            sheepLocationMsg.className = 'alert-message info-text';
            ledStateDisplay.textContent = 'Éteinte';
            ledStateDisplay.className = 'status danger';
        }
    }


    // --- 4. SIMULATION DE DONNÉES ET GRAPHIQUES ---

    // Données de simulation (à remplacer par le fetch API)
    const simulatedStocks = { hay: 80, legumes: 15 }; // Simule un stock de légumes bas
    const simulatedSheepCount = 45; // Simule que tous sont rentrés pour l'exemple

    updateStocksAndRestock(simulatedStocks);
    updateSheepStatus(simulatedSheepCount);

    function createCharts() {
        const labels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        // Consommation de Foin
        const hayCtx = document.getElementById('hayConsumptionChart').getContext('2d');
        new Chart(hayCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Consommation Foin (kg)',
                    data: [15, 14, 16, 15, 17, 18, 16],
                    backgroundColor: '#BCAAA4', // Marron clair/Gris pour le foin
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, suggestedMax: 20 } }
            }
        });

        // Consommation de Légumes
        const vegCtx = document.getElementById('vegConsumptionChart').getContext('2d');
        new Chart(vegCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Consommation Légumes (kg)',
                    data: [5, 4, 6, 5, 5, 7, 6],
                    backgroundColor: '#8BC34A', // Vert clair pour les légumes
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, suggestedMax: 10 } }
            }
        });
    }

    createCharts();
});