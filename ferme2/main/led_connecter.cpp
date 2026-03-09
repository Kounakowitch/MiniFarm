#include "connect.h"

// Définitions globales RETIRÉES (maintenant dans global_config.cpp)

void setup_LED(){
  Serial.begin(9600); // Peut être déplacé dans main.ino/setup_wifi si souhaité
  pinMode(BUTTON_PIN, INPUT_PULLUP);
  pinMode(LEDPIN, OUTPUT);
  digitalWrite(LEDPIN, LOW);
}

// ===== PUBLISH (Fonction spécifique) =====
void publishLed(bool on) {
  const char* msg = on ? "ON" : "OFF";
  String topic = "fermes/" + AUTRE_FERME + "/led";
  client.publish(topic.c_str(), msg);
  Serial.print("Envoyé sur ");
  Serial.print(topic);
  Serial.print(" → ");
  Serial.println(msg);
}