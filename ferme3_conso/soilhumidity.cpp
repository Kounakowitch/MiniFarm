#include "soilhumidity.h"
#include <Arduino.h>

#define SoilHumidityPin 32

void initSoilhumidity() {
  pinMode(SoilHumidityPin,INPUT);
}

int readSoilhumidity() {
  return analogRead(SoilHumidityPin);
}