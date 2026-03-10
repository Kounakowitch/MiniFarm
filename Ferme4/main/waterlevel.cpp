#include "waterlevel.h"
#include <Arduino.h>

#define WaterLevelPin 33

void initWaterlevel() {
  pinMode(WaterLevelPin,INPUT);
}

int readWaterlevel() {
  return analogRead(WaterLevelPin);
}