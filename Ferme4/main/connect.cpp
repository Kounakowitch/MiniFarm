#include "connect.h"
#include <LiquidCrystal_I2C.h>

WiFiClient espClient;
PubSubClient client(espClient);
LiquidCrystal_I2C lcd(0x27, 16, 2);

const char* ssid        = "ISEN-Projects";
const char* password    = "Syn1297$$ijk003";
const char* mqtt_server = "10.30.50.139";
const int   mqtt_port   = 1883;

String FERME_ID = "ferme4";

int nbMax      = 0;
int countF4    = 0;
int lastCountF2 = -1;

const int LEDPIN = 27;
unsigned long ledOnTime = 0;
bool ledActive = false;

// ===== WIFI =====
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

// ===== RECONNECT =====
void reconnect() {
  while (!client.connected()) {
    String clientId = FERME_ID + "-client-";
    clientId += String((uint32_t)ESP.getEfuseMac(), HEX);
    Serial.print("Connexion MQTT...");
    if (client.connect(clientId.c_str())) {
      Serial.println(" OK");
      client.subscribe("fermes/ferme2/cmd");
      client.subscribe("fermes/ferme2/count-sheep");
      client.subscribe("fermes/ferme4/LED");
      Serial.println("Abonnements OK");
    } else {
      Serial.println(" échec, nouvel essai dans 3s...");
      delay(3000);
    }
  }
}

// ===== PUBLISH =====
void publishMessage(const String& ferme, const String& sensor, const String& msg) {
  String topic = "fermes/" + ferme + "/" + sensor;
  client.publish(topic.c_str(), msg.c_str());
  Serial.print("Envoyé sur ");
  Serial.print(topic);
  Serial.print(" → ");
  Serial.println(msg);
}

