#include "photocell.h"
#include <Arduino.h>

#define PhotoCellPin 34  //Define the photoresistor pin

void initPhotoSensor() {
    pinMode(PhotoCellPin, INPUT);
}

int readPhotoSensor() {
    return analogRead(PhotoCellPin);  // Valeur 0–4095
}
