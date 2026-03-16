#include "connect.h"
#include "servo.h"

void publishCountF4() {
  String topic = "fermes/" + FERME_ID + "/count-sheep";
  client.publish(topic.c_str(), String(countF4).c_str());
  Serial.println("F4 → publié : " + String(countF4));
}

void callback(char* topic, byte* payload, unsigned int length) {
  String msg;
  for (unsigned int i = 0; i < length; i++) {
    msg += (char)payload[i];
  }
  msg.trim();

  Serial.print("Reçu sur ");
  Serial.print(topic);
  Serial.print(" → ");
  Serial.println(msg);

  // Nombre max reçu depuis F2
  if (String(topic) == "fermes/ferme2/cmd") {
    int val = msg.toInt();
    if (val > 0) {
      nbMax       = val;
      countF4     = 0;
      lastCountF2 = -1;
      Serial.print("Nb max reçu : ");
      Serial.println(nbMax);
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Max: " + String(nbMax));
      lcd.setCursor(0, 1);
      lcd.print("En attente...");
    }
  }

  // Décompte F2 → incrémente F4
  if (String(topic) == "fermes/ferme2/count-sheep") {
    int countF2 = msg.toInt();
    if (countF2 != lastCountF2) {
      lastCountF2 = countF2;
      countF4     = nbMax - countF2;
      if (countF4 > 0 && countF4 == 1) {
        client.publish("fermes/ferme3/msg", "Besoin nourriture");
        Serial.println("F3 → Besoin nourriture");
      }
      Serial.print("F4 count : ");
      Serial.println(countF4);
      publishCountF4();
      if (countF4 >= nbMax) {
        displayFinished();
      } else {
        displayCount();
      }
    }
  }

  if (String(topic) == "fermes/ferme4/LED") {
    if (msg == "Oui") {
      digitalWrite(LEDPIN, HIGH);
      ledOnTime = millis();
      ledActive = true;
      Serial.println("LED allumée");
    }
  }

  // gestion de la trappe depuis le site
  if (String(topic) == "fermes/ferme4/trap") {
    if (msg == "1") {
      if (!trappeOuverte) {
        ouvrirTrappe = true;
      }
    } else {
      if (trappeOuverte) {
        fermerTrappe = true;
      }
    }
  }

}