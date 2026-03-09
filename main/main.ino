#include "connect.h"

void setup() {
  Serial.begin(9600);
  delay(1000);

  setup_LCD();
  setup_wifi();

  pinMode(BUTTON_PIN, INPUT_PULLUP);

  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

void loop() {

  if (!client.connected()) reconnect();
  client.loop();

  if (gelActif && digitalRead(BUTTON_PIN) == LOW) {

    client.publish("fermes/ferme4/led", "1");

    Serial.println("LED ferme4 allumee");

    delay(500);
  }
}