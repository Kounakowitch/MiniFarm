#include "photocell.h"
#include "humidity_temperature.h"
#include "steam.h"
#include "waterlevel.h"
#include "soilhumidity.h"
#include "connect.h"


const int BUTTON_PIN = 5;
bool lastButtonState = HIGH;

void setup() {
  Serial.begin(9600);
  pinMode(BUTTON_PIN, INPUT_PULLUP);

  // init capteurs
  initPhotoSensor();
  initHumidityTemperature();
  initSteam();
  initWaterlevel();

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
    delay(50); // anti-rebond
    if (digitalRead(BUTTON_PIN) == buttonState) {
      
      // Lecture des capteurs, stockage des données
      int lumi = readPhotoSensor();
      DHTData temp_hum = readTemperatureHumidity();
      double temperature = temp_hum.temperature;
      double humidity = temp_hum.humidity;
      int steam = readSteam();
      int waterlevel = readWaterlevel();
      int soilhumidity = readSoilhumidity();

      publishMessage("ferme1", "steam_sensor", String(steam));
      publishMessage("ferme1", "temperature_sensor", String(temperature));
      publishMessage("ferme1", "humidity_sensor", String(humidity));
      publishMessage("ferme1", "soil_humidity_sensor", String(soilhumidity));
      publishMessage("ferme1", "photoresistor", String(lumi));
      publishMessage("ferme1", "water_level_sensor", String(waterlevel));

      lastButtonState = buttonState;
    }
  }


}
