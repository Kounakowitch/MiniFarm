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

if(document.getElementById("water_level"))
document.getElementById("water_level").textContent =
data.water_level ?? "--";


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
.then(response => response.text())
.then(data => {

console.log("Réponse serveur :", data);

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