#include "connect.h"

void setup() {
  Serial.begin(9600);
  delay(1000);
  Serial.println("--- F4 DEMARRE ---");
  setup_LCD();
  setup_wifi();
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

void loop() {
  if (!client.connected()) reconnect();
  client.loop();
}