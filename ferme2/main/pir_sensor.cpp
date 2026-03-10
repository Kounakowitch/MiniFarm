#include <sys/unistd.h>
#include "connect.h"
#include "servo.h"

// ===== SETUP PIR (Initialisation du pin du capteur) =====
void setup_PIR(){
  Serial.begin(9600); // Maintenu pour le debug
  pinMode(PyroelectricPIN, INPUT);
}

// ---------- PUBLISH Finish ----------
void publishFinish() {
  String topic = "fermes/" + FERME_ID + "/state-count-sheep";
  // On envoie un message indiquant que c'est terminé
  String payload = "FINISHED";

  client.publish(topic.c_str(), payload.c_str());
  Serial.println("MQTT → Décompte terminé. Message envoyé.");
}

// ---------- PUBLISH Count ----------
void publishCount() {
  String topic = "fermes/" + FERME_ID + "/count-sheep";
  String payload = String(countSheep);
  client.publish(topic.c_str(), payload.c_str());
  Serial.println("MQTT → Count publié : " + String(countSheep));
}

// ---------- PIR LOGIC ----------
void loop_PIR_logic() {
  if (!isRunning) return;

  unsigned long now = millis();
  int rawState = digitalRead(PyroelectricPIN);

  if (rawState != lastStableState && (now - lastChange) >= DEBOUNCE_MS) {
    lastChange = now;
    lastStableState = rawState;

    if (lastStableState == HIGH) {
      seenSomeone = true;
      lastSomeoneTs = now;
      Serial.println("Mouvement détecté...");
    } else {
      if (seenSomeone) {
        countSheep--; 
        seenSomeone = false;
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Moutons restants:");
        lcd.setCursor(0, 1);
        lcd.print(countSheep);

        Serial.print("Passage validé. Reste : ");
        Serial.println(countSheep);
        publishCount();
        
        // Vérification de la fin
        if (countSheep <= 0) {
          countSheep = 0;
          isRunning = false; // ARRÊT AUTOMATIQUE
          publishFinish();   // MESSAGE SEULEMENT À LA FIN
        }
      }
    }
  }

  // gestion trappe
  if (countSheep > 0) {
    openTrappe();
  }
  else {
    closeTrappe();
  }

  // Gestion du timeout (si quelqu'un reste devant)
  if (isRunning && seenSomeone && (now - lastSomeoneTs) >= MAX_PRESENCE_MS) {
    countSheep--;
    seenSomeone = false;
    lastStableState = LOW;
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Moutons restants:");
    lcd.setCursor(0, 1);
    lcd.print(countSheep);

    Serial.print("Timeout passage. Reste : ");
    Serial.println(countSheep);

    if (countSheep <= 0) {
      countSheep = 0;
      isRunning = false; // ARRÊT AUTOMATIQUE
      publishFinish();   // MESSAGE SEULEMENT À LA FIN
    }
  }
}