#ifndef CONNECT_H
#define CONNECT_H

#include <WiFi.h>
#include <PubSubClient.h>
#include <LiquidCrystal_I2C.h>

// Déclarations externes (objet global défini dans .cpp)
extern WiFiClient espClient;
extern PubSubClient client;
extern LiquidCrystal_I2C lcd;

// Constantes globales
extern const int BUTTON_PIN;
extern const int LEDPIN;
extern bool lastButtonState;

extern const char* ssid;
extern const char* password;
extern const char* mqtt_server;
extern const int mqtt_port;

extern String FERME_ID;
extern String AUTRE_FERME;

// === NOUVELLES CONSTANTES ET VARIABLES POUR LE CAPTEUR PIR ===
extern const int PyroelectricPIN;
extern const unsigned long DEBOUNCE_MS;
extern const unsigned long MAX_PRESENCE_MS;
extern bool isRunning;
extern bool lastStableState;
extern bool seenSomeone;
extern unsigned long lastChange;
extern unsigned long lastSomeoneTs;
extern int countSheep; // Le compteur

// Prototypes de fonctions
void setup_wifi();
void setup_LED();
void setup_LCD();
void setup_PIR();
void loop_PIR_logic();
void callback(char* topic, byte* payload, unsigned int length);
void reconnect();
void publishLed(bool on);
void publishMessage(const String& ferme, const String& sensor, const String& msg);


#endif

 