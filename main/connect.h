#ifndef CONNECT_H
#define CONNECT_H

#include <WiFi.h>
#include <PubSubClient.h>
#include <LiquidCrystal_I2C.h>

extern WiFiClient espClient;
extern PubSubClient client;
extern LiquidCrystal_I2C lcd;

extern const char* ssid;
extern const char* password;
extern const char* mqtt_server;
extern const int mqtt_port;
extern const int BUTTON_PIN;
extern bool gelActif;
extern const int BUTTON_PIN;
extern bool gelActif;

extern String FERME_ID;

// Variables de comptage
extern int nbMax;
extern int countF4;
extern int lastCountF2;

// Prototypes
void setup_wifi();
void reconnect();
void setup_LCD();
void callback(char* topic, byte* payload, unsigned int length);
void publishCountF4();
void displayCount();
void displayFinished();

#endif