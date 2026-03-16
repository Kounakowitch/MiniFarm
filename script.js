function updateDashboard(data) {

if (!data || typeof data !== "object") return;

console.log("DATA BDD :", data);


// =======================
// TEMPÉRATURE
// =======================

if(document.getElementById("air_temp"))
document.getElementById("air_temp").textContent =
data.air_temp ?? "--";


// =======================
// HUMIDITÉ AIR
// =======================

if(document.getElementById("air_humidity"))
document.getElementById("air_humidity").textContent =
data.air_humidity ?? "--";

if (document.getElementById("steam_sensor")) {

    const value = data.steam_sensor ?? null;
    document.getElementById("steam_sensor").textContent = value ?? "--";

    if (value !== null) {

        const min = 0;
        const max = 4000;

        let percent = ((value - min) / (max - min)) * 100;
        percent = Math.max(0, Math.min(100, percent));

        document.getElementById("fog-bar").style.width = percent + "%";
    }
}
// =======================
// HUMIDITÉ SOL
// =======================

if(document.getElementById("soil_humidity"))
document.getElementById("soil_humidity").textContent =
data.soil_humidity ?? "--";


// =======================
// LUMIÈRE
// =======================

if(document.getElementById("photoresistor"))
document.getElementById("photoresistor").textContent =
data.photoresistor ?? "--";


// =======================
// NIVEAU EAU
// =======================

if (document.getElementById("water_level")) {

    const value = data.water_level ?? null;
    document.getElementById("water_level").textContent = value ?? "--";

    if (value !== null) {

        const min = 0;
        const max = 4095;

        let percent = ((value - min) / (max - min)) * 100;
        percent = Math.max(0, Math.min(100, percent));

        const waterBar = document.getElementById("water-bar");
        const waterAlert = document.getElementById("water-alert");

        if (waterBar) {
            waterBar.style.width = percent + "%";
        }

        if (waterAlert) {

            if (percent <= 20) {
                waterAlert.style.display = "block";
                waterAlert.textContent = "⚠️ Réservoir presque vide";
            }

            else if (percent >= 80) {
                waterAlert.style.display = "block";
                waterAlert.textContent = "💧 Réservoir presque plein";
            }

            else {
                waterAlert.style.display = "none";
            }

        }
    }
}

// =======================
// POMPE
// =======================

if(document.getElementById("water_pump"))
document.getElementById("water_pump").textContent =
data.water_pump ? "ON" : "OFF";


// =======================
// LCD
// =======================

if(document.getElementById("lcd_text"))
document.getElementById("lcd_text").textContent =
data.lcd_text ?? "--";


// =======================
// PIR
// =======================

if(document.getElementById("pir_motion"))
document.getElementById("pir_motion").textContent =
data.pir_motion ? "Mouvement détecté" : "Aucun mouvement";


// =======================
// BUZZER
// =======================

if(document.getElementById("passive_buzzer"))
document.getElementById("passive_buzzer").textContent =
data.passive_buzzer ? "Actif" : "Inactif";


// =======================
// ULTRASON
// =======================

if(document.getElementById("ultrasonic_distance"))
document.getElementById("ultrasonic_distance").textContent =
data.ultrasonic_distance ?? "--";


// =======================
// SERVO
// =======================

if(document.getElementById("servo"))
document.getElementById("servo").textContent =
data.servo ?? "--";


// =======================
// MOUTONS
// =======================

if(document.getElementById("sheep_count"))
document.getElementById("sheep_count").textContent =
data.sheep_count ?? "--";

if(document.getElementById("etat_sheep_count"))
document.getElementById("etat_sheep_count").textContent =
data.etat_sheep_count ?? "--";


// =======================
// CONSOMMATION
// =======================

if(document.getElementById("consommation"))
document.getElementById("consommation").textContent =
data.consommation ?? "--";

if(document.getElementById("temp-global"))
document.getElementById("temp-global").textContent =
data.temp_global ?? "--";

if(document.getElementById("humi-global"))
document.getElementById("humi-global").textContent =
data.humi_global ?? "--";

if(document.getElementById("water-global"))
document.getElementById("water-global").textContent =
data.water_global ?? "--";

if(document.getElementById("light-global"))
document.getElementById("light-global").textContent =
data.light_global ?? "--";

if(document.getElementById("energy-global"))
document.getElementById("energy-global").textContent =
data.energy_global ?? "--";

}


function fetchDataFromAPI() {

const farm = typeof FARM_ID !== "undefined" ? FARM_ID : 1;

fetch(`api_data.php?farm=${farm}`)
.then(response => response.json())
.then(data => {

console.log("Réponse serveur :", data);

updateDashboard(data);

})
.catch(error => {

console.error("Erreur API :", error);

});

}


// =======================
// LANCEMENT
// =======================

fetchDataFromAPI();

setInterval(fetchDataFromAPI, 2000);

// BOUTON 1 - Arrosage ferme3
let pompeActive = false;
const manualIrrigationBtn = document.getElementById("manual-irrigation-btn");
if (manualIrrigationBtn) {
    manualIrrigationBtn.addEventListener('click', () => {
        pompeActive = !pompeActive;
        const valeur = pompeActive ? "1" : "0";
        fetch("http://10.30.50.139:5000/commande", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({ topic: "fermes/ferme3/arrosage", valeur: valeur })
        });
        manualIrrigationBtn.innerHTML = pompeActive
            ? '<i class="fas fa-tint"></i> Arrêter 🔴'
            : '<i class="fas fa-tint"></i> Arroser 💧';
    });
}

// BOUTON 2 - Envoie 10 sur ferme2/cmd
const btn2 = document.getElementById("manual-barrière-btn");
if (btn2) {
    btn2.addEventListener('click', () => {
        fetch("http://10.30.50.139:5000/commande", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({ topic: "fermes/ferme2/cmd", valeur: "10" })
        });
    });
}


// BOUTON 3 - Trappe ferme4
const trapToggle = document.getElementById("trap-toggle");
if (trapToggle) {
    trapToggle.addEventListener('change', () => {
        const valeur = trapToggle.checked ? "1" : "0";
        fetch("http://10.30.50.139:5000/commande", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({ topic: "fermes/ferme4/trap", valeur: valeur })
        });
    });
}

// BOUTON 2 - Envoie 10 sur ferme4/cmd
const btn4 = document.getElementById("manual-barrière-btn4");
if (btn4) {
    btn4.addEventListener('click', () => {
        fetch("http://10.30.50.139:5000/commande", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({ topic: "fermes/ferme4/cmd", valeur: "10" })
        });
    });
}