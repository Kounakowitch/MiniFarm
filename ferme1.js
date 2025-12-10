document.addEventListener('DOMContentLoaded', () => {
    // 1. --- LOGIQUE DES CONTRÔLES MANUELS ---

    // a) Contrôle de l'Arrosage (Automatique/Manuel)
    const irrigationToggle = document.getElementById('irrigation-toggle');
    const irrigationStatus = document.getElementById('irrigation-status');
    const irrigationModeLabel = document.getElementById('irrigation-mode-label');
    const manualIrrigationBtn = document.getElementById('manual-irrigation-btn');

    irrigationToggle.addEventListener('change', function() {
        if (this.checked) {
            irrigationStatus.textContent = "Automatique";
            irrigationStatus.className = "status good";
            irrigationModeLabel.textContent = "Mode Auto activé";
            manualIrrigationBtn.disabled = false;
        } else {
            irrigationStatus.textContent = "Manuel";
            irrigationStatus.className = "status warning";
            irrigationModeLabel.textContent = "Mode Manuel activé";
            manualIrrigationBtn.disabled = false; // Reste actif en mode manuel
        }
    });

    manualIrrigationBtn.addEventListener('click', () => {
        // Logique PHP/API à implémenter ici pour envoyer la commande
        alert("Commande envoyée : Arrosage manuel de 5 minutes démarré.");
        // Désactiver temporairement le bouton et afficher un feedback
        manualIrrigationBtn.textContent = "Arrosage en cours...";
        manualIrrigationBtn.disabled = true;
        setTimeout(() => {
            manualIrrigationBtn.textContent = "Arroser 5 min (Manuel)";
            manualIrrigationBtn.disabled = false;
            // Si l'irrigation est en mode Auto, le bouton devrait le rester
            if (!irrigationToggle.checked) {
                irrigationStatus.textContent = "Manuel (Terminé)";
            }
        }, 5000); // 5 secondes pour la simulation
    });

    // b) Contrôle des Semis (Simulateur d'Alerte Capteur)
    const seedingToggle = document.getElementById('seeding-toggle');
    const seedingGoStatus = document.getElementById('seeding-go-status');
    const seedingModeLabel = document.getElementById('seeding-mode-label');

    seedingToggle.addEventListener('change', function() {
        // En mode réel, ce serait l'API qui dirait si le semis automatique est possible
        if (this.checked) {
            seedingModeLabel.textContent = "Semis Automatique ON";
        } else {
            seedingModeLabel.textContent = "Semis Manuel actif";
        }
    });


    // 2. --- LOGIQUE DE L'AFFICHAGE DES CURSEURS ET ALERTES DE STOCK ---

    // Fonction de simulation/mise à jour
    function updateLogistics(deliveryPercent, stockPercent, tempActuelle) {
        const deliveryProgress = document.getElementById('delivery-progress');
        const deliveryValue = document.getElementById('delivery-value');
        const stockProgress = document.getElementById('stock-progress');
        const stockValue = document.getElementById('stock-value');
        const stockWarning = document.getElementById('stock-warning');
        const tempActuelleDisplay = document.getElementById('temp-actuelle');
        const gelAlert = document.getElementById('gel-alert');

        // Mise à jour de la Logistique
        deliveryProgress.style.width = `${deliveryPercent}%`;
        deliveryValue.textContent = deliveryPercent;

        // Mise à jour du Stock
        stockProgress.style.width = `${stockPercent}%`;
        stockValue.textContent = stockPercent;

        // Logique d'alerte Semis (basée sur le Stock)
        if (stockPercent < 30) {
            stockWarning.style.display = 'block';
            stockProgress.parentElement.classList.add('stock-low');
        } else {
            stockWarning.style.display = 'none';
            stockProgress.parentElement.classList.remove('stock-low');
        }

        // Mise à jour de la Température et Alerte Gel
        tempActuelleDisplay.textContent = tempActuelle.toFixed(1);

        // Logique d'alerte Gel
        if (tempActuelle < 3.0) {
            gelAlert.style.display = 'block';
            seedingGoStatus.textContent = "FEU ROUGE (Gel)";
            seedingGoStatus.className = "status danger";
            // Forcer le semis automatique à OFF si la température est dangereuse
            seedingToggle.checked = false;
            seedingToggle.disabled = true;
        } else {
            gelAlert.style.display = 'none';
            seedingGoStatus.textContent = "Feu Vert (OK)";
            seedingGoStatus.className = "status good";
            seedingToggle.disabled = false;
        }

    }

    // Appel de simulation (remplacez-le par votre fetch API)
    // Simuler un envoi à 75%, un stock bas à 25% et un risque de gel
    updateLogistics(75, 25, 2.1);


    // 3. --- LOGIQUE DES GRAPHIQUES HISTORIQUES ---

    function createCharts() {
        const labels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        // Graphique d'Humidité du Sol
        const humidityCtx = document.getElementById('soilHumidityChart').getContext('2d');
        new Chart(humidityCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Humidité du Sol (%)',
                    data: [55, 60, 58, 45, 48, 52, 57],
                    borderColor: '#0288D1', // Bleu pour l'eau
                    backgroundColor: 'rgba(2, 136, 209, 0.1)',
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

        // Graphique de Taux de Nutriments (pH)
        const phCtx = document.getElementById('phLevelChart').getContext('2d');
        new Chart(phCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Niveau pH du Sol',
                    data: [6.5, 6.7, 6.6, 6.8, 6.5, 6.7, 6.6],
                    backgroundColor: '#558B2F', // Vert foncé pour le sol
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: false, suggestedMin: 6.0, suggestedMax: 7.0 } }
            }
        });
    }

    createCharts();
});