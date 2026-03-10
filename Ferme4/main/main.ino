#include "connect.h"
#include "waterlevel.h"
#include "ultrasonic.h"
#include "humidity_temperature.h"

// intervalle pour envoi data capteurs
unsigned long lastSend = 0;
const unsigned long sendInterval = 30000;

void setup() {
  Serial.begin(9600);
  delay(1000);
  Serial.println("--- F4 DEMARRE ---");
  setup_LCD();
  setup_LED();
  setup_wifi();
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

void loop() {
  if (!client.connected()) reconnect();
  client.loop();

  // ---------------- Données des capteurs -----------------------
  // Lecture des capteurs, stockage des données
  int waterlevel = readWaterlevel();
  int dist = readUltrasonic();
  DHTData temp_hum = readTemperatureHumidity();
  double temperature = temp_hum.temperature;
  double humidity = temp_hum.humidity;

  // envoi data mqtt
  if (millis() - lastSend >= sendInterval) {

    publishMessage("ferme4", "temperature_sensor", String(temperature));
    publishMessage("ferme4", "humidity_sensor", String(humidity));
    publishMessage("ferme4", "water_level_sensor", String(waterlevel));

    lastSend = millis();
  }
  // -------------------------------------------------------------

  if (ledActive && (millis() - ledOnTime >= 5000)) {
    digitalWrite(LEDPIN, LOW);
    ledActive = false;
    Serial.println("LED éteinte");
  }
}