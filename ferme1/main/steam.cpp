#include "steam.h"
#include <Arduino.h>

#define SteamPin 35   //Define the steam sensor pin to 35

void initSteam() {
  pinMode(SteamPin,INPUT);
}

int readSteam() {
  return analogRead(SteamPin);
}