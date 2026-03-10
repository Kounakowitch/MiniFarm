#include "photocell.h"
#include "humidity_temperature.h"
#include "steam.h"
#include "waterlevel.h"
#include "soilhumidity.h"
#include "connect.h"
#include "lcd.h"
#include "WaterPump.h"


const int BUTTON_PIN = 5;
bool lastButtonState = HIGH;
unsigned long lastSend = 0;
const unsigned long sendInterval = 3000;

void setup() {
  Serial.begin(9600);
  pinMode(BUTTON_PIN, INPUT_PULLUP);

  // init capteurs
  initPhotoSensor();
  initHumidityTemperature();
  initSteam();
  initWaterlevel();

  setup_LCD();
  setup_WaterPump();

  // init MQTT
  setup_wifi();
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
  
}

void loop() {

  // envoi data mqtt sur appui bouton
  if (!client.connected()) reconnect();
  client.loop();

  bool buttonState = digitalRead(BUTTON_PIN);

  if (buttonState != lastButtonState) {
    if (digitalRead(BUTTON_PIN) == buttonState) {
      // ← ajoute : si un message est affiché, répond à F4
      if (lastMsg.length() > 0) {
        client.publish("fermes/ferme4/LED", "Oui");
        Serial.println("F4 → LED : Oui");
      }
      lastButtonState = buttonState;
    }
  }
  // Lecture des capteurs, stockage des données

  if (millis() - lastSend >= sendInterval) {
    int lumi = readPhotoSensor();
    DHTData temp_hum = readTemperatureHumidity();
    double temperature = temp_hum.temperature;
    double humidity = temp_hum.humidity;
    int steam = readSteam();
    int waterlevel = readWaterlevel();
    int soilhumidity = readSoilhumidity();
    lastSend = millis();
    publishMessage("ferme3", "steam_sensor", String(steam));
    publishMessage("ferme3", "temperature_sensor", String(temperature));
    publishMessage("ferme3", "humidity_sensor", String(humidity));
    publishMessage("ferme3", "soil_humidity_sensor", String(soilhumidity));
    publishMessage("ferme3", "photoresistor", String(lumi));
    publishMessage("ferme3", "water_level_sensor", String(waterlevel));
  }
}
