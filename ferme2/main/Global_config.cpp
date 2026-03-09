#include "connect.h"
#include <LiquidCrystal_I2C.h> // Nécessaire ici si lcd est déclaré ici

// Objets globaux définis UNE seule fois
WiFiClient espClient;
PubSubClient client(espClient);
LiquidCrystal_I2C lcd(0x27, 16, 2); // Définition de l'objet LCD

// Variables globales définies UNE seule fois
const int BUTTON_PIN = 5;
const int LEDPIN = 27;
bool lastButtonState = HIGH;
const char* ssid = "ISEN-Projects";
const char* password = "Syn1297$$ijk003";
const char* mqtt_server = "10.30.50.139";
const int mqtt_port = 1883;

String FERME_ID = "ferme2";
String AUTRE_FERME = "ferme4";

// === NOUVELLES VARIABLES GLOBALES POUR LE CAPTEUR PIR ===
const int PyroelectricPIN = 23; // Pin 23
const unsigned long DEBOUNCE_MS = 150;
const unsigned long MAX_PRESENCE_MS = 7000;
bool isRunning = false;
bool lastStableState = LOW;
bool seenSomeone = false;
unsigned long lastChange = 0;
unsigned long lastSomeoneTs = 0;
int countSheep = 0;

// ===== WIFI (Fonction générique) =====
void setup_wifi() {
  Serial.print("Connexion WiFi...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi connecté");
  Serial.println(WiFi.localIP());
}

// ===== RECONNECT (Fonction générique) =====
void reconnect() {
  while (!client.connected()) {
    String clientId = FERME_ID + "-client-";
    clientId += String((uint32_t)ESP.getEfuseMac(), HEX);
    Serial.print("Connexion MQTT...");
    if (client.connect(clientId.c_str())) {
      Serial.println(" OK");
      // S'abonner aux deux topics
      client.subscribe(("fermes/" + FERME_ID + "/led").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/lcd").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/count-sheep").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/state-count-sheep").c_str());
      client.subscribe(("fermes/ferme2/cmd"));
    } else {
      Serial.println(" échec, nouvel essai dans 3s...");
      delay(3000);
    }
  }
}