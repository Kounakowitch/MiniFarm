function updateTime() {
    const now = new Date();
    document.getElementById('time').textContent = now.toLocaleTimeString();
}

function updateSensors() {
    // Simuler les données aléatoires
    document.getElementById('temperature').textContent = (20 + Math.random()*10).toFixed(1);
    document.getElementById('humidity').textContent = (40 + Math.random()*20).toFixed(0);
    document.getElementById('water-level').textContent = (50 + Math.random()*50).toFixed(0);
    document.getElementById('light-level').textContent = (200 + Math.random()*800).toFixed(0);
}

// Mise à jour toutes les secondes
setInterval(updateTime, 1000);
setInterval(updateSensors, 2000);
