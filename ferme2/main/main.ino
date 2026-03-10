#include "connect.h"
#include "servo.h"
#include "waterlevel.h"
#include "ultrasonic.h"


unsigned long lastSend = 0;
const unsigned long sendInterval = 30000;

// ===== MQTT CALLBACK (Logique CENTRALISÉE) =====
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

  // --- Dispatch LED ---
  String ledTopic = "fermes/" + FERME_ID + "/led";
  if (String(topic) == ledTopic) {
    if (msg == "ON") digitalWrite(LEDPIN, HIGH);
    if (msg == "OFF") digitalWrite(LEDPIN, LOW);
  }

  // --- Dispatch LCD ---
   String lcdTopic = "fermes/" + FERME_ID + "/lcd";
   if (String(topic) == lcdTopic) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print(msg.substring(0, 16));
    
    lcd.setCursor(0, 1);
    if (msg.length() > 16) {
        lcd.print(msg.substring(16, 32));
    }
  }

    String pirCmdTopic = "fermes/ferme2/cmd"; 
    if (String(topic) == pirCmdTopic) {
      int val = msg.toInt();
      if (val > 0) {
        countSheep = val;
        isRunning = true;
        seenSomeone = false;
      
        Serial.print("Nombre reçu. Début du décompte : ");
        Serial.println(countSheep);
    } else {
        Serial.println("Erreur: Message reçu non numérique ou égal à 0");
      }
    }
  }


// ===== SETUP (Centralisation des initialisations) =====
void setup() {
  Serial.begin(9600);
  delay(1000); // Laisse le temps au port série de s'ouvrir
  Serial.println("--- SYSTEME DEMARRE ---");
  setup_LED(); // Initialise le bouton et la LED
  setup_LCD(); // Initialise l'écran LCD
  setup_PIR();
  setup_wifi(); // Initialise le WiFi
  initServo(); // initialiser la trappe (fermée)

  // init capteurs
  initWaterlevel();
  initUltrasonic();
  
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

// ===== LOOP (Maintien de la connexion et gestion du Bouton) =====
void loop() {
  if (!client.connected()) reconnect();
  client.loop();

  // ---------------- Données des capteurs -----------------------
  // Lecture des capteurs, stockage des données
  int waterlevel = readWaterlevel();
  int dist = readUltrasonic();

  // envoi data mqtt toutes les 30s sans bloquer
  if (millis() - lastSend >= sendInterval) {

    publishMessage("ferme2", "water_level_sensor", String(waterlevel));
    publishMessage("ferme2", "dist_sensor", String(dist));

    lastSend = millis();
  }

  // -------------------------------------------------------------
  
  // Logique du bouton
  bool buttonState = digitalRead(BUTTON_PIN);
  if (buttonState != lastButtonState) {
    delay(50); // anti-rebond
    if (digitalRead(BUTTON_PIN) == buttonState) {
      publishLed(buttonState == LOW);
      lastButtonState = buttonState;
    }
  }

  // Nouvelle logique du Capteur PIR
  loop_PIR_logic();
}