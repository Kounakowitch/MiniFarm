#ifndef CONNECT_H
#define CONNECT_H

#include <WiFi.h>
#include <PubSubClient.h>

// Déclarations externes (objet global défini dans .cpp)
extern WiFiClient espClient;
extern PubSubClient client;

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

// Prototypes de fonctions
void setup_wifi();
void publishMessage(const String& ferme, const String& sensor, const String& msg);
void callback(char* topic, byte* payload, unsigned int length);
void reconnect();
void publishMessage();

#endif
