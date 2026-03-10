#include "WaterPump.h"
#include <Arduino.h>

void setup_WaterPump() {
  Serial.begin(9600);
  pinMode(RelayPin,OUTPUT);
}
