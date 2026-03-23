#include "HardwareSerial.h"
#include "connect.h"

#include "lcd.h"
#include "WaterPump.h"

// Objets globaux définis ici
WiFiClient espClient;
PubSubClient client(espClient);

// Variables globales
const char* ssid = "ISEN-Projects";
const char* password = "Syn1297$$ijk003";
const char* mqtt_server = "10.30.50.139";
const int mqtt_port = 1883;

String FERME_ID = "ferme3";

String lastMsg = "";



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
  if (String(topic) == "fermes/ferme3/msg") {
    lastMsg = msg;
    displayMsg(msg);
  }
  if (String(topic) == "fermes/ferme2/cmd") {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("En attente...");
    lastMsg = "";
    Serial.println("LCD réinitialisé");
  }
  if (String(topic) == "fermes/ferme3/arrosage") {
    int arrosage = msg.toInt();  // ← toInt() donc compare avec int, pas String
    Serial.println("arrosage: " + String(arrosage)); // ← correction println
    if (arrosage == 1) {          // ← enlève les guillemets
      digitalWrite(RelayPin, HIGH);
    }
    else if (arrosage == 0) {     // ← enlève les guillemets
      digitalWrite(RelayPin, LOW); // ← tu avais HIGH dans les deux cas
    }
  }
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
      client.subscribe("fermes/ferme2/cmd");
      client.subscribe("fermes/ferme3/msg");
      client.subscribe("fermes/ferme3/arrosage");
      
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
