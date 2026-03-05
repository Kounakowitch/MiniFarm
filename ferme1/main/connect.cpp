#include "HardwareSerial.h"
#include "connect.h"

// Objets globaux définis ici
WiFiClient espClient;
PubSubClient client(espClient);

// Variables globales
const char* ssid = "ISEN-Projects";
const char* password = "Syn1297$$ijk003";
const char* mqtt_server = "10.30.50.139";
const int mqtt_port = 1883;

String FERME_ID = "ferme1";
String FERME_2 = "ferme2";
String FERME_3 = "ferme3";
String FERME_4 = "ferme4";


void setup_LED(){
  Serial.begin(9600);
  pinMode(BUTTON_PIN, INPUT_PULLUP);
  pinMode(LEDPIN, OUTPUT);
  digitalWrite(LEDPIN, LOW);
}


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

// ===== MQTT CALLBACK =====
void callback(char* topic, byte* payload, unsigned int length) {
  // reception message
  String msg;
  for (unsigned int i = 0; i < length; i++) {
    msg += (char)payload[i];
  }
  msg.trim();
  Serial.print("Reçu sur ");
  Serial.print(topic);
  Serial.print(" → ");
  Serial.println(msg);
}

// ===== RECONNECT =====
void reconnect() {
  while (!client.connected()) {
    String clientId = FERME_ID + "-client-";
    clientId += String((uint32_t)ESP.getEfuseMac(), HEX);
    Serial.print("Connexion MQTT...");
    if (client.connect(clientId.c_str())) {
      Serial.println(" OK");


      // S'abonner aux topics de chacun de ses propres capteurs
      client.subscribe(("fermes/" + FERME_ID + "/steam_sensor").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/temperature_sensor").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/humidity_sensor").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/soil_humidity_sensor").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/photoresistor").c_str());
      client.subscribe(("fermes/" + FERME_ID + "/water_level_sensor").c_str());
      
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
