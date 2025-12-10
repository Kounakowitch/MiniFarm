// Fonction pour mettre à jour les éléments HTML avec les données reçues
function updateDashboard(data) {
    if (data && typeof data === 'object') {
        // Mise à jour des indicateurs clés
        document.getElementById('temp-global').textContent = data.temperature ? data.temperature.toFixed(1) : '--';
        document.getElementById('humi-global').textContent = data.humidity ? data.humidity.toFixed(0) : '--';
        document.getElementById('water-global').textContent = data.waterLevel ? data.waterLevel.toFixed(0) : '--';
        document.getElementById('light-global').textContent = data.lightIntensity ? data.lightIntensity.toFixed(0) : '--';

        // Mise à jour de l'heure locale et du temps de la dernière mise à jour
        const now = new Date();
        document.getElementById('time-display').textContent = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('last-update-time').textContent = now.toLocaleTimeString('fr-FR');

        // --- Vous ajouterez ici la logique pour mettre à jour les "farm-card" si elles sont dynamiques ---
    }
}

// Fonction pour récupérer les données depuis votre API PHP
function fetchDataFromAPI() {
    // URL de votre script PHP qui fournira les données JSON
    const apiURL = 'api_data.php';

    fetch(apiURL)
        .then(response => {
            if (!response.ok) {
                // Gestion des erreurs HTTP (ex: 404, 500)
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Affichage des données reçues
            console.log('Données reçues:', data);
            updateDashboard(data);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données en direct:', error);
            // Si la connexion échoue, on affiche des tirets pour indiquer un problème
            updateDashboard({ temperature: null, humidity: null, waterLevel: null, lightIntensity: null });
        });
}

// Lancer la fonction immédiatement au chargement de la page
fetchDataFromAPI();

// Mettre à jour les données toutes les 5 secondes (vous pouvez ajuster l'intervalle)
setInterval(fetchDataFromAPI, 5000);